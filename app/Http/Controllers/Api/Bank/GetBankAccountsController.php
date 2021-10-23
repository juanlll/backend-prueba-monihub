<?php
namespace App\Http\Controllers\Api\Bank;
use App\Http\Controllers\AppBaseController;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class GetBankAccountsController extends AppBaseController{

    public function __invoke(){
        $bankAccounts = BankAccount::all();
        return $this->sendResponse($bankAccounts,'cuentas listadas!');
    }

}
