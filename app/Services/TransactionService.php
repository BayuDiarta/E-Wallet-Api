<?php

namespace App\Services;

use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\TransactionRepository;

class TransactionService {
    use Response;
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository) {
       $this->transactionRepository = $transactionRepository;
    }

    public function transaction(int $wallet_id)
    {
       return $this->transactionRepository->getTransaction($wallet_id);
    }
}