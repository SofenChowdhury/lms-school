@extends('layouts.SMS-APP')
@section('content')
<style>
	@media (min-width: 576px) {
	  .modal-dialog { max-width: none; }
	}

	.modal-dialog {
	  width: 98%;
	  height: 100%;
	  padding: 0;
	}

	.modal-content {
	  height: 100%;
	}
</style>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                        @if(Auth::user()->role == 'TEACHER')
                        <div class="col-lg-6" style="float: right;">
                            <a href="#" class="btn btn-primary pull-right" id="add_quiz"  data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        @include('includes.messages')
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Quiz Title</th>
                                    <th>Quiz Date</th>
                                    <th>Teacher</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER' || Auth::user()->role == 'STUDENT')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($get_quiz_info as $quiz)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$quiz->quiz_title}}</td>
                                    <td>{{$quiz->quiz_date}}</td>
                                    <td>{{$quiz->teacher_name}}</td>
                                    <td>{{$quiz->class_name}}</td>
                                    <td>{{$quiz->section_name}}</td>
                                    <td>{{$quiz->quiz_start_time}}</td>
                                    <td>{{$quiz->quiz_end_time}}</td>
                                    
                                    <td class="actions">
                                        <a href="{{route('quiz_details',['id'=>$quiz->id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                        data-toggle="tooltip" data-original-title="View" ><i class="icon-eye" aria-hidden="true"></i></a>

                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN' || Auth::user()->role == 'TEACHER')

                                        {{-- <a href="#"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a> --}}
                                        <a href="#" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
                                        @endif
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
{{-- Modal --}}
<div id="myModal" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	    <form  method="post" action="{{ route('savequiz') }}" validate enctype="multipart/form-data">
	    	<div class="modal-content" style="background-color: white;">
                @csrf
		      	<div class="modal-header">
		      		<h5 style="margin: 0px auto;">{{$title}}</h5>
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		      	</div>
		      	<div class="modal-body" style="background-color: white;padding-left: 30px;padding-right: 30px;">
			        <div class="row">
			        	<div class="col-lg-4">
			        		<div class="row">
			        			<div class="col-lg-6">
				        			<label>Quiz title</label>
					                <input type="text" name="quiz_title" class="form-control" placeholder="quiz title">
					            </div>
					            <div class="col-lg-6">
				        			<label>Quiz Date</label>
					                <input type="date" name="quiz_date" class="form-control" placeholder="quiz date">
					            </div>
				            </div>
				            <div class="row">
				            	<div class="col-lg-6">
					            	<label>Class</label>
				                    <select class="form-control" name="class_id" id="class_id">
				                    	<option value="">Select Class</option>
				                    	@foreach($get_class as $class)
				                    	<option value="{{$class->class_id}}">{{$class->class_name}}</option>
				                    	@endforeach
				                    </select>
				                </div>
				                <div class="col-lg-6">
					            	<label>Section</label>
				                    <select class="form-control" name="section_id" id="section_id">
				                    	<option value="">Select Section</option>
				                    </select>
				                </div>
				            </div>
			        	</div>

			        	<div class="col-lg-4 offset-4">
			        		<div class="row">
			        			<div class="col-lg-6">
				        			<label>Quiz Type</label>
					        		<select class="form-control" name="quiz_type">
				                    	<option value="">Select Type</option>
				                    	<option value="1">MCQ</option>
				                    	<option value="2">Theory</option>
				                    </select>
				                </div>
				                <div class="col-lg-6">
				        			<label>Quiz Marks</label>
				                	<input type="text" name="quiz_marks" class="form-control" placeholder="Quiz Marks">
				                </div>
				                <div class="col-lg-6">
				        			<label>Quiz Start Time</label>
				                	<input type="time" name="quiz_start_time" class="form-control" placeholder="start Time">
				                </div>
				                <div class="col-lg-6">
				        			<label>Quiz End Time</label>
				                	<input type="time" name="quiz_end_time" class="form-control" placeholder="quiz end time">
				                </div>
				            </div>
			        	</div>
			        </div>
					<div class="row" style="margin-top: 20px;border: 1px solid lightgray;padding-top:20px;">
					    <div class="col-lg-12">
					    	@for($i=1; $i<=30; $i++)
					        <div class="row">
					        	<div class="col-lg-9">
					        		<div class="row">
					        			<div class="col-lg-12">
							        		<h5>
							        			{{$i}}. <input class="form-control" type="text" name="question_title[]" placeholder="Question title" style="width: 80%;">
							        		</h5>
							        	</div>
							        	<div class="col-lg-8">
							        		@foreach(range('a','d') as $j)
							        		<div class="radio" style="margin-left: 3%;">
											  	{{$j}}.<input class="form-control" type="text" name="option{{$j}}[]" placeholder=" Question options">
											</div>
											@endforeach
										</div>
										<div class="col-lg-4">
											Answer:
											<input class="form-control" type="text" name="answer[]" placeholder=" Question Answer">
										</div>
									</div>
					        	</div>
					        	<div class="col-lg-2 offset-1">
					        		Markes:
					        		<input class="form-control" type="text" name="markes[]" placeholder="Marks">
					        	</div>
					        </div>
					        @endfor
					    </div>
				    </div>
				    <div class="row">
		            	<div class="col-lg-12">
			            	<label>Quiz Note</label>
			                <textarea class="form-control" name="quiz_note"></textarea>
			            </div>
		            </div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="submit" class="btn btn-default">Save</button>
		      	</div>
	    	</div>
	  	</form>
  	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
	$('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

            url: "{{ url('find-assignment') }}"+'/'+class_id,
            method: 'get',
            success: function(result){
                $('#section_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Select Section</option>'); 
                for ( var i = 0, l = result.length; i < l; i++ ) {
                    $("#section_id").append(new Option(result[i].section_name, result[i].saction_id));
                }
            }
        });
    });
</script>
@stop