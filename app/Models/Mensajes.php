<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensajes extends Model
{
    protected $table = 'mensajes';

    protected $fillable = [
        'incoming-msg-id','outgoing-msg-id','message'
    ];
}
