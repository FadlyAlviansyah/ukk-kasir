<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_id',
        'user_id',
        'points_used',
        'total',
        'amount_paid',
        'amount_change',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'email', 'name', 'role');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id')->select('id', 'name', 'phone_number', 'points', 'created_at');
    }

    public function transactionDetail(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id')->select('id', 'transaction_id', 'product_id', 'quantity', 'subtotal');
    }
}
