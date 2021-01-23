@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12">
			<div class="card">
				<div class="header">
					<div class="row">
						<div class="col-lg-6" style="float: left;">
							<h2>{{ $title }} </h2>
						</div>
						<div class="col-lg-6" style="float: right;">
							<a href="{{ route('add_machine') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-plus-squar"></i> Add {{ $title }}</a>
						</div>
					</div>
				</div>
				<div class="body">
					<div class="table-responsive">
						@include('includes.messages')
						<table id="tableid" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Machine Name</th>
									<th>Type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($manage_machines as $key)
								<tr>
									<td>{{ $loop->index+1 }}</td>
									<td>{{ $key->machine_sn }}</td>
									@if($key->machinestype == 'SCHOOLGATE')
									<td>School Gate</td>
									@else
									<td>School Room</td>
									@endif
									<td class="actions">
										<a href="{{ route('delete-machine',['id'=>$key->machine_id]) }}" onclick="return confirm('Are you sure?')"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
										data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection