<?php

namespace App\Http\Controllers\Api;

use App\Advertising;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends BaseController
{
    public function get($id)
    {

        $decrypt = array(
            "0" => "QpSj",
            "1" => "bSJC",
            "2" => "rAud",
            "3" => "RsFy",
            "4" => "hNma",
            "5" => "qaWJ",
            "6" => "kVrE",
            "7" => "LwBl",
            "8" => "HbUf",
            "9" => "xRgj",
        );

        if (strlen($id) < 5) {
            return $this->sendError("دسترسی رد شد");
        }

        $Token = substr($id, 0, 4);

        if (!in_array($Token, $decrypt)) {
            return $this->sendError("دسترسی رد شد");
        }

        $PostId = str_replace($Token, '', $id);

        $decryptID = substr($PostId, 0, 1);

        if ($decrypt[$decryptID] != $Token) {
            return $this->sendError("دسترسی رد شد");
        }

        $Advertising = Advertising::find($PostId);

        if (empty($Advertising)) {
            return $this->sendError("دسترسی رد شد");
        }

        //check place and return phone number
        $phone = (!$Advertising->sale->in_place ? $Advertising->user->phone_number : Config::get('constants.options.PHONE_MASHINCHI'));



        return $this->sendResponse($phone, null);

    }
}
