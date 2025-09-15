<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'file_url' => 'required|file|mimes:pdf|max:20480', // Validar archivo PDF
            'autor_id' => 'required|exists:autores,id',
            'editorial_id' => 'required|exists:editoriales,id',
            'portada' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|', // Validar imagen
            'descripcion' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'isbn' => 'required|string|unique:books,isbn',
            'paginas' => 'required|integer',
        ];
    }
}
