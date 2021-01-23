@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Edit {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('transport_memeber') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateTransportMemberFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($edit_transport_member as $transport)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Student Class * </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class_id" id="class_id" class="form-control">
                                        <option value="{{$transport->class_id}}">{{$transport->class_name}}</option>
                                        @foreach($manage_class as $key)
                                        <option value="{{ $key->class_id }}">{{ $key->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Section * </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="section_id" id="section_id" class="form-control">
                                        <option value="{{ $transport->saction_id }}">{{$transport->section_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Student Name *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="student_id" id="student_id" class="form-control">
                                        <option value="{{ $transport->student_id }}">{{$transport->student_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Route Name *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="transport_id" class="form-control">
                                        <option value="{{ $transport->transport_id }}">{{$transport->route_name}}</option>
                                        @foreach($transport_route as $route)
                                        <option value="{{ $route->transport_id }}">{{ $route->route_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Transport Fees* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="transport_fees" value="{{$transport->transport_fees}}" class="form-control" >
                                    <input type="hidden" name="transport_member_id" value="{{$transport->transport_member_id}}" class="form-control" >
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Update</button>
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
                url: "{{ url('find-transport-student') }}"+'/'+class_id,
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
        $.ajax({
                url: "{{ url('find-transport-section') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#section_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Student</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#section_id").append(new Option(result[i].section_name, result[i].saction_id));
                    }
                  }
              });
           });

</script>        
@endsection