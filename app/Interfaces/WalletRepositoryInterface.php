<?php

namespace App\Interfaces;

interface WalletRepositoryInterface
{
    public function getOrCreateWallet(int $user_id);

    public function getWalletDetail(int $id);

    public function transferBalance(int $wallet_id, float $amount);

    public function checkBalance(int $wallet_id);

    public function decreaseBalance(float $amount);

    public function increaseBalance(float $amount);

    public function withdrawBalance(float $amount);
}
