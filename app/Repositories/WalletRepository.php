<?php

namespace App\Repositories;

use Exception;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public function getOrCreateWallet(int $user_id){
        return Wallet::firstOrCreate([
                'user_id' => $user_id
            ],[
                'balance' => 0,
            ]);
    }

    public function getWalletDetail(int $id) {
       return Wallet::whereId($id)->with(['transactions' => function($trs){
            return $trs->orderBy('created_at','desc')->limit(request('limit'));
        }])->firstOrFail();
    }

    public function transferBalance(int $wallet_id, float $amount) {
        return DB::transaction(function () use ($wallet_id, $amount) {
            $user = auth()->user();
            $source = $user->wallet;

            if ($source->balance < $amount) {
                throw new Exception("Your balance is not sufficient");
            }

            $source->decrement('balance', $amount);

            $source->transactions()->create([
                'type' => Transaction::TYPE_DEBIT,
                'amount' => $amount,
            ]);

            $target = Wallet::find($wallet_id);

            if (!$target) {
                throw new Exception("Wallet id not found");
            }

            $target->increment('balance', $amount);

            $target->transactions()->create([
                'type' => Transaction::TYPE_CREDIT,
                'amount' => $amount,
            ]);

            return $source;
        });
    }

    public function checkBalance(int $wallet_id){
        $wallet = Wallet::whereId($wallet_id)->first();
        if (empty($wallet)) {
            throw new Exception("Wallet id not found");
        }

        return $wallet->balance;
    }

    public function decreaseBalance(float $amount)
    {
        $wallet_id = auth()->user()->wallet->id;
        return DB::transaction(function () use ($wallet_id, $amount) {
            $wallet = Wallet::findOrFail($wallet_id);

            if($wallet->ballance < $amount) {
                throw new Exception("Wallet Not Enought");
            }
            $wallet->balance -= $amount;
            $wallet->save();

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => Transaction::TYPE_DEBIT,
                'amount' => $amount,
            ]);

            return $wallet;
        });
    }

    public function increaseBalance(float $amount)
    {
        $wallet_id = auth()->user()->wallet->id;
        return DB::transaction(function () use ($wallet_id, $amount) {
            $wallet = Wallet::findOrFail($wallet_id);

            $wallet->balance += $amount;
            $wallet->save();

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => Transaction::TYPE_CREDIT,
                'amount' => $amount,
            ]);

            return $wallet;
        });
    }

    public function witdrawBalance(float $amount)
    {
        $wallet_id = auth()->user()->wallet->id;
        return DB::transaction(function() use ($wallet_id, $amount) {
            $wallet = Wallet::findOrFail($wallet_id);

            if($wallet->balance < $amount) {
                throw new Exception("Wallet Not Enought");
            }

            $wallet->balance -= $amount;
            $wallet->save();

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => Transaction::TYPE_WITDRAW,
                'amount' => $amount,
            ]);

            return $wallet;
        });
    }
}
