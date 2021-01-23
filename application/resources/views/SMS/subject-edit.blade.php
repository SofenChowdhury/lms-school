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
                            <a href="{{ route('subjects') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    @foreach($edit_subject as $subject)
                    <form  method="post" action="{{ route('updateSubjectFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class Name*  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class_id" class="form-control" id="class_id">
                                        <option value="{{$subject->subject_class_id}}">{{$subject->class_name}}</option>
                                        @foreach($classes as $key)
                                        <option value="{{ $key->class_id }}">{{ $key->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Teacher Name*  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="teacher_id" class="form-control" id="teacher_id">
                                        <option value="{{$subject->subject_teacher_id}}">{{$subject->teacher_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Type *  </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="subject_type" class="form-control">
                                        <option value="{{$subject->subject_type}}">{{$subject->subject_type}}</option>
                                        <option value="Optional">Optional</option>
                                        <option value="Mandatory">Mandatory</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Subject Name *   </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="subject_name" value="{{$subject->subject_subject_name}}" class="form-control" >
                                    <input type="hidden" name="subject_id" value="{{$subject->subject_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Pass Mark *  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="pass_mark" value="{{$subject->subject_pass_mark}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Final Mark *   </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="full_mark" value="{{$subject->subject_final_mark}}" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Subject Author *   </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="subject_author" value="{{$subject->subject_author_name}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Subject Code *   </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="subject_code" value="{{$subject->subject_code}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note  </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="subject_note" class="form-control">{{$subject->subject_note}}</textarea>
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