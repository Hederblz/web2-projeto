<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome_cliente',
        'status',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento de Muitos para Muitos com Produtos
    public function produtos()
    {
        return $this->belongsToMany(Produto::class)
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }
}