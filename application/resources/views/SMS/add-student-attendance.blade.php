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
                            <a href="{{ route('student-attendance') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" action="{{route('give_attendance')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                               <div class="col-md-3">
                                    <label>Class </label>
                                    <select  name="class_id" id="class_id" class="form-control" >
                                        <option value="">Select Class</option>
                                        @foreach($manage_class as $class)
                                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>                                    
                               <div class="col-md-3">
                                    <label>Section </label>
                                    <select  name="saction_id" id="section_id" class="form-control" >
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                               <div class="col-md-3"><label>Date </label>
                                    <input type="text" name="date" class="form-control" value="{{ date('Y-m-d')}}" readonly="">
                                </div>
                                <!-- <div class="col-md-3"><label>Day </label>
                                    <select  name="day" class="form-control" required="required">
                                        <option value="SATURDAY">SATURDAY</option>
                                        <option value="SUNDAY">SUNDAY</option>
                                        <option value="MONDAY">MONDAY</option>
                                        <option value="TUESDAY">TUESDAY</option>
                                        <option value="WEDNESDAY">WEDNESDAY</option>
                                        <option value="THURSDAY">THURSDAY</option>
                                        <option value="FRIDAY">FRIDAY</option>
                                    </select>
                                </div> -->
                                <div class="col-md-3">
                                    <label> </label><br>
                                 <button type="submit" class="btn btn-block btn-default m-t-10 pull-right">Show</button>
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
                url: "{{ url('find-routine-section') }}"+'/'+class_id,
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
@endsection