<?php
namespace App\Http\Controllers\Api\Bank;
use App\Http\Controllers\AppBaseController;

class GetCurrenciesController extends AppBaseController{

    public function __invoke(){
        $currencies = [
            'COP',
            'ARG',
            'CLP',
            'CAD',
            'USD',
            'KYD',
            'NZD'
        ];
        return $this->sendResponse($currencies,'tipos de monedas listadass!');
    }

}
