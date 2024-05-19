<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;

use App\Models\Email;

use App\Mail\WebsiteContact;

class EmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['send']]);
    }

    public function send(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->messages()]);
        }

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['comments'] = $request->input('comments');

        $email = new WebsiteContact($data);
        $result = Mail::to('brickmmo@gmail.com')->send($email);
        // $messageId = $result->getSymfonySentMessage()->getMessageId();

        return response()->json([
            'status' => 'success',
            'message' => 'Email has been sent successfully',
        ]);

    }

}