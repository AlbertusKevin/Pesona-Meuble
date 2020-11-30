<?php

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use App\Domain\Employee\Dao\EmployeeDB as Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class Login extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    private $emp;

    public function __construct()
    {
        $this->emp = new Employee();
    }

    public function login_view()
    {
        return view('employee_service.login.login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $employee = $this->emp->findByEmail($request);

        if (isset($employee)) {
            $check = Hash::check($request->password, $employee->password);
            if ($check) {
                // Session::put('username', $employee->name);
                // Session::put('id', $employee->id);
                session(['login' => true, 'id_employee' => $employee->id]);
                return redirect('/admin');
            } else {
                return redirect()->back()->with('failed_login', 'Wrong password or username!')->withInput();
            }
        } else {
            return redirect()->back()->with('failed_login', 'Wrong password or username!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function homeAdmin()
    {
        return view('employee_service.home');
    }
}
