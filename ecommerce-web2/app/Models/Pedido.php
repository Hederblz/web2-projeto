<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    public static function forUser(int $userId)
    {
        return Cache::remember('pedidos_lista_user_' . $userId, 86400, function () use ($userId) {
            return self::where('user_id', $userId)->with('produtos')->latest()->get();
        });
    }

    public static function clearUserCache(int $userId)
    {
        Cache::forget('pedidos_lista_user_' . $userId);
    }
}