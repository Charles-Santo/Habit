<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'is_anunciante',
        'is_admin',
        'corretora',
        'cnpj',
        'password',
    ];

    protected function casts(): array
    {
        return [
            'is_anunciante' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }
}