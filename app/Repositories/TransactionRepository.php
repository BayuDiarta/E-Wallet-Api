<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getTransaction(int $wallet_id){
        return Transaction::latest()->select('wallet_id', 'amount', 'type')->where('wallet_id','=', $wallet_id)->paginate(request('limit'));
    }
}
