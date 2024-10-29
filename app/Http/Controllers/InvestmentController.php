<?php

namespace App\Http\Controllers;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Añadir esta línea
use App\Models\InvestmentTransaction;
use App\Notifications\InvestmentNotification;
use Mpdf\Mpdf;
use App\Models\User;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::where('user_id', auth()->id())->get();
        return view('investments.index', compact('investments'));
    }

    public function home()
    {
        if (auth()->check()) {
            $investments = Investment::where('user_id', '!=', auth()->id())->get();
        } else {
            $investments = Investment::all();
        }
        return view('home', compact('investments'));
    }

    public function create()
    {
        return view('investments.create');
    }
            
            public function store(Request $request)
        {
            // Validación de los datos ingresados por el usuario
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'goal_amount' => 'required|numeric|min:0.01',
                'amount' => 'required|numeric',
                'status' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Límite de 10MB
            ], [
                'image.required' => 'La carga de una imagen es obligatoria para crear una nueva inversión.'
            ]);

            // Creación de una nueva instancia del modelo Investment
            $investment = new Investment();
            $investment->user_id = auth()->id();
            $investment->title = $request->title;
            $investment->description = $request->description;
            $investment->goal_amount = $request->goal_amount;
            $investment->amount = $request->amount;
            $investment->status = $request->status;
            $investment->raised_amount = 0; // Inicializando el monto recaudado
            $investment->investor_count = 0; // Inicializando el contador de inversores

            // Manejo de la carga de la imagen
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $filename = time() . '.' . $request->image->getClientOriginalExtension(); // Crear un nombre de archivo único
                $path = $request->image->storeAs('public/investments', $filename); // Guardar el archivo en el sistema de archivos
                $investment->image = 'investments/' . $filename; // Almacenar la ruta en el modelo
            }

            // Guardar el modelo en la base de datos
            $investment->save();

           
            // Redirección al índice de inversiones con un mensaje de éxito
            return redirect()->route('investments.index')->with('success', 'Inversión creada con éxito.');
        }
            
    
    
    

    public function show($id)
    {
        $investment = Investment::findOrFail($id);
        return view('investments.show', compact('investment'));
    }

    public function edit($id)
    {
        $investment = Investment::findOrFail($id);
        return view('investments.edit', compact('investment'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:0.01',
            'amount' => 'required|numeric', // Validación de 'amount'
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $investment = Investment::findOrFail($id);
    
        // Proceso de actualización de la imagen
        if ($request->hasFile('image')) {
            $oldImage = $investment->image;
            $filename = $request->image->hashName(); // Genera un nombre de archivo hash único
            $path = $request->image->storeAs('public/investments', $filename);
            if ($path) {
                $investment->image = 'investments/' . $filename; // Guarda la nueva imagen
    
                // Elimina la imagen antigua si la nueva se ha guardado correctamente
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }
    
        // Actualizar otros datos
        $investment->title = $request->title;
        $investment->description = $request->description;
        $investment->goal_amount = $request->goal_amount;
        $investment->amount = $request->amount;
        $investment->status = $request->status;
    
        // Determinar el estado basado en el monto recaudado
        if ($investment->raised_amount >= $investment->goal_amount) {
            $investment->status = 'financiado';
        }
        
        $investment->save();
    
        return redirect()->route('investments.index')->with('success', 'Inversión actualizada con éxito.');
    }
    
    
    
    
    

    public function destroy($id)
    {
        $investment = Investment::findOrFail($id);
        if ($investment->image && Storage::exists($investment->image)) {
            Storage::delete($investment->image);
        }
        $investment->delete();

        return redirect()->route('investments.index')->with('success', 'Inversión eliminada con éxito.');

    }

    public function processInvestment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'card_number' => ['required', 'numeric', 'digits_between:13,19', 'regex:/^[45]\d{12,18}$/'],
            'card_expiry' => 'required|date|after_or_equal:today',
            'card_cvc' => 'required|numeric|digits_between:3,4'
        ]);
    
        DB::beginTransaction();
        try {
            $investment = Investment::findOrFail($id);
            $investment->increment('raised_amount', $validatedData['amount']);
            $investment->increment('investor_count');
    
            $transaction = new InvestmentTransaction([
                'user_id' => auth()->id(),  // ID del usuario que está invirtiendo
                'investment_id' => $id,
                'amount' => $validatedData['amount'],
                'card_number' => $validatedData['card_number'],
                'card_expiry' => $validatedData['card_expiry'],
                'card_cvc' => $validatedData['card_cvc']
            ]);
            $transaction->save();
    
            // Notificar al propietario de la inversión
            $owner = User::find($investment->user_id); // Encuentra al propietario de la inversión
            if ($owner) {
                try {
                    $owner->notify(new InvestmentNotification($investment, auth()->user()));  // Usar auth()->user() para mostrar quién invirtió
                    \Log::info('Notificación enviada correctamente al propietario de la inversión ID: ' . $owner->id);
                } catch (\Exception $e) {
                    \Log::error('Error al enviar notificación: ' . $e->getMessage());
                }
            }
    
            // Generar el ticket PDF con mPDF
            $mpdf = new Mpdf();
            $view = view('investments.ticket', ['transaction' => $transaction])->render();
            $mpdf->WriteHTML($view);
            $fileName = 'investment-ticket-' . $transaction->id . '.pdf';
            $pdfPath = storage_path('app/public/tickets/' . $fileName);
            $mpdf->Output($pdfPath, 'F');
    
            DB::commit();
    
            // Guardar el mensaje de éxito en la sesión antes de hacer la descarga
            session()->flash('success', 'Inversión procesada y ticket generado con éxito.');
            return response()->download($pdfPath, $fileName);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error("Error processing investment: " . $e->getMessage());
            return back()->withErrors('Error en la transacción: ' . $e->getMessage());
        }
    }
    
    
    
    
    

    
    
    public function showInvestmentForm($id)
    {
        $investment = Investment::findOrFail($id);
        return view('investments.investmentsform', compact('investment'));
    }
    
        
}
