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
                    <form id="basic-form" action="{{route('showMeritstagereport')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Exam *</label>
                                    <select  name="exam_id" id="exam_id" class="form-control">
                                        <option value="">Select Exam Terminal</option>
                                        @foreach($manage_exam as $key)
                                        <option value="{{$key->exam_id}}">{{$key->exam_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <input type="hidden" name="class_id" value="{{$get_class->student_class_id}}">
                            <input type="hidden" name="section_id" value="{{$get_class->student_section_id}}">
                            <!-- <input type="hidden" name="student_id" value="{{$get_class->student_id}}"> -->
                                <div class="col-md-3">
                                    <label>Academic Year *</label>
                                    <select class="yearselect" id="academic_year" name="academic_year" style="width: 100%; height: 30px; border:1px solid lightgray; border-radius: 5px; padding-left: 7px;">
                                        <option value="">Select Academic Year</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <form id="basic-form" action="{{route('showMeritstagereport')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Exam *</label>
                                    <select  name="exam_id" id="exam_id" class="form-control">
                                        <option value="">Select Exam Terminal</option>
                                        @foreach($manage_exam as $key)
                                        <option value="{{$key->exam_id}}">{{$key->exam_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Class *</label>
                                    <select  name="class_id" id="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Section *</label>
                                    <select  name="section_id" id="section_id" class="form-control">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="academic">
                                    <div class="">
                                        <p>Academic Year* </p>
                                    </div>
                                    <select name="academic_year" id="academic_year" class="form-control">
                                        <option value="">Select Academic Year</option>
                                        <?php for($i=2019;$i<=date('Y');$i++){?>
                                        <option value="{{ $i }}">{{ $i}}</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>  

    $('#student_ID').hide();   
    $('#academic').hide();   
    $('#section_id').change(function(){
        var section_id = $('#section_id option:selected').val();

        if(section_id){
            $('#student_ID').show();    
            $('#academic').show();    
        }

    });  
     
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
           });
    $('#section_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        var section_id = $('#section_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find-section-student') }}"+'/'+class_id+'/'+section_id,
                method: 'get',
                success: function(result){
                    $('#student_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Student</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#student_id").append(new Option(result[i].student_name, result[i].student_id));
                    }
                  }
              });
           });


</script>      
@endsection