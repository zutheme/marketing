<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // protected function login(){ 
    //     if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
    //         $user = Auth::user(); 
    //         $success['token'] =  $user->createToken('MyApp')->accessToken; 
    //         return redirect()->route('admin.aduser.index')->with('success','login success');
    //     } 
    //     else{
    //         $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
    //         return redirect()->back()->withInput()->withErrors($errors);
    //     } 
    // }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    // public function getLogin() {
    //   return view('login');
    // }
    public function getLogin()
    {
        if (Auth::check()) {
            $user = Auth::user(); 
            return redirect()->route('admin.adsvcustomer.index')->with('success',$user->name);
        } else {
            return view('login');
        }

    }
    public function postLogin(Request $request) {
      $rules = [
        'email' =>'required|email',
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
        $email = $request->input('email');
        $password = $request->input('password');

        if( Auth::attempt(['email' => $email, 'password' =>$password])) {
           $user = Auth::user(); 
           $success['token'] =  $user->createToken('MyApp')->accessToken; 
           //return redirect()->intended('dashboard');
           return redirect()->route('admin.adsvcustomer.index')->with('success',$user->name);

        } else {
          $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
          return redirect()->back()->withInput()->withErrors($errors);
        }
      }
    } 
   
}
