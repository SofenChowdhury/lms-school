@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Get {{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" action="{{route('idCardFrom')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-3" style="margin-top: 6px;">
                                <label> Role* </label>
                                <div class="">
                                    <select  name="role" id="usertype" class="form-control">
                                        <option value="">Select Member</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="TeacherID">
                                <p>Teacher Name* </p>
                                <div class="" >
                                    <select  name="teacher_id" class="form-control">
                                        <option value="">Select Teacher</option>
                                        @foreach($teacher as $teach)
                                        <option value="{{$teach->teacher_id}}">{{$teach->teacher_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" id="StudentID">
                                <div class="col-md-6" >
                                    <div class="">
                                        <p>Class * </p>
                                    </div>
                                    <div class="">
                                        <select  name="class_id" id="class_id" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach($class as $key)
                                            <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <p>Student Name* </p>
                                    </div>
                                    <div class="">
                                        <select  name="student_id" id="student_id" class="form-control">
                                            <option value="">Select Name</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label> </label><br>
                                <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
</script>
<script>  
    $('#StudentID').hide();   
    $('#TeacherID').hide();   
    $('#usertype').change(function(){
        var usertype = $('#usertype option:selected').val();

        if(usertype == 'Teacher'){
             $('#StudentID').hide();    
             $('#TeacherID').show();    
        }else{
            $('#TeacherID').hide();
            $('#StudentID').show();
        }

      });  
     
</script>

<script>
    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();             
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find-student-class') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#student_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Student</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#student_id").append(new Option(result[i].student_name +", section: "+ result[i].section_name, result[i].student_id));
                    }
                  }
              });

        });
</script>
@endsection