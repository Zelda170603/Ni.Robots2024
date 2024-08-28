<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\CalificacionBook;
use App\Models\User;

class CalificacionBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios y productos
        $users = User::all();
        $books = book::all();

        // Asegurarse de que haya usuarios y productos disponibles
        if ($users->isEmpty() || $books->isEmpty()) {
            throw new \Exception('No hay usuarios o productos disponibles para crear calificaciones.');
        }

        foreach($users as $user){
            foreach($books as $book){
                CalificacionBook::create([
                    'puntuacion' => rand(1, 5),
                    'comentario' => 'Comentario de prueba para el libro ' . $book->id,
                    'id_book' => $book->id,
                    'id_user' => $user->id,
                ]);
            }
        }
        
    }
}
