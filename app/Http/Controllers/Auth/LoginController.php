<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    //use AuthenticatesUsers;
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectTo);
    }

    protected function validateLogin(Request $request)
    {
        return $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function login(Request $request){
        
        $this->validateLogin($request);
        $username = $request->username;
        $password = $request->password;

        $userAdmin = User::where('username', $username)?->get()->first();
        
        if ($userAdmin){
            if ($userAdmin->role === 'admin' && Hash::check($password, $userAdmin->password)) {
                $this->guard()->login($userAdmin);
    
                return redirect()->route('home');
            }
        }
        
        $req = Http::post('http://10.143.41.70:8000/promo2/odcapi/?method=login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $req = json_decode($req->body());
        
        if(isset($req->user)){
            $user = User::Where(['username'=>$request->username])?->get()->first();
            if(!$user){
                $user = User::create([
                    'name' => $req->user->first_name,
                    'first_name'=> $req->user->last_name,
                    'username'=> $request->username,
                    'email' => $req->user->email,
                    'phone' => $req->user->phone,
                    'password' => Hash::make("password"),
                    'profil_complete' => false,
                ]);
            }
            if($user->status == 1){
                $this->guard()->login($user);
            }else{
                return $this->sendFailedLoginResponse($request);
            }

            if (!$user->profil_complete){
                return redirect()->route('profile.edit',auth()->user());
            }

            return $this->sendLoginResponse($request);
        }else{

            return $this->sendFailedLoginResponse($request);
        }
    }
        /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }
    public function username()
    {
        return 'username';
    }
        /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}