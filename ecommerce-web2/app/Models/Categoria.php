<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'slug',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function forUser(int $userId)
    {
        return Cache::remember('categorias_lista_user_' . $userId, 86400, function () use ($userId) {
            return self::where('user_id', $userId)->get();
        });
    }

    public static function clearUserCache(int $userId)
    {
        Cache::forget('categorias_lista_user_' . $userId);
    }
}