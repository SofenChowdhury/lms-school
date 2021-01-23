@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    @if( Auth::user()->role == 'STUDENT' || Auth::user()->role == 'PARENTS')
                    <form id="basic-form" action="{{route('showAttendance')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-3">
                                <div class="">
                                    <p>Student* </p>
                                </div>
                                <select name="student_id" class="form-control">
                                    <option value="">Select Student</option>
                                    @foreach($get_class as $key)
                                    <option value="{{$key->student_id}}">{{$key->student_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <p>Year* </p>
                                </div>
                                <select name="year" class="form-control">
                                    <?php for($i=2019;$i<=date('Y');$i++){?>
                                    <option value="{{ $i }}">{{ $i}}</option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <p>Month Name* </p>
                                </div>
                                <div class="">
                                    <select name="month" class="form-control">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 pull-right">
                                <label> </label><br>
                                <button type="submit" class="btn btn-primary btn-block m-t-10 pull-right">Show</button>
                            </div>
                        </div>
                    </form>
                    @else
                    <form id="basic-form" action="{{route('showAttendance')}}" method="post" novalidate>
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
                                <div class="col-lg-4" >
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
                                <div class="col-lg-4">
                                    <div class="">
                                        <p>Section* </p>
                                    </div>
                                    <div class="">
                                        <select  name="section_id" id="section_id" class="form-control">
                                            <option value="">Select Section</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="">
                                        <p>Student Name* </p>
                                    </div>
                                    <div class="">
                                        <select  name="student_id" id="student_id" class="form-control">
                                            <option value="">Select Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <p>Year* </p>
                                </div>
                                <select name="year" class="form-control">
                                    <?php for($i=2019;$i<=date('Y');$i++){?>
                                    <option value="{{ $i }}">{{ $i}}</option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div class="">
                                    <p>Month Name* </p>
                                </div>
                                <div class="">
                                    <select name="month" class="form-control">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 pull-right">
                                <label> </label><br>
                                <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                            </div>
                        </div>
                    </form>
                    @endif
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

                url: "{{ url('find-section') }}"+'/'+class_id,
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
                        $("#student_id").append(new Option(result[i].student_name +", section: "+ result[i].section_name+", Roll: "+ result[i].student_roll_no, result[i].student_id));
                    }
                  }
              });

        });
</script>
@endsection