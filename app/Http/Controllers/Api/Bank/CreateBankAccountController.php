<?php
namespace App\Http\Controllers\Api\Bank;
use App\Http\Controllers\AppBaseController;
use App\Models\BankAccount;
use App\Models\Movement;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateBankAccountRequest;

class CreateBankAccountController extends AppBaseController{

    public function __invoke(CreateBankAccountRequest $request){

        DB::beginTransaction();

        $bankAccount = BankAccount::create($request->all());
        if(is_null($bankAccount)) DB::rollBack();

        $movement = Movement::create([
            'type'=>'TO_DEPOSIT',
            'bank_account_id' => $bankAccount->id,
            'current_money'=> $bankAccount->initial_account_balance,
            'amount'=>$bankAccount->initial_account_balance
        ]);

        if(is_null($movement)) DB::rollback();

        DB::commit();

        return $this->sendResponse($bankAccount,'Cuenta creada!');

    }

}

