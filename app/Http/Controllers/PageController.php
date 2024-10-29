<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;

class PageController extends Controller
{
    public function showContact()
    {
        return view('contact');
    }

    public function showTopInvestments()
    {
        // Aquí podrías agregar lógica para obtener datos, por ejemplo:
        $investments = Investment::orderBy('amount', 'desc')->take(10)->get();
        return view('top-investments', compact('investments'));
    }
}
