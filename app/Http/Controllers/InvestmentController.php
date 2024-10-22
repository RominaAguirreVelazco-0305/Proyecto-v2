<?php

namespace App\Http\Controllers;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::all();
        return view('investments.index', compact('investments'));
    }

    public function create()
    {
        return view('investments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $investment = new Investment();
        $investment->title = $request->title;
        $investment->description = $request->description;
        $investment->amount = $request->amount;
        $investment->status = $request->status;
        $investment->user_id = auth()->id();  // Asegúrate de asignar el ID del usuario autenticado
        $investment->save();

        return redirect()->route('investments.index')
                         ->with('success', 'Investment created successfully.');
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
            'amount' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $investment = Investment::findOrFail($id);
        $investment->update($request->all());

        return redirect()->route('investments.index')
                         ->with('success', 'Investment updated successfully.');
    }

    public function destroy($id)
    {
        $investment = Investment::findOrFail($id);
        $investment->delete();

        return redirect()->route('investments.index')
                         ->with('success', 'Investment deleted successfully.');
    }
}
