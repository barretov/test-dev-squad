<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Method for return all users
     *
     * @return object users of system
     */
    public function list()
    {
        return \Response::json(User::all(), 200);
    }
}
