<?php

namespace App\Domain\Employee\Service;

use App\Http\Controllers\Controller;
use App\Domain\Employee\Dao\Employee;
use App\Domain\Employee\Entity\Employee as EntityEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

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

        $user = EntityEmployee::where('email', $request->email)->first();
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                return redirect('/admin/' . $user->id);
            }
        }

        return redirect()->back()->with('failed_login', 'Wrong password or username!')->withInput();
    }
}
