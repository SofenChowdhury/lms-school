@extends('layouts.SMS-APP')
@section('content')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Search {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('marks') }}" class="btn btn-primary pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form id="basic-form" action="{{route('show_marks')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Exam *</label>
                                    <select  name="exam_id" id="exam_id" class="form-control">
                                        @foreach($manage_exam as $current_exam)
                                        <option value="{{$current_exam->exam_id}}">{{$current_exam->exam_name}}</option>
                                        @endforeach
                                        @foreach($exam as $key)
                                        <option value="{{$key->exam_id}}">{{$key->exam_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Class *</label>
                                    <select  name="class_id" id="class_id" class="form-control">
                                        @foreach($manage_class as $current_class)
                                        <option value="{{$current_class->class_id}}">{{$current_class->class_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Subject *</label>
                                    <select  name="subject_id" id="subject_id" class="form-control">
                                        @foreach($manage_subject as $current_subject)
                                        <option value="{{$current_subject->subject_id}}">{{$current_subject->subject_subject_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-md-3 pull-right">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Add {{ $title }}</h2>
                        </div>
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'TEACHER')
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add_marks') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus-squar"></i> Add {{ $title }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                
                                <div style="background-color: #d9e0e6; border-radius: 5px; margin: 0px auto; height: 110%;">
                                    <h4 style="text-align: center; padding-top: 10px; font-family: cursive;">Marks Details</h4>
                                    <hr>
                                    <table class="table" style="width: 100%; position: relative;">
                                        @foreach($manage_class as $class)
                                        <tr style="line-height: 8px;">
                                            <td>Class</td>
                                            <td>:</td>
                                            <td>{{$class->class_name}}</td>
                                        </tr>
                                        @endforeach
                                        @foreach($manage_exam as $exam)
                                        <tr style="line-height: 8px;">
                                            <td>Exam</td>
                                            <td>:</td>
                                            <td>{{$exam->exam_name}}</td>
                                        </tr>
                                        @endforeach
                                        @foreach($manage_subject as $subject)
                                        <tr style="line-height: 8px;">
                                            <td>Subject</td>
                                            <td>:</td>
                                            <td>{{$subject->subject_subject_name}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="alert"></div>
                            </div>
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>photo</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($manage_marks as $marks)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$marks->student_name}}</td>
                                        <td><img src="{{asset('uploads').'/'.$marks->student_photo}}" style="width: 50px;"></td>
                                        <td>
                                            <div class="col-md-2" style="border-right:1px solid #b1bab1;width: 200px">
                                                <label style="vertical-align:  middle;display: inline;">MCQ <br>
                                                </label>
                                                <input type="hidden" name="marks_id" class="marks_id{{$marks->marks_id}}" value="{{$marks->marks_id}}" disabled>
                                                <input type="text" id="numberValidation" pattern="([0-9]|[0-9]|[0-9])" name="mcq_marks" maxlength="2" class="form-control mcq_marks{{$marks->marks_id}}"  value="{{$marks->mcq_marks}}" style="width: 40px; float: left; text-align: center;" disabled >
                                                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'TEACHER')
                                                <span class="McqMarksID{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Edit" style=" float: left; text-align: center;padding: 10px" ><i class="icon-pencil" aria-hidden="true"></i></span>
                                                
                                                <span id="submit_mcq_marks{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Update" style=" float: left; text-align: center;padding: 10px" ><i class="fa fa-check" aria-hidden="true"></i></span>
                                                @endif
                                            </div>
                                            <div class=" col-md-2 " style="border-right: 1px solid #b1bab1;width: 200px">
                                                <label style="vertical-align:  middle;display: inline;">CQ <br>
                                                </label>
                                                <input type="text" id="numberValidation1" pattern="([0-9]|[0-9]|[0-9])" name="theory_marks" maxlength="2" class="form-control theory_marks{{$marks->marks_id}}"  value="{{$marks->theory_marks}}" style="width: 40px; float: left; text-align: center;" disabled >
                                                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'TEACHER')
                                                <span class="TheoryMarksID{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Edit" style=" float: left; text-align: center;padding: 10px" ><i class="icon-pencil" aria-hidden="true"></i></span>
                                                
                                                <span id="submit_theory_marks{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Update" style=" float: left; text-align: center;padding: 10px" ><i class="fa fa-check" aria-hidden="true"></i></span>
                                                @endif
                                            </div>
                                            <div class=" col-md-2 " style="border-right: 1px solid #b1bab1;width: 200px">
                                                <label style="vertical-align:  middle;display: inline;">PR <br>
                                                </label>
                                                <input type="text" id="numberValidation1" pattern="([0-9]|[0-9]|[0-9])" name="theory_marks" maxlength="2" class="form-control pr_marks{{$marks->marks_id}}"  value="{{$marks->pr_marks}}" style="width: 40px; float: left; text-align: center;" disabled >
                                                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'TEACHER')
                                                <span class="PrMarksID{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Edit" style=" float: left; text-align: center;padding: 10px" ><i class="icon-pencil" aria-hidden="true"></i></span>
                                                
                                                <span id="submit_pr_marks{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Update" style=" float: left; text-align: center;padding: 10px" ><i class="fa fa-check" aria-hidden="true"></i></span>
                                                @endif
                                            </div>
                                            <div class=" col-md-2 " style="border-right: 1px solid #b1bab1;width: 200px">
                                                <label style="vertical-align:  middle;display: inline;">CA <br>
                                                </label>
                                                <input type="text" id="numberValidation1" pattern="([0-9]|[0-9]|[0-9])" name="theory_marks" maxlength="2" class="form-control ca_marks{{$marks->marks_id}}"  value="{{$marks->ca_marks}}" style="width: 40px; float: left; text-align: center;" disabled >
                                                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN'|| Auth::user()->role == 'TEACHER')
                                                <span class="CaMarksID{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Edit" style=" float: left; text-align: center;padding: 10px" ><i class="icon-pencil" aria-hidden="true"></i></span>
                                                
                                                <span id="submit_ca_marks{{$marks->marks_id}}" data-toggle="tooltip" data-original-title="Update" style=" float: left; text-align: center;padding: 10px" ><i class="fa fa-check" aria-hidden="true"></i></span>
                                                @endif
                                            </div>
                                            <div class=" col-md-3" >
                                                <label style="vertical-align:  middle;display: inline;">Total
                                                </label>
                                                <p id="totalMark{{$marks->marks_id}}">{{$marks->mcq_marks + $marks->theory_marks + $marks->pr_marks+ $marks->ca_marks}}</p>
                                            </div>
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
</div>

<script>
    var i=0;
    @foreach ($manage_marks as $key)

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $("#submit_mcq_marks{{$key->marks_id}}").click(function(e){
        e.preventDefault();
        var mcq_marks = $(".mcq_marks<?php  echo $key->marks_id ?>").val();
        var marks_id =  $(".marks_id<?php  echo $key->marks_id ?>").val();
        $.ajax({           

            url: "{{ url('mcq_marks_update_form') }}"+'/'+marks_id+'/'+mcq_marks,
            method: 'get',
            success: function(result){              
               $('.alert').html(' <div class="alert alert-success" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close">   <span aria-hidden="true">&times;</span></button><div class="d-flex align-items-center justify-content-start"> <i class="fas fa-check-circle mg-t-5 mg-xs-t-0"></i> <span><strong>Well done!</strong> Update Successfully Done !.</span> </div><!-- d-flex -->    </div><!-- alert -->');

                $(".theory_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
                var theory_marks = $(".theory_marks<?php  echo $key->marks_id ?>").val();

                var totalMark = parseInt(theory_marks)+parseInt(mcq_marks);
                $("#totalMark{{$key->marks_id}}").html(totalMark);
                $(".mcq_marks<?php  echo $key->marks_id ?>").attr("disabled", true);
                $(".marks_id<?php  echo $key->marks_id ?>").attr("disabled", true);
                                    
               
            }             

        });
    });
    $("#submit_theory_marks{{$key->marks_id}}").click(function(e){
        e.preventDefault();
        console.log('working');
        var theory_marks = $(".theory_marks<?php  echo $key->marks_id ?>").val();
        var marks_id =  $(".marks_id<?php  echo $key->marks_id ?>").val();
        $.ajax({           
            url: "{{ url('theory_marks_update_form') }}"+'/'+marks_id+'/'+theory_marks,
            method: 'get',
            success: function(result){   

              $('.alert').html(' <div class="alert alert-success" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close">   <span aria-hidden="true">&times;</span></button><div class="d-flex align-items-center justify-content-start"> <i class="fas fa-check-circle mg-t-5 mg-xs-t-0"></i> <span><strong>Well done!</strong> Update Successfully Done !.</span> </div><!-- d-flex -->    </div><!-- alert -->');

                $(".mcq_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
                var mcq_marks = $(".mcq_marks<?php  echo $key->marks_id ?>").val();

                var totalMark = parseInt(theory_marks)+parseInt(mcq_marks);
                $("#totalMark{{$key->marks_id}}").html(totalMark);
                $(".theory_marks<?php  echo $key->marks_id ?>").attr("disabled", true);
                $(".marks_id<?php  echo $key->marks_id ?>").attr("disabled", true);
                
               
            }             

        });
    });
    $("#submit_pr_marks{{$key->marks_id}}").click(function(e){
        e.preventDefault();
        console.log('working');
        var pr_marks = $(".pr_marks<?php  echo $key->marks_id ?>").val();
        var marks_id = $(".marks_id<?php  echo $key->marks_id ?>").val();
        $.ajax({           

            url: "{{ url('pr_marks_update_form') }}"+'/'+marks_id+'/'+pr_marks,
            method: 'get',
            success: function(result){   

              $('.alert').html(' <div class="alert alert-success" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close">   <span aria-hidden="true">&times;</span></button><div class="d-flex align-items-center justify-content-start"> <i class="fas fa-check-circle mg-t-5 mg-xs-t-0"></i> <span><strong>Well done!</strong> Update Successfully Done !.</span> </div><!-- d-flex -->    </div><!-- alert -->');

                $(".mcq_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
                var mcq_marks = $(".mcq_marks<?php  echo $key->marks_id ?>").val();
                var pr_marks = $(".pr_marks<?php  echo $key->marks_id ?>").val();
                var theory_marks = $(".theory_marks<?php  echo $key->marks_id ?>").val();
                var ca_marks = $(".ca_marks<?php  echo $key->marks_id ?>").val();

                var totalMark = parseInt(theory_marks)+
                                parseInt(pr_marks)+
                                parseInt(ca_marks)+
                                parseInt(mcq_marks);
                $("#totalMark{{$key->marks_id}}").html(totalMark);
                $(".pr_marks<?php  echo $key->marks_id ?>").attr("disabled", true);
                $(".marks_id<?php  echo $key->marks_id ?>").attr("disabled", true);
                
               
            }             

        });
    });
    $("#submit_ca_marks{{$key->marks_id}}").click(function(e){
        e.preventDefault();
        console.log('working');
        var ca_marks = $(".ca_marks<?php  echo $key->marks_id ?>").val();
        var marks_id = $(".marks_id<?php  echo $key->marks_id ?>").val();
        $.ajax({           

            url: "{{ url('ca_marks_update_form') }}"+'/'+marks_id+'/'+ca_marks,
            method: 'get',
            success: function(result){   

              $('.alert').html(' <div class="alert alert-success" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close">   <span aria-hidden="true">&times;</span></button><div class="d-flex align-items-center justify-content-start"> <i class="fas fa-check-circle mg-t-5 mg-xs-t-0"></i> <span><strong>Well done!</strong> Update Successfully Done !.</span> </div><!-- d-flex -->    </div><!-- alert -->');

                $(".mcq_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
                var mcq_marks = $(".mcq_marks<?php  echo $key->marks_id ?>").val();
                var pr_marks = $(".pr_marks<?php  echo $key->marks_id ?>").val();
                var theory_marks = $(".theory_marks<?php  echo $key->marks_id ?>").val();
                var ca_marks = $(".ca_marks<?php  echo $key->marks_id ?>").val();

                var totalMark = parseInt(theory_marks)+
                                parseInt(pr_marks)+
                                parseInt(ca_marks)+
                                parseInt(mcq_marks);
                $("#totalMark{{$key->marks_id}}").html(totalMark);
                $(".mcq_marks<?php  echo $key->marks_id ?>").attr("disabled", true);
                $(".theory_marks<?php  echo $key->marks_id ?>").attr("disabled", true);
                $(".pr_marks<?php  echo $key->marks_id ?>").attr("disabled", true);
                $(".marks_id<?php  echo $key->marks_id ?>").attr("disabled", true);
                
               
            }             

        });
    });

    $( ".McqMarksID<?php  echo $key->marks_id ?>" ).click(function() { 
        $(".mcq_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
        $(".marks_id<?php  echo $key->marks_id ?>").removeAttr('disabled');  
    });

    $( ".TheoryMarksID<?php  echo $key->marks_id ?>" ).click(function() {          
        $(".theory_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
        $(".marks_id<?php  echo $key->marks_id ?>").removeAttr('disabled');
    });
    $( ".PrMarksID<?php  echo $key->marks_id ?>" ).click(function() {          
        $(".pr_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
        $(".marks_id<?php  echo $key->marks_id ?>").removeAttr('disabled');
    });
    $( ".CaMarksID<?php  echo $key->marks_id ?>" ).click(function() {          
        $(".ca_marks<?php  echo $key->marks_id ?>").removeAttr('disabled');
        $(".marks_id<?php  echo $key->marks_id ?>").removeAttr('disabled');
    });
    @endforeach
</script>



<script>
    $('#exam_id').change(function(){
        var exam_id = $('#exam_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find-exam-schedule') }}"+'/'+exam_id,
                method: 'get',
                success: function(result){
                    $('#class_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Class</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#class_id").append(new Option(result[i].class_name, result[i].class_id));
                    }
                  }
              });
           });

    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find-exam-subject') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#subject_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Subject</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#subject_id").append(new Option(result[i].subject_subject_name, result[i].subject_id));
                    }
                  }
              });
           });


</script>

<script type="text/javascript">
    $("#numberValidation").keyup(function() {
        $("#numberValidation").val(this.value.match(/[0-9]*/));
    });
</script>
<script type="text/javascript">
    $("#numberValidation1").keyup(function() {
        $("#numberValidation1").val(this.value.match(/[0-9]*/));
    });
</script>
@endsection