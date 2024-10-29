<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade as PDF;

class InvestmentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'investment_id',
        'user_id',
        'amount',
        'card_number',
        'card_expiry',
        'card_cvc'
    ];
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
