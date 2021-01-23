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
                            <a href="{{ route('sections') }}" class="btn btn-primary pull-right">  <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    @foreach($edit_section as $section)
                    <form  method="post" action="{{ route('updateSectionFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Section* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="section_name" value="{{ $section->section_name }}" class="form-control" >
                                    <input type="hidden" name="saction_id" value="{{ $section->saction_id }}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Category* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="section_category" value="{{$section->section_category}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Capacity* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="section_capacity" value="{{$section->section_capacity}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class_id" class="form-control" id="class_id">
                                        <option value="{{$section->class_id}}">{{$section->class_name}}</option>
                                        @foreach($class as $key)
                                        <option value="{{ $key->class_id }}">{{ $key->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class Teacher *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="teacher_id" class="form-control" id="teacher_id">
                                        <option value="{{$section->section_teacher_id}}">{{$section->teacher_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="section_note" class="form-control">{{$section->subject_note}}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                    @endforeach
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

                url: "{{ url('find-teacher') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#teacher_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Teacher</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#teacher_id").append(new Option(result[i].teacher_name, result[i].subject_teacher_id));
                    }
                  }
              });
           });
</script>
@endsection