@extends('master')
@section('title', 'Employee List')
@section('content')  
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>City</th>
                      <th>Privilege</th>
                    </tr>
                  </thead>
                  <tfoot>
				  @foreach($employee as $row)
                    <tr>
                      <td><a href="/employee-edit-{{$row->employeeId}}">{{$row->employeeName}}</a></td>
                      <td>{{$row->employeeAddress}}</td>
                      <td>{{$row->employeePhone}}</td>
                      <td>{{$row->employeeEmail}}</td>
                      <td>{{$row->employeeHasCity->cityName}}</td>
                      <td>{{$row->employeeHasPrivilege->privilege}}</td>
                    </tr>
				  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
 @endsection 