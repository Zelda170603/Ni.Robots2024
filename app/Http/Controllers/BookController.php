<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Autore;
use App\Models\Editoriale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index_admin(Request $request)
    {
        $books = Book::with(['autor', 'editorial'])->paginate(10);
        return view('book.index-admin', compact('books'));
    }


    public function index(Request $request)
    {
        $query = Book::query();

        // Filtrar por autor
        if ($request->filled('autor_id')) {
            $query->where('autor_id', $request->autor_id);
        }

        // Filtrar por editorial
        if ($request->filled('editorial_id')) {
            $query->where('editorial_id', $request->editorial_id);
        }

        // Filtrar por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Filtrar por grupo de usuarios
        if ($request->filled('grupo_usuarios')) {
            $query->where('grupo_usuarios', $request->grupo_usuarios);
        }

        // Filtrar por fecha de publicación
        if ($request->filled('fecha_publicacion_min') && $request->filled('fecha_publicacion_max')) {
            $query->whereBetween('fecha_publicacion', [$request->fecha_publicacion_min, $request->fecha_publicacion_max]);
        } elseif ($request->filled('fecha_publicacion_min')) {
            $query->where('fecha_publicacion', '>=', $request->fecha_publicacion_min);
        } elseif ($request->filled('fecha_publicacion_max')) {
            $query->where('fecha_publicacion', '<=', $request->fecha_publicacion_max);
        }

        // Filtrar por número de páginas
        if ($request->filled('paginas_min') && $request->filled('paginas_max')) {
            $query->whereBetween('paginas', [$request->paginas_min, $request->paginas_max]);
        } elseif ($request->filled('paginas_min')) {
            $query->where('paginas', '>=', $request->paginas_min);
        } elseif ($request->filled('paginas_max')) {
            $query->where('paginas', '<=', $request->paginas_max);
        }

        // Incluir relaciones y paginar los resultados
        $books = $query->with(['autor', 'editorial'])
            ->paginate(12)
            ->appends($request->except('page'));

        $autores = Autore::all();
        $editoriales = Editoriale::all();

        return view('book.index-users', compact('books', 'autores', 'editoriales'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $book = new Book();
        $autores = Autore::pluck('nombre', 'id');
        $editoriales = Editoriale::pluck('nombre', 'id');
        return view('book.create', compact('book', 'autores', 'editoriales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Manejar la subida de la imagen de portada
        if ($request->hasFile('portada')) {
            // Guardar la imagen con un nombre único basado en la hora actual
            $imageName = time() . '_portada.' . $request->portada->extension();
            $request->portada->storeAs('public/librosPortada', $imageName);
            $validatedData['portada'] = 'storage/librosPortada/' . $imageName;
        }


        // Manejar la subida del archivo del libro
        if ($request->hasFile('file_url')) {
            $filePath = $request->file('file_url')->store('librosPDF', 'public');
            $validatedData['file_url'] = 'storage/' . $filePath;
        }
        // Crear el libro con los datos validados
        Book::create($validatedData);

        return Redirect::route('books.create')
            ->with('success', 'Book created successfully.');
    }

    public function searchByName(Request $request)
    {
        try {
            $searchTerm = $request->input('searchTerm');
            $books = Book::where('title', 'LIKE', '%' . $searchTerm . '%')
                ->with(['autor', 'editorial'])
                ->get();

            $html = View::make('book.partials.search_result', ['books' => $books])->render();
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            // Loguear el error con detalles específicos
            Log::error('Error en la búsqueda de libros: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Devolver un mensaje de error detallado solo en entornos no productivos
            if (app()->environment('local')) {
                return response()->json([
                    'error' => 'Ocurrió un error al realizar la búsqueda.',
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ], 500);
            } else {
                // En producción, devolver un mensaje genérico
                return response()->json([
                    'error' => 'Ocurrió un error al realizar la búsqueda. Por favor, intenta nuevamente.'
                ], 500);
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $promedioCalificaciones = $book->calificaciones()->avg('puntuacion');

        // Calcular el número total de calificaciones
        $totalRatings = $book->calificaciones()->count();
        // Calcular el porcentaje para cada calificación
        $ratingsPercentages = [];
        foreach (range(5, 1) as $stars) {
            $count = $book->calificaciones()->where('puntuacion', $stars)->count();
            $percentage = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
            $ratingsPercentages[$stars] = $percentage;
        }
        // Obtener los primeros 2 comentarios con calificaciones
        $comentarios = $book->calificaciones()
            ->select('puntuacion', 'comentario', 'id_user')
            ->with('user')
            ->limit(2)
            ->get();

        $mejorCalificados = Book::with(['autor', 'editorial'])
            ->withAvg('calificaciones', 'puntuacion')
            ->orderByDesc('calificaciones_avg_puntuacion')
            ->take(10)
            ->get();

        // Obtener productos con el mismo nivel de afectacion
        $mismacategoria = book::where('categoria', $book->categoria)
            ->where('id', '!=', $book->id) // Excluir el producto actual
            ->withAvg('calificaciones', 'puntuacion')
            ->orderByDesc('calificaciones_avg_puntuacion')
            ->take(10)
            ->get();

        $mismopublico = book::where('grupo_usuarios', $book->grupo_usuarios)
            ->where('id', '!=', $book->id) // Excluir el producto actual
            ->withAvg('calificaciones', 'puntuacion')
            ->orderByDesc('calificaciones_avg_puntuacion')
            ->take(10)
            ->get();

        $bookCardMejorCalificados = View::make('book.partials.book_card', [
            'mejorCalificados' => $mejorCalificados,
            'promedioCalificaciones' => $promedioCalificaciones,
        ])->render();

        $bookCardmismacategoria = View::make('book.partials.book_card', [
            'mejorCalificados' => $mismacategoria,
            'promedioCalificaciones' => $promedioCalificaciones,
        ])->render();

        $bookCardmismoPublico = View::make('book.partials.book_card', [
            'mejorCalificados' => $mismopublico,
            'promedioCalificaciones' => $promedioCalificaciones,
        ])->render();

        return view('book.show', [
            'book' => $book,
            'promedioCalificaciones' => $promedioCalificaciones,
            'totalRatings' => $totalRatings,
            'ratingsPercentages' => $ratingsPercentages,
            'comentarios' => $comentarios,

            'bookCardView' => $bookCardMejorCalificados,
            'bookCardmismacategoria' => $bookCardmismacategoria,
            'bookCardmismoPublico' => $bookCardmismoPublico,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $autores = Autore::pluck('nombre', 'id');
        $editoriales = Editoriale::pluck('nombre', 'id');
        return view('book.edit', compact('book', 'autores', 'editoriales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        // Obtener los datos validados del request
        $validatedData = $request->validated();

        // Manejar la subida de la nueva portada (si es que se sube una nueva)
        if ($request->hasFile('portada')) {
            // Eliminar la portada anterior si existe
            if ($book->portada && file_exists(public_path($book->portada))) {
                unlink(public_path($book->portada)); // Elimina la portada anterior
            }

            // Guardar la nueva portada con un nombre único
            $imageName = time() . '_portada.' . $request->portada->extension();
            $request->portada->storeAs('public/librosPortada', $imageName);
            $validatedData['portada'] = 'storage/librosPortada/' . $imageName;
        }

        // Manejar la subida del nuevo archivo del libro (si es que se sube uno nuevo)
        if ($request->hasFile('file_url')) {
            // Eliminar el archivo anterior si existe
            if ($book->file_url && file_exists(public_path($book->file_url))) {
                unlink(public_path($book->file_url)); // Elimina el archivo anterior
            }

            // Guardar el nuevo archivo
            $filePath = $request->file('file_url')->store('librosPDF', 'public');
            $validatedData['file_url'] = 'storage/' . $filePath;
        }

        // Actualizar los datos del libro
        $book->update($validatedData);

        // Redirigir al índice de libros con un mensaje de éxito
        return Redirect::route('books.index')
            ->with('success', 'Book updated successfully.');
    }



    public function destroy($id): RedirectResponse
    {
        Book::find($id)->delete();

        return Redirect::route('books.index_admin')
            ->with('success', 'Book deleted successfully');
    }
    public function rate_book(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:300',
            'id_book' => 'required|exists:books,id',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Insertar la calificación en la tabla calificacion_book
        DB::table('calificacion_book')->insert([
            'puntuacion' => $validatedData['puntuacion'],
            'comentario' => $validatedData['comentario'],
            'id_book' => $validatedData['id_book'],
            'id_user' => $userId,
        ]);
        // Devolver una respuesta JSON indicando éxito
        return response()->json(['message' => 'Calificación registrada correctamente'], 200);
    }
}
