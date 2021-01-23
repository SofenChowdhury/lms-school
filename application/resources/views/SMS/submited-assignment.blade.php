@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">  
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card" style="height:480px;">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} Markings</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('students') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                    
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" method="post" action="{{ route('submit_assignment_marks') }}" validate enctype="multipart/form-data">
                        @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>markes</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($get_student as $student)
                            <tr>
                                <td>{{$student->student_name}}<input type="hidden" name="student_id[]" value="{{$student->student_id}}"></td>
                                <td>{{$assignment_details->subject_subject_name}}</td>
                                <td>{{$student->class_name}}</td>
                                <td>{{$student->section_name}}</td>
                                <td><input type="number" name="markes[]" class="form-control" id="marks{{$student->student_id}}" placeholder="assignment marks"></td>
                                <td><input type="text" name="remarks[]" class="form-control" id="remarks{{$student->student_id}}" placeholder="student Remarks"></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">
                                    <button class="btn btn-default pull-right" type="submit">
                                        Submit Marks
                                    </button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>
    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find-section') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#saction_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Section</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#saction_id").append(new Option(result[i].section_name, result[i].saction_id));
                    }
                }
            });
    });

    
</script>
@endsection