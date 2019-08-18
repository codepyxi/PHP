<html>
	<body>
		<h3>Employees List</h3>
		<table border="1px" width="100%">
			@foreach($employee as $row)
				<tr>
					<td>{{$row->employeeName}}</td>
                    <td>{{$row->employeeAddress}}</td>
                    <td>{{$row->employeePhone}}</td>
                    <td>{{$row->employeeEmail}}</td>
                    <td>{{$row->employeeHasCity->cityName}}</td>
                    <td>{{$row->employeeHasPrivilege->privilege}}</td>
				</tr>
			@endforeach
		</table>
	</bodY>
</html>