<?php

namespace App\Http\Controllers\Filter;

use App\Filters\UserFilter;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFilterController extends Controller
{
    public function index(User $user, UserFilter $filters)
    {
        return $user->filter($filters)->paginate();
    }
}
