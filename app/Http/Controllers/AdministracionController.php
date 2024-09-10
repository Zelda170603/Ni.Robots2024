<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    
    public function index()
    {
        return view('Administracion.index');
    }

    public function doctor(){
        return view('Administracion.Doctor.index');
    }
}
