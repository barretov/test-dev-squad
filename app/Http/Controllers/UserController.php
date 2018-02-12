<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /**
     * Method for return all users
     *
     * @return object users of system
     */
    public function index()
    {
        return \Response::json(User::all(), 200);
    }
}
