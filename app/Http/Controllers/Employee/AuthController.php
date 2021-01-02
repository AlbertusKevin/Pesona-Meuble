<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Service\AuthService;
use App\Domain\Warehouse\Service\MeubleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $meuble_service;
    private $auth_service;

    public function __construct()
    {
        $this->meuble_service = new MeubleService;
        $this->auth_service = new AuthService;
    }

    public function login_view()
    {
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
            return redirect('/admin');
        }
        return redirect()->back()->with('failed_login', 'Wrong password or username!')->withInput();
    }

    public function home_admin()
    {
        $meubles = $this->meuble_service->index_meuble();
        return view('employee.home', compact('meubles'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
