<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerVerification extends Model
{
    /** @use HasFactory<\Database\Factories\SellerVerificationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'note',
        'verified_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
