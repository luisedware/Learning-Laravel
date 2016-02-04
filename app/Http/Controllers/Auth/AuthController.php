<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Gregwar\Captcha\CaptchaBuilder;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /*设置成功登录后转向的页面*/
    protected $redirectPath = "index";

    /*设置登录失败后转向的页面*/
    protected $loginPath = "/auth/login";

    /*设置退出登录后转向的页面*/
    protected $redirectAfterLogout = "/auth/login";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        $builder = new CaptchaBuilder();
        $builder->build();
        Session::put('phrase', $builder->getPhrase());

        return view('auth.login')->with('captcha', $builder->inline());
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        // 验证登录表单
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password'             => 'required',
            'captcha'              => 'required'
        ], [
            $this->loginUsername() . '.required' => '请输入邮箱或用户名称',
            'password.required'                  => '请输入用户密码',
            'captcha.required'                   => '请输入验证码'
        ]);

        // 验证登录验证码
        if (Session::get('phrase') !== $request->get('captcha')) {
            return redirect()->back()->withErrors(array('captcha' => '验证码不正确'))->withInput();
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        //验证保持登录的用户验证
        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
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
            'name'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ], [
            'name.required'                  => '用户名不能为空',
            'email.required'                 => '用户邮箱不能为空',
            'password.required'              => '用户密码不能为空',
            'password.min'                   => '用户密码至少6位',
            'password_confirmation.required' => '确认密码不能为空',
            'email.email'                    => '请输入正确的邮箱格式',
            'email.unique'                   => '该邮箱已被使用',
            'password.confirmed'             => '确认密码不一致',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
