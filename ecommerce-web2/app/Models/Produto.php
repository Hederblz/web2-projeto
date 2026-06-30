<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nome',
        'descricao',
        'preco',
        'estoque',
        'user_id' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class)
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    public static function forUser(int $userId)
    {
        return Cache::remember('produtos_lista_user_' . $userId, 86400, function () use ($userId) {
            return self::where('user_id', $userId)->with('categoria')->get();
        });
    }

    public static function clearUserCache(int $userId)
    {
        Cache::forget('produtos_lista_user_' . $userId);
    }
}