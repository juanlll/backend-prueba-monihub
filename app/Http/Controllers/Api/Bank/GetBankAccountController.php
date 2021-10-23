<?php
namespace App\Http\Controllers\Api\Bank;
use App\Http\Controllers\AppBaseController;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class GetBankAccountController extends AppBaseController{

    public function __invoke(String $bankAccountNumber){

        $bankAccount = BankAccount::where('account_number',$bankAccountNumber)->with('movements')->first();
        if(is_null($bankAccount)){
            return $this->sendError('No hay ninguna cuenta con ese numero!',404);
        }

        return $this->sendResponse($bankAccount,'cuentas listadas!');
    }

}
