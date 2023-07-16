<?php

namespace App\Http\Controllers\API;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    use Response;
    protected $transactionService;

    public function __construct(TransactionService $transactionService) {
       $this->transactionService = $transactionService;
    }

    public function transaction(){
        $wallet_id = auth()->user()->wallet->id;
        if(empty($wallet_id)) {
            return $this->errorResponse(null, 'wallet ID not found', 404);
        }
        $transaction = $this->transactionService->transaction($wallet_id);
        if(empty($transaction)) {
            return $this->errorResponse(null, 'Failed to retrieve wallet detail', 500);
        }
        return $this->successResponse( $transaction, 'Successfully Get Detail Wallet');
    }
}

