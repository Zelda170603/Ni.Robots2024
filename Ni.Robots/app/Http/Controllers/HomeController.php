<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Book;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // === Productos mejor calificados ===
        $mejorCalificados = Producto::with('fotos')
            ->withAvg('calificaciones', 'puntuacion')
            ->orderByDesc('calificaciones_avg_puntuacion')
            ->take(10)
            ->get();

        $productCardView = View::make('productos.partials.producto_card', [
            'mejorCalificados' => $mejorCalificados
        ])->render();

        // === Libros mejor calificados ===
        $librosmejorCalificados = Book::with(['autor', 'editorial'])
            ->withAvg('calificaciones', 'puntuacion')
            ->orderByDesc('calificaciones_avg_puntuacion')
            ->take(10)
            ->get();

        $bookCardMejorCalificados = View::make('book.partials.book_card', [
            'mejorCalificados' => $librosmejorCalificados
        ])->render();

        // === Productos destacados (u otra sección de interés) ===
        $featuredProducts = Producto::with('fotos')->take(8)->get();

        // === Enviar todo a la vista principal ===
        return view('home', compact('productCardView', 'bookCardMejorCalificados', 'featuredProducts'));
    }

    public function atencion_medica()
    {
        return view("Atencion_medica");
    }
}
