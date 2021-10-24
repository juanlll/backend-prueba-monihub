<?php
namespace App\Http\Controllers\Api\Bank;
use App\Http\Controllers\AppBaseController;

class GetBanksController extends AppBaseController{

    public function __invoke(){
        $banks = [
            'BANCOLOMBIA',
            'BANCO SANTANDER',
            'BANCO COLPATR',
            'BANCO BBVA'
        ];
        return $this->sendResponse($banks,'bancos listados!');
    }

}
