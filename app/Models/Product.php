<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'image',
        'price',
        'stock'
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'product_id')->select('id', 'transaction_id', 'product_id', 'quantity', 'subtotal');
    }
}
