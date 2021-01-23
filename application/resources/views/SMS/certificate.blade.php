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
                    <form id="basic-form" action="{{route('showCertificatereport')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Class *</label>
                                    <select  name="class_id" id="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach($manage_class as $key)
                                        <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Section *</label>
                                    <select  name="section_id" id="section_id" class="form-control">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
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
                                <div class="col-md-3" id="student_ID">
                                    <label>Student *</label>
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
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="lib/year-select.js"></script>

<script>
    for (i = new Date().getFullYear(); i > 1900; i--)
        {
            $('#academic_year').append($('<option />').val(i).html(i));
        }
</script>
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