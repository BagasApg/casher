<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [
        'id',
        'timestamps'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function details(){
        return $this->hasMany(TransactionDetail::class);
    }

    use HasFactory;
}
