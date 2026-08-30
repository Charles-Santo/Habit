<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anuncio extends Model
{
    /** @use HasFactory<\Database\Factories\AnuncioFactory> */
    use HasFactory, SoftDeletes;

    /**
     * Atributos que podem ser preenchidos em massa (create/update).
     *
     * @var list<string>
     */
    protected $fillable = [
        'titulo',
        'email',
        'preco',
        'area',
        'user_id',
        'telefone',
        'descricao',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'preco' => 'decimal:2',
            'area' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
