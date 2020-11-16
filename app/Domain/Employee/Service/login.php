<?php

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use App\Domain\Employee\Dao\EmployeeDB as Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $employee = $this->emp->findEmployee($request);
        if (isset($employee)) {
            if (Hash::check($request->password, $employee->password)) {
                return redirect('/admin')->with('employee', $employee);
            }
        }

        return redirect()->back()->with('failed_login', 'Wrong password or username!')->withInput();
    }
}
