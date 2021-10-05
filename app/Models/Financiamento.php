<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financiamento extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id','valor_total','total_parcelas','data_financiamento'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }
    public function converter_data()
    {
        return date('Y-m-d', strtotime($this->data_financiamento));    
    }
}
