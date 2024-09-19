<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministracionController extends Controller
{
    
    public function index()
    {
        return view('Administracion.index');
    }

    public function doctor(){
        return view('Administracion.Doctor.index');
    }

    public function fabricante(){
        $user = Auth::user();
        $role = $user->role->role_type;
        $layout = $role == 'fabricante' ? 'layouts.adminLY' : 'layouts.app';
        return view('Administracion.fabricante.index');
    }
}
