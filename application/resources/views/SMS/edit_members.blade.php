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
                            <a href="{{ route('hostel_members') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateHostelMemberFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_members as $members)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Member Class* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class_id" id="clsas_id" class="form-control">
                                        <option value="{{$members->class_id}}">{{$members->class_name}}</option>
                                        @foreach($class as $key)
                                        <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Member Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="member_name" id="student_id" class="form-control">
                                        <option value="{{$members->student_id}}">{{$members->student_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Hostel Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="hostel_id" class="form-control">
                                        <option value="{{$members->hostel_id}}">{{$members->hostel_name}}</option>
                                        @foreach($hostel as $key)
                                        <option value="{{$key->hostel_id}}">{{$key->hostel_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Room No.* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="room" value="{{$members->room}}" class="form-control">
                                    <input type="hidden" name="host_member_id" value="{{$members->host_member_id}}" class="form-control">
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
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>
    $('#clsas_id').change(function(){
        var clsas_id = $('#clsas_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ url('find-students') }}"+'/'+clsas_id,
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