<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\user_create_rules;
use App\Http\Requests\user_passchk_rules;
use App\Mail\AgpMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view("client.register.create");
    }

    public function store(user_create_rules $data)
    {
        $user_chk=User::query()->where("email",$data->get("email"));
        if ($user_chk->exists())
        {
            return back()->withErrors("یک حساب کاربری قبلا با این ایمیل ثبت شده است");
        }

        $agp=random_int(111111,999999);
        $user=User::query()->create(
            [
                'name'=>$data->get("name"),
                'email'=>$data->get("email"),
                'role_id'=>Role::findByTitle("simple_user")->id,
                'password'=>bcrypt($agp)
            ]
        );

        Mail::to($data->get("email"))->send(new AgpMail($agp));

        return redirect(Route('register.code_chk',$user));
    }

    public function code_create(User $user)
    {
      return view("client.register.code_chk",
      [
          'user'=>$user
      ]
      );
    }

    public function code_chk(user_passchk_rules $data, User $user)
    {
        if (Hash::check($data->get("password"),$user->password))
        {
            auth()->login($user);
            return redirect(Route("shop_home"));
        }
        {
            return back()->withErrors("incorrect code",
            "کد وارد شده صحیح نیست");
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect(Route("shop_home"));
    }
}
