<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function sendResponse($result, $message = null , $json = true)

    {

        $response = [
            'success' => 1,

            'data'    => $result,

            'message' => $message

        ];
        if ($json == true)
            return response()->json($response , 200);

        return $response;

    }


    /**

     * return error response.

     *

     * @return \Illuminate\Http\Response

     */

    public function sendError($error, $json = true , $errorMessages = [] , $code = 200)

    {

        $response = [

            'success' => 0,

            'message' => $error,

        ];


        if(!empty($errorMessages)){

            $response['data'] = $errorMessages;

        }

        if ($json == true)
            return response()->json($response, $code);

        return $response;

    }
}
