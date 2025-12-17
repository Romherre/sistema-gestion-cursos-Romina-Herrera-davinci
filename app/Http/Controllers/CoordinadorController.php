<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    public function dashboard()
{
    return view('coordinador.dashboard');
}
}
