<?php

namespace App\Models;

use Wallet;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{

   const TYPE_CREDIT = 'credit';
   const TYPE_WITDRAW = 'witdraw';
   const TYPE_DEBIT = 'debit';

   protected $fillable = ['wallet_id', 'amount', 'type'];

   public function wallet()
   {
    return $this->belongsTo(Wallet::class);
   }
   
}