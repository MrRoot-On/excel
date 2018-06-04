<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
	protected $fillable = ['nombre', 'ap_paterno', 'ap_materno', 'tipo','img', 'correo', 'pass'];
}
