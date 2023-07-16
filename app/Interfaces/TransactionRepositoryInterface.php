<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function getTransaction(int $wallet_id);
}