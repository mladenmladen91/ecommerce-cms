<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{

    public function token() {
        /** @var User $user */
        $user = Auth::user();
        $accessToken = $user->createToken('authToken');

        return response()->json(["accessToken" => $accessToken->accessToken]);

    }

    public function index()
    {
        return view('layout');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function doLogin()
    {
        $validator = Validator::make(Request::all(), [
            'email' => 'required',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Request::except('password'));
        }

        $userdata = [
            'username' => Request::get('email'),
            'password' => Request::get('password')
        ];

        return Auth::attempt($userdata) ? Redirect::to('home') : Redirect::to('login');
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }
}
