@extends('layouts.SMS-APP')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

@if(!$check_question)
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            @include('includes.messages')
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} Answer </h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('quiz') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form  method="post" action="{{ route('answerquiz') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>{{$get_quiz_info->quiz_title}}</h5>
                                        <input type="hidden" name="quiz_info_id" class="form-control" value="{{$get_quiz_info->id}}">
                                    </div>
                                    <div class="col-lg-12">
                                        <span style="font-weight:bold;">Date: </span><span>{{date('d-M-Y', strtotime($get_quiz_info->quiz_date))}}</span>
                                    </div>
                                    <div class="col-lg-12">
                                        <span style="font-weight:bold;">Class:</span><span>{{$get_quiz_info->class_name}}</span> <span style="font-weight:bold;">Section:</span><span>{{$get_quiz_info->section_name}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 offset-3">
                                <div class="row" style="">
                                    <div class="col-lg-11 offset-1">

                                        @if($get_quiz_info->quiz_type == 1)
                                        <span style="font-weight:bold;">Quiz Type:</span><span> MCQ</span>
                                        @else
                                        <span style="font-weight:bold;">Quiz Type:</span> <span>Theory</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-11 offset-1">
                                        <span style="font-weight:bold;">Quiz Marks:</span> <span>{{$get_quiz_info->quiz_marks}}</span>
                                    </div>
                                    <div class="col-lg-11 offset-1">
                                        <span style="font-weight:bold;">Time: </span><span>{{$get_quiz_info->quiz_start_time}} - {{$get_quiz_info->quiz_end_time}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;border: 1px solid lightgray;padding-top:20px;">
                            <div class="col-lg-12">
                                @foreach($get_question as $question)
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5>
                                                    <span>{{$loop->index+1}}.</span>
                                                    <span style="font-size: 13px;font-weight:bold;">{{$question->question_title}}</span>
                                                </h5>
                                                <input type="hidden" name="question_id[]" value="{{$question->id}}">
                                            </div>
                                            <div class="col-lg-8" style="margin-left: 25px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="exampleRadios{{$question->id}}"value="{{$question->option1}}">
                                                    <p class="form-check-label" for="exampleRadios{{$question->id}}">
                                                        {{$question->option1}}
                                                    </p>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="exampleRadios{{$question->id}}" value="{{$question->option2}}">
                                                    <p class="form-check-label" for="exampleRadios{{$question->id}}">
                                                        {{$question->option2}}
                                                    </p>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="exampleRadios{{$question->id}}"value="{{$question->option3}}">
                                                    <p class="form-check-label" for="exampleRadios{{$question->id}}">
                                                        {{$question->option3}}
                                                    </p>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="exampleRadios{{$question->id}}"value="{{$question->option4}}">
                                                    <p class="form-check-label" for="exampleRadios{{$question->id}}">
                                                        {{$question->option4}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 offset-1">
                                        {{$question->marker}}
                                        {{-- <input type="hidden" name="marks[]" value="{{$question->marker}}"> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Quiz Note</label>
                                <p>{{$get_quiz_info->quiz_note}}</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            @include('includes.messages')
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} Answer </h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('quiz') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form  method="post" action="{{ route('answerquiz') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>{{$get_quiz_info->quiz_title}}</h5>
                                        <input type="hidden" name="quiz_info_id" class="form-control" value="{{$get_quiz_info->id}}">
                                    </div>
                                    <div class="col-lg-12">
                                        <span style="font-weight:bold;">Date: </span><span>{{date('d-M-Y', strtotime($get_quiz_info->quiz_date))}}</span>
                                    </div>
                                    <div class="col-lg-12">
                                        <span style="font-weight:bold;">Class:</span><span>{{$get_quiz_info->class_name}}</span> <span style="font-weight:bold;">Section:</span><span>{{$get_quiz_info->section_name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <h5><span style="font-weight: bold;">Total Marks:</span> {{$marks}}</h5>
                            </div>
                            <div class="col-lg-3">
                                <div class="row" style="">
                                    <div class="col-lg-11 offset-1">

                                        @if($get_quiz_info->quiz_type == 1)
                                        <span style="font-weight:bold;">Quiz Type:</span><span> MCQ</span>
                                        @else
                                        <span style="font-weight:bold;">Quiz Type:</span> <span>Theory</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-11 offset-1">
                                        <span style="font-weight:bold;">Quiz Marks:</span> <span>{{$get_quiz_info->quiz_marks}}</span>
                                    </div>
                                    <div class="col-lg-11 offset-1">
                                        <span style="font-weight:bold;">Time: </span><span>{{$get_quiz_info->quiz_start_time}} - {{$get_quiz_info->quiz_end_time}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;border: 1px solid lightgray;padding-top:20px;">
                            <div class="col-lg-12">
                                @foreach($get_question as $answer)
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5>
                                                    <span>{{$loop->index+1}}.</span>
                                                    <span style="font-size: 13px;font-weight:bold;">{{$answer->question_title}}</span>
                                                </h5>
                                                
                                            </div>
                                            <div class="col-lg-8" style="margin-left: 25px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="option1{{$answer->id}}" value="{{$answer->option1}}">

                                                    <p class="form-check-label" id="ans1{{$answer->id}}">
                                                        {{$answer->option1}}
                                                    </p>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="option2{{$answer->id}}" value="{{$answer->option2}}">
                                                    <p class="form-check-label" id="ans2{{$answer->id}}">
                                                        {{$answer->option2}}
                                                    </p>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="option3{{$answer->id}}"value="{{$answer->option3}}">
                                                    <p class="form-check-label" id="ans3{{$answer->id}}">
                                                        {{$answer->option3}}
                                                    </p>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="{{$loop->index}}" id="option4{{$answer->id}}"value="{{$answer->option4}}">
                                                    <p class="form-check-label" id="ans4{{$answer->id}}">
                                                        {{$answer->option4}}
                                                    </p>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-4">
                                                Answer:
                                                <input class="form-control" type="text" placeholder=" Question Answer" readonly="" id="answer{{$answer->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 offset-1">
                                        {{$answer->marker}}
                                        {{-- <input type="hidden" name="marks[]" value="{{$question->marker}}"> --}}
                                    </div>
                                </div>

                                <script>

                                    var question_id = {{ $answer->id }};

                                    var option1{{ $answer->id }} = '{{$answer->option1}}';
                                    var option2{{ $answer->id }} = '{{$answer->option2}}';
                                    var option3{{ $answer->id }} = '{{$answer->option3}}';
                                    var option4{{ $answer->id }} = '{{$answer->option4}}';
                                    $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                }
                                            });
                                    $.ajax({

                                        url: "{{ url('get_result') }}"+'/'+question_id,
                                        method: 'get',
                                        success: function(result){
                                            if (option1{{ $answer->id }} == result.answer) {
                                               $('#option1{{ $answer->id }}').prop("checked", true);
                                            }
                                            if (option2{{ $answer->id }} == result.answer) {
                                               $('#option2{{ $answer->id }}').prop("checked", true);
                                            }
                                            if (option3{{ $answer->id }} == result.answer) {
                                               $('#option3{{ $answer->id }}').prop("checked", true);
                                            }
                                            if (option4{{ $answer->id }} == result.answer) {
                                               $('#option4{{ $answer->id }}').prop("checked", true);
                                            }
                                        }
                                    });

                                    $.ajax({

                                        url: "{{ url('get_errors') }}"+'/'+question_id,
                                        method: 'get',
                                        success: function(result){
                                            $('#answer{{$answer->id}}').val(result.answer);
                                        }
                                    });
                                </script>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Quiz Note</label>
                                <p>{{$get_quiz_info->quiz_note}}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@stop