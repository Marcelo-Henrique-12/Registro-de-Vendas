<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = "produtos";

    protected $fillable = [
        'nome',
        'valor',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'vendas_produtos')->withPivot('quantidade');
    }
}
