<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Employee;
use Hash;
use Auth;

class LoginController extends Controller
{
	public function index(){
		return view('/login');
	}
	
	public function validation(Request $request){
		$username = $request->username;
		$password = $request->password;
		$passwordStaticSalt="anyWord@134";
		//check if user exist
		$employee = Employee::select()
						->where('username','=',$username)
				->get();
		

		
		//check if there is only one user with the username
		if($employee->count() == 1){
			//check if hashed password matchs
			if (Hash::check($password.$passwordStaticSalt, $employee[0]->password)){
				
				 if (Auth::attempt(['employeeId' => $employee[0]->employeeId, 'password' => $password.$passwordStaticSalt], FALSE)){						
					return redirect('/register');	
				}else{
					return redirect('/login',['errorLogin' => 'Login Fail !']);
				}
			}else{
			return view('/login', ['errorLogin' => 'Please check your password !']);
						
			}
		}else{
			return view('/login', ['errorLogin' => 'Please check your username !']);
					
		}
		
	}
	//user logout	
	public function logout(Request $request){
		Auth::logout();
		return redirect('/login');
	}
	
	public function pastel() {
		return 'indiano com chucrute';
	}
	
}



