@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                 <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Add {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('marks') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" action="{{route('give_marks')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                               <div class="col-md-3">
                                    <label>Exam *</label>
                                    <select  name="exam_id" id="exam_id" class="form-control">
                                        <option value="">Select Exam</option>
                                        @foreach($manage_exam as $exam)
                                        <option value="{{$exam->exam_id}}">{{$exam->exam_name}}</option>
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
                                    <label>Subject *</label>
                                    <select  name="subject_id" id="subject_id" class="form-control">
                                        <option value="">Select Subject</option>
                                        
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
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

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
@endsection