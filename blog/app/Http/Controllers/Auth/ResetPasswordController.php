<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function validator(array $data)
    {

        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        return Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);
    }
    public function changePassword(Request $request)
    {
        if(Auth::check()){
            $request_data = Request()->all();
            $validator = $this->validator($request_data);
            if($validator->fails()){
                return back()->withErrors($validator->getMessageBag());
            }else{
                $currentPassword = Auth::user()->password;
                if(Hash::check($request_data['current-password'], $currentPassword)){
                    $user  = User::find(Auth::user()->id);
                    $user->password = bcrypt($request_data['password']);
                    $user->save();

                    return redirect()->route('blog.index');
                }
                
            }
        }else{
            return redirect()->route('login');
        }
    }

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::REDIRECT;
}
