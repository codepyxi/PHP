@extends('master')
@section('title', 'register')
@section('content')


	<div class="card shadow mb-4">
	  	@if(Session::has('successmsg'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>{{Session::get("successmsg")}}</strong> 
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		@endif
		<!--ERROR-->
		@if (count($errors) > 0)
			<div class="alert alert-danger alert-dismissible" role="alert">
			   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				 <ul>
				   @foreach ($errors->all() as $error)
					   <li>{{ $error }}</li>
				   @endforeach
				 </ul>
			 </div>
		@endif
		<!--/ERROR-->
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Employee</h6>
            </div>
            <div class="card-body">
              <form class="user" action="/register" method="post">
			   <input type="hidden" name="_token" value="{{csrf_token()}}"/>
			     @if($employee->employeeId!='' || old('employeeId')!='')
                        <input name="employeeId" type="hidden"  value="{{$employee->employeeId or old('employeeId')}}">
                 @endif
											
                <div class="form-group">
                  <input type="text" name="employeeName" value="{{$employee->employeeName or old('employeeName')}}" class="form-control form-control-user"  placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="text" name="employeeAddress" value="{{$employee->employeeAddress or old('employeeAddress')}}" class="form-control form-control-user" placeholder="Address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="employeePhone" value="{{$employee->employeePhone or old('employeePhone')}}" class="form-control form-control-user"  placeholder="Phone">
                  </div>
				  
                  <div class="col-sm-6">
					<select class="form-control" name="employeeCityId">
						<option value="">Select City</option>
						@foreach($city as $row)
						<option value="{{$row->cityId}}" @if($row->cityId==$employee->employeeCityId || $row->cityId==old('employeeCityId')) Selected @endif >{{$row->cityName}}</option>
						@endforeach
					</select>  
                  </div>
                </div>
				<div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" name="employeeEmail" value="{{$employee->employeeEmail or old('employeeEmail')}}" class="form-control form-control-user"  placeholder="Email">
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control" name="employeePrivilegeId">
						<option value="">Select Privilege</option>
						@foreach($privilege as $row)
						<option value="{{$row->privilegeId}}" @if($row->privilegeId==$employee->employeePrivilegeId || $row->privilegeId==old('employeePrivilegeId')) Selected @endif>{{$row->privilege}}</option>
						@endforeach
					</select> 
                  </div>
                </div>
				<div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user"  placeholder="Password" {{$disabled}}>
                  </div>
                  <div class="col-sm-6">
                    <input type="password"  name="password_confirmation" class="form-control form-control-user"  placeholder="Repeat Password" {{$disabled}}>
                  </div>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
				
				@if($employee->employeeId!='' || old('employeeId')!='')
					 <a class="btn btn-danger btn-user btn-block" href="#" data-toggle="modal" data-target="#deleteModal">
					  Delete
					</a>     
                 @endif
				 
                  
              </form>
			 </div> <!--card-body-->
	</div><!--card-->

<!-- Delete Modal-->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
	  <form action="/employee-delete" method="post">
	   <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this employee?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
			 <input name="employeeId" type="hidden"  value="{{$employee->employeeId or old('employeeId')}}">
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-danger" value="Delete"/>
        </div>
		</form>
      </div>
    </div>
  </div>
@endsection 