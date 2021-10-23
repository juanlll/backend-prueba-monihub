<?php
namespace App\Http\Controllers\Api\Bank;
use App\Http\Controllers\AppBaseController;
use App\Models\BankAccount;
use App\Models\Movement;
use Illuminate\Support\Facades\Request;

class DepositMoneyController extends AppBaseController{

    public function __invoke(Request $request){
        $input          = $request::all();
        $bankAccount    = BankAccount::with('movements')->where('account_number',$input['account_number'])->first();
        $beforeMovement = sizeof($bankAccount->movements) > 0 ? $bankAccount->movements[0]: null;
        $currentMoney   = !is_null($beforeMovement) ? $beforeMovement->current_money + $input['amount'] : 0;
        $oldMoney       = !is_null($beforeMovement) ? $beforeMovement->current_money : 0;

        if($input['amount'] > 90000000){
            return $this->sendError('No puedes depositar mas dinero del valido por transacción!!',400);
        }

        $movement = Movement::create([
            'bank_account_id'   => $bankAccount->id,
            'current_money'     => $currentMoney,
            'old_money'         => $oldMoney,
            'amount'            => $input['amount'],
            'type'              => 'TO_DEPOSIT'
        ]);

        return $this->sendResponse($movement, 'Dinero depositado correctamente!');
    }

}
