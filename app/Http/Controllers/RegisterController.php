<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\City;
use App\Privilege;
use App\Employee;
use Validator;
use Hash;
use PDF;


class RegisterController extends Controller
{
    public function index(){
	
	 $city = new City();
	 $city=$city->citySelect();
	 
	 $privilege = new Privilege();
	 $privilege=$privilege->privilegeSelect();
	 
	 $employee = new Employee();
	 
	 return view('register-employee', [
									 'city' => $city,
									 'privilege' => $privilege,
									 'employee' => $employee,
									 'disabled' => null,
									 ]);
	}
	
	
public function save(Request $request){
	 //return $request;
		$inputs = $request->all();

		if(isset($request->employeeId) and $request->employeeId!=''){
        $rules = array(
            'employeeName' => 'required|max:20',
            'employeeAddress' => 'required|max:45',
            'employeePhone' => 'max:20|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
            'employeeCityId' => 'required|exists:city,cityId',
			'employeePrivilegeId' => 'required|exists:privilege,privilegeId',
			'employeeEmail' => 'required|email',
        );
		}else{
        $rules = array(
            'employeeName' => 'required|max:20',
            'employeeAddress' => 'required|max:45',
            'employeePhone' => 'max:20|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
            'employeeCityId' => 'required|exists:city,cityId',
			'employeePrivilegeId' => 'required|exists:privilege,privilegeId',
			'employeeEmail' => 'required|email|unique:Employee,username',
            'password' => 'required|min:6|max:20|confirmed',
        );			
		}

	$validation = Validator::make($inputs, $rules);

	if($validation->fails()){
     return redirect()->back()
                 ->withErrors($validation)
                 ->withInput();
	  }else{ 
		 //if data is validated,type the code to insert data and retunn to the target page.   

			if(isset($request->employeeId) and $request->employeeId!=''){
			//updateing
		 	$employee = Employee::find($request->employeeId);
			$employee->fill($request->all());
			$employee->save();

			}else{
			//Generating password and hashes
			$password = $request->input('password');

			$passwordStaticSalt= "anyWord@134";

			$hashedPassword = Hash::make($password.$passwordStaticSalt);

			if(Hash::check($password.$passwordStaticSalt, $hashedPassword)){
				
				//inserting employee with hashed password
				
				$employee = new Employee;
				$employee->fill($request->all());
				$employee->password = $hashedPassword;

				$employee->username = $request->employeeEmail;
				$employee->save();

			}
			}
			 $msg="Success";
			 return redirect()->back()->with('successmsg', $msg);
			
		}
	 
	}
	public function list(){
		 $employee = Employee::Select()
					->OrderBy("employeeName", "ASC")
					->get();
		//return $employee;
		
		return view('employee-list', [
										'employee'=>$employee,
										]);
	}
	
    public function edit($id = null){
	 $employee = Employee::find($id);
	 //return $employee;
	 
	 
	 $city = new City();
	 $city=$city->citySelect();
	 
	 $privilege = new Privilege();
	 $privilege=$privilege->privilegeSelect();
	 
	 return view('register-employee', [
									 'city' => $city,
									 'privilege' => $privilege,
									 'employee' => $employee,
									 'disabled' => 'disabled',
									 ]);
	}
	
		public function delete(Request $request)
	{
		$employee = Employee::find($request->employeeId);
		$employee->delete();
		return redirect('/employee-list');

	}
	
		public function pdf()

	{
			 $employee = Employee::Select()
					->OrderBy("employeeName", "ASC")
					->get();

		$pdf = PDF::loadView('pdf-list',[	
											'employee'=>$employee,]);
		return $pdf->download('employeelist.pdf');
	}


}	