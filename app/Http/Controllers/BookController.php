<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Autore;
use App\Models\Editoriale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index_admin(Request $request)
    {
        $books = Book::with(['autor', 'editorial'])->paginate();
        return view('book.index-admin', compact('books'))
            ->with('i', ($request->input('page', 1) - 1) * $books->perPage());
    }


    public function index(Request $request): View
    {
        $books = Book::with(['autor', 'editorial'])->paginate();
        return view('book.index-users', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
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

        return Redirect::route('books.index')
            ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $book = Book::findOrFail($id);
        return view('book.show', compact('book'));
    }

    /**
     * Display the PDF viewer for the specified book.
     */
    public function visor($id): View
    {
        $book = Book::findOrFail($id);

        return view('book.visor', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
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
        $book->update($request->validated());

        return Redirect::route('books.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Book::find($id)->delete();

        return Redirect::route('books.index_admin')
            ->with('success', 'Book deleted successfully');
    }
}
