<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\MyClasses\Util;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MailChangeController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        // ここはauthにしておく
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    public function mailChange(Request $request)
    {
        $array = $request->all();
        $array['email'] = Util::mbTrim($request->input('email'));
        $validator = Validator::make($array, [
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users', 'ends_with:@gmail.com'],
        ]);

        if ($validator->fails()) {
            return redirect('/mypage')
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $user->email = $array['email'];
        $user->email_verified_at = null;
        $user->save();

        $user->notify(new VerifyEmail());

        return redirect('/');
    }
}
