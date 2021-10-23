<?php

namespace App\Http\Responses\Utlis;

class ResponseUtil
{
    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    public static function makeResponse($message, $data)
    {
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
    }

    /**
     * @param string $message
     * @param array  $errors
     *
     * @return array
     */
    public static function makeError($message, array $errors = [])
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $res['errors'] = $errors;
        }

        return $res;
    }
}
