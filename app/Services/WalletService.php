<?php

namespace App\Services;

use App\Traits\Response;
use Illuminate\Http\Request;
use App\Repositories\WalletRepository;

class WalletService {
    use Response;
    protected $walletRepository;

    public function __construct(WalletRepository $walletRepository) {
       $this->walletRepository = $walletRepository;
    }

    public function registerWallet(){
        $wallet = $this->walletRepository->getOrCreateWallet(request('user_id'));
        return $wallet;
    }
    
    public function getDetail(int $wallet_id) {
        $detail = $this->walletRepository->getWalletDetail($wallet_id);
        return $detail;
    }

    public function topup(Request $request) {
        $topup = $this->walletRepository->increaseBalance($request->amount);
        return $topup;
    }

    public function transfer(Request $request) {
        return $this->walletRepository->transferBalance( $request->wallet_id, $request->amount);
    }

    public function widtraw(Request $request) {
       $topup = $this->walletRepository->witdrawBalance($request->amount);
       return $topup;
    }


}
