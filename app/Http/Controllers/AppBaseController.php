<?php

namespace App\Http\Controllers;
use App\Http\Responses\Utlis\ResponseUtil;
use Response;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($message, $code = 404, $errors = [])
    {
        return Response::json(ResponseUtil::makeError($message, $errors), $code);
    }
}
