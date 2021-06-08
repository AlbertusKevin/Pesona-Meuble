<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Service\AuthService;
use App\Domain\Warehouse\Service\MeubleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    private $auth_service;

    public function __construct()
    {
        $this->auth_service = new AuthService;
    }

    public function login_view()
    {
        if($this->checkCookies() || session()->has('login'))
            return redirect('/meuble');
        return view('employee.login.login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $auth = $this->auth_service->login_service($request);
        if ($auth) {
            if($request->has('remember'))
                $this->setCookies($request->email);
            return redirect('/meuble')->with(['type' => "success", 'title' => 'Login Successful !']);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with(['type' => "error", 'title'=> 'Login Failed', 'message' => 'Username or password is incorrect !']);
    }

    private function setCookies($email) {
        Cookie::queue('login', $email, 1);
    }

    private function checkCookies() {

        return Cookie::has('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/')
            ->withCookie(Cookie::forget('login'))
            ->with(['type' => "success", 'title' => 'You\'ve been logged out.']);
    }


}
