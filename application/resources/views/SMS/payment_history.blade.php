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
                    <form id="basic-form" action="{{route('showpayment_history')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Class </label>
                                    <select  name="class_id" id="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach($manage_class as $key)
                                        <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Section </label>
                                    <select  name="section_id" id="section_id" class="form-control">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                                <div class="col-md-3" id="academic" >
                                    <div class="">
                                        <p>Academic Year* </p>
                                    </div>
                                    <select name="academic_year" id="academic_year" class="form-control" style="margin-top: -7px;">
                                        <option value="">Select Academic Year</option>
                                        <?php for($i=2019;$i<=date('Y');$i++){?>
                                        <option value="{{ $i }}">{{ $i}}</option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Student </label>
                                    <select  name="student_id" id="student_id" class="form-control">
                                        <option value="">Select Student</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
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
        var section_id = $('#section_id option:selected').val();
        var class_id = $('#class_id option:selected').val();       
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
    $('#academic_year').change(function(){
        var academic_year = $('#academic_year option:selected').val();       
        var class_id = $('#class_id option:selected').val();
        var section_id = $('#section_id option:selected').val();
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find-academic-student') }}"+'/'+class_id+'/'+section_id+'/'+academic_year,
                method: 'get',
                success: function(result){
                    $('#student_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Students</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#student_id").append(new Option(result[i].student_name,  result[i].student_id));
                    }
                  }
              });
           });


</script>      
@endsection