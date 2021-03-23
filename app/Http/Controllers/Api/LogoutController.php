<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends BaseController
{
    public function logout()
    {
        if (Auth::check()) {
            $user = Auth::user()->token();
            $user->revoke();
            return $this->sendResponse('شما با موفقیت از سایت خارج شده اید.');
        }
        return $this->sendError('شما در سایت وارد نشده اید.');
    }
}
