<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\AgpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function show()
    {
        return view("client.login.show");
    }

    public function login(Request $data)
    {
        $user=User::query()->where("email",$data->get("email"))->firstOrFail();
        if (!$user->exists())
        {
            return back()->withErrors('ایمیل وارد شده صحیح نیست');
        }
        if (Hash::check($data->get("password"),$user->password))
        {
            auth()->login($user);
            return redirect(Route("shop_home"));
        }
        else
        {
            return back()->withErrors('کلمه عبور وارد شده صحیح نیست');
        }
    }

    public function edit()
    {
        return view("client.login.recovery");
    }

    public function update(Request $data)
    {
        $user=User::query()->where("email",$data->get("email"))->firstOrFail();
        if (!$user->exists())
        {
            return back()->withErrors('ایمیل وارد شده صحیح نیست');
        }
        $agp=random_int(111111,999999);
        $user->update(
            [
                'password'=>bcrypt($agp)
            ]
        );

        Mail::to($user->email)->send(new AgpMail($agp));

        return redirect(Route("register.code_chk",$user));
    }
}
