<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    /**
     * Muestra una lista de todas las notificaciones del usuario autenticado.
     *
     * @return \Illuminate\Http\Response
     */

     // En el archivo NotificationController.php

     public function index()
     {
         $user = Auth::user();
         $notifications = $user->notifications()->where('is_deleted', false)->get(); // Asegúrate de que no estás filtrando las nuevas accidentalmente.
     
         $unreadCount = $user->unreadNotifications->count(); // Contar solo las no leídas.
     
         return view('notifications.index', compact('notifications', 'unreadCount'));
     }
     

     

    /**
     * Marca una notificación específica como leída.
     *
     * @param  int  $id  El ID de la notificación
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id); // Buscar la notificación por ID

        if ($notification) {
            $notification->markAsRead(); // Marcar como leída si se encuentra
        }

        return redirect()->back(); // Redirigir a la página anterior
    }

            

    public function deleteAll()
    {
        auth()->user()->notifications()->update(['is_deleted' => true]);
    
        return back()->with('success', 'Todas las notificaciones han sido "eliminadas".');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();  // Esto elimina la notificación de la base de datos
    
        if (request()->ajax()) {
            return response()->json(['success' => 'Notificación eliminada con éxito.']);
        }
    
        return back()->with('success', 'Notificación eliminada con éxito.');
    }
    
    public function showNotifications()
    {
        $user = Auth::user(); // Asegura que el usuario está autenticado
        $notifications = $user->notifications; // Obtiene todas las notificaciones del usuario
        $unreadCount = $user->unreadNotifications->count(); // Conteo de notificaciones no leídas

        // Asegúrate de que 'notifications.index' apunte al archivo correcto dentro de la carpeta 'views/notifications'
        return view('notifications.index', compact('notifications', 'unreadCount')); 
    }
    

}
