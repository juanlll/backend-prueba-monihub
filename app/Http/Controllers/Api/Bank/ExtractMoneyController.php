<?php
namespace App\Http\Controllers\Api\Bank;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ExtractMoneyRequest;
use App\Models\BankAccount;
use App\Models\Movement;
use Illuminate\Support\Facades\Request;

class ExtractMoneyController extends AppBaseController{

    public function __invoke(ExtractMoneyRequest $request){

        $input          = $request->all();
        $bankAccount    = BankAccount::with('movements')->where('account_number',$input['account_number'])->first();

        if(is_null($bankAccount)){
            return $this->sendError('No existe ninguna cuneta con ese numero!',400);
        }

        $beforeMovement = sizeof($bankAccount->movements) > 0 ? $bankAccount->movements[0]: null;
        $currentMoney   = !is_null($beforeMovement) ? $beforeMovement->current_money - $input['amount'] : 0;
        $oldMoney       = !is_null($beforeMovement) ? $beforeMovement->current_money : 0;

        if($oldMoney < $input['amount']){
            return $this->sendError('No puedes retirar mas dinero del que tienes!',400);
        }

        $movement = Movement::create([
            'bank_account_id'   => $bankAccount->id,
            'current_money'     => $currentMoney,
            'old_money'         => $oldMoney,
            'amount'            => $input['amount'],
            'type'              => 'TO_EXTRACT'
        ]);

        return $this->sendResponse($movement, 'Dinero extraido correctamente!');
    }

}
