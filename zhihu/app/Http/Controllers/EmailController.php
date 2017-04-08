<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function verify($token)
    {
        $user = User::where('confirmationToken', $token)->first();

        if (is_null($user)) {
            flash('邮箱验证失败...', 'error');
            return redirect('/');
        }

        $user->isActive = 1;
        $user->confirmationToken = str_random(40);
        $user->save();
        Auth::login($user);
        flash('邮箱验证成功:-D', 'success');

        return redirect('/home');
    }
}
