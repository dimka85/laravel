<?php

namespace App\Http\Controllers\Auth;

use App\Http\Services\FileUploader;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    /**
     * FileUploader instance.
     *
     * @var \App\Http\Services\FileUploader
     */
    protected $uploader;
    
    /**
     * Create a new controller instance.
     *
     * @param \App\Http\Services\FileUploader $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->middleware('guest');
        $this->uploader = $uploader;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|min:1|max:20',
            'last_name' => 'required|string|min:1|max:30',
            'nickname' => 'required|string|min:2|max:30|unique:users',
            'email' => 'required|string|email|min:3|max:255|unique:users',
            'password' => 'required|string|min:6|max:30|confirmed',
            'password_confirmation' => 'required|string|min:6|max:30',
            'avatar' => 'required|image|mimes:jpeg,png|max:2000',
            'terms' => 'required|accepted',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    /**
     * The user has been registered /override/.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, User $user)
    {
        $user->avatar = $this->uploader->uploadAvatar($user->id, $request->avatar);
        $user->save();
    }
}
