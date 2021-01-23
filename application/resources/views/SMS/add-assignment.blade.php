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
                            <a href="{{ route('assignments') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" action="{{route('submitAssignmentForm')}}" method="post" validate enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Title*  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="assignment_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Description  </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="assignment_description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Deadline*  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="assignment_deadline" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class *   </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="assignment_class_id" id="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $key)
                                        <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Section *   </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="assignment_section_id" id="section_id" class="form-control">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Subject *   </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="assignment_subject_id" id="subject_id" class="form-control">
                                        <option value="">Select Subject</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>File  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default">Add</button>
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

                url: "{{ url('find-assignment') }}"+'/'+class_id,
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

    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ url('find-assignment-subject') }}"+'/'+class_id,
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