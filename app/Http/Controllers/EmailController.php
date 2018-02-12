<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Method for send email for invite a new user
     * @param  Request $request User email
     * @return String           Confirmation message
     */
    public function emailInvite(Request $request)
    {
        Mail::to($request->input('email'))->send(new Email('Invitation'));
        return json_encode(['message' => 'E-mail sent']);
    }
}
