<?php
/**
 * Created by PhpStorm.
 * User: ASTO-22
 * Date: 11/4/2019
 * Time: 10:43
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

//use http\Client\Curl\User;
use App\Models\Role;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
//        dd($request->all());
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
//            dd($request->remember_me);
            $email = $request->email;
            $password = $request->password;
            $remember = $request->remember_me;
//
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember) || Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->back()->with('fail', 'Email hoặc mật khẩu không đúng')->withInput();
            }
        }


    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function getResetpass()
    {
        return view('auth.resetpassword');
    }

    public function postReset(Request $request)
    {
//        dd($request->all());
        $user = User::where('email', '=', $request->email)->first();
//        dd($user);
        if ($user !== null) {
            $user->update(['password' => Hash::make($request->password1)]);
            return redirect()->route('login')->with('success', 'Thành công');
        } else {
            return redirect()->route('resetpass')->with('fail', 'Email không tồn tại');
        }
    }
    public function getRegisteruser()
    {
        $roles=Role::all();
        return view('auth.registeruser',compact('roles'));
    }
    public function postRegisteruser(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'role_id' => 'required',
        ];
        $messages = [
            'name.required' => __('user.name').__('general.required'),
            'password.required' => __('user.password').__('general.required'),
            'email.required' => __('user.email').__('general.required'),
            'email.unique' => __('user.email').__('general.exist'),
            'role_id.required' => __('user.role').__('general.required'),
        ];
        $user = User::where('email', '=', $request->email)
            ->first();
        if ($user == null) {
            $user = new User();
        };
        $user->rules['email'] = 'required|unique:users,email,'.$user->id.',id,deleted_at,NULL';

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        try {
            $user->save();
            return redirect()->route('login')->with('success', 'Thành công');
        }catch (\Exception $exception)
        {
            return redirect()->route('registeruser')->with('fail', __('Đăng ký thất bại'));
        }
    }
}
