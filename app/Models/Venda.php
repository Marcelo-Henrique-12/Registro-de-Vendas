<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'user_id','cliente_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'vendas_produtos')->withPivot('quantidade');
    }
}
