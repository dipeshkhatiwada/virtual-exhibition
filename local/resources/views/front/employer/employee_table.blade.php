@if(count($employees) > 0)
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>S.N.</th>
				<th>ID</th>
				<th>Name</th>
				<th>Address</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			@foreach($employees as $em)
				<tr>
					<td><?php echo $i++; ?></td>
					<td>{{$em->id}}</td>
					<td>{{\App\Employees::getFullname($em->firstname,$em->middlename,$em->lastname)}}</td>
					<td>{{$em->permanent_address}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif