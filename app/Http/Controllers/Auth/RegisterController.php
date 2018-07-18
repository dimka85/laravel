<?php

namespace App\Http\Controllers\Auth;

use App\Http\Services\FileUploader;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\VerifyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
     * @param  \App\Http\Services\FileUploader $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->middleware('guest');
        $this->uploader = $uploader;
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
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
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        $user->avatar = $this->uploader->uploadAvatar($user->id, $data['avatar']);
        $user->save();
        
        $this->createVerificationToken($user);
        
        return $user;
    }
    
    /**
     * Handle a registration request for the application /override/.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        event(new Registered($user = $this->create($request->all())));
        
        $this->guard()->login($user);
        
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
    
    /**
     * The user has been registered /override/.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        
        return redirect()->route('login')
            ->with('status', __('Activation code was sent to your E-Mail address. Check it to verify.'));
    }
    
    /**
     * Verify user E-Mail.
     *
     * @param  string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($token)
    {
        $verifyUser = VerifyUser::where('verification_token', $token)->first();
        
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            
            if (!$user->verified) {
                $user->verified = true;
                $user->save();
                
                $status = __('Your E-Mail is verified. You can now login.');
            } else {
                $status = __('Your E-Mail is already verified. You can login.');
            }
        } else {
            return redirect()->route('login')->with(
                'warning',
                __('Sorry your E-Mail cannot be identified.')
            );
        }
        
        return redirect()->route('login')->with('status', $status);
    }
    
    /**
     * Create verification token for registered user.
     *
     * @param  User $user
     * @return void
     */
    protected function createVerificationToken($user)
    {
        $user->verifyUser()->create(['verification_token' => str_random(50)]);
    }
}
