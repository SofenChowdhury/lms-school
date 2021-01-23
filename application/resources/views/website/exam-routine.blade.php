@extends('layouts.WEB-APP')
@section('content')
            
            <!-- Slider Start --> 
            @foreach($banner as $key)
                <div style="background-image: url('{{asset('uploads').'/'.$key->banner}}'); background-attachment: fixed; background-size: cover;" class="page-section">
                    <div style="background:rgb(49,49,49,0.5); padding:200px 0 50px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-page-title">
                                        <h1 style="color: white !important; font-weight: bold;">{{$title}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Main Start -->
            <div class="main-section"> 
                <!--Page Section Wide With Right SideBar-->
                <div class="page-section" style=" padding-top:10px; padding-bottom:50px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Search Here For Exam Routine
                                    </div>
                                    <div class="panel-body">
                                        @include('includes.messages')
                                        @if($class_id != NULL)
                                            @foreach($exam_sch as $exam_sch)
                                                <form id="basic-form" action="{{route('showExamSchedule')}}" method="post" novalidate>
                                                @csrf()
                                                <div class="row">
                                                    <div class="col-md-12">
                                                       <div class="col-md-4">
                                                            <label>Exam *</label>
                                                            <select  name="exam_id" id="exam_id" class="form-control">
                                                                <option value="{{$exam_sch->exam_id}}">{{$exam_sch->exam_name}}</option>
                                                                @foreach($manage_exam as $key)
                                                                <option value="{{$key->exam_id}}">{{$key->exam_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Class *</label>
                                                            <select  name="class_id" id="class_id" class="form-control">
                                                                <option value="{{$exam_sch->class_id}}">{{$exam_sch->class_name}}</option>
                                                            </select>
                                                        </div>                                   
                                                       <!-- <div class="col-md-3">
                                                            <label>Section *</label>
                                                            <select  name="section_id" id="section_id" class="form-control">
                                                                <option value="">Select Section</option>

                                                            </select>
                                                        </div> -->
                                                        <div class="col-md-4 pull-right">
                                                            <label> </label><br>
                                                         <button type="submit" class="btn btn-primary btn-block m-t-10 pull-right">Show</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            @endforeach
                                        @else
                                           <form id="basic-form" action="{{route('showExamSchedule')}}" method="post" novalidate>
                                                @csrf()
                                                <div class="row">
                                                    <div class="col-md-12">
                                                       <div class="col-md-4">
                                                            <label>Exam *</label>
                                                            <select  name="exam_id" id="exam_id" class="form-control">
                                                                <option value="">Select Exam Terminal</option>
                                                                @foreach($manage_exam as $key)
                                                                <option value="{{$key->exam_id}}">{{$key->exam_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Class *</label>
                                                            <select  name="class_id" id="class_id" class="form-control">
                                                                <option value="">Select Class</option>
                                                            </select>
                                                        </div>                                   
                                                       <!-- <div class="col-md-3">
                                                            <label>Section *</label>
                                                            <select  name="section_id" id="section_id" class="form-control">
                                                                <option value="">Select Section</option>

                                                            </select>
                                                        </div> -->
                                                        <div class="col-md-4 pull-right">
                                                            <label> </label><br>
                                                         <button type="submit" class="btn btn-primary btn-block m-t-10 pull-right">Show</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form> 
                                        @endif    
                                    </div>
                                </div>
                                
                                @if( $class_id != NULL)
                                <div>@foreach($exam as $exam)
                                    <h2>{{$exam->exam_name}}</h2>
                                    @endforeach
                                    <table class="table table-bordered">
                                        <tr>
                                            @foreach($class as $class)
                                            <th colspan="4" style="background-color: #2d74ab; color: white;">{{$class->class_name}}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>{{'Date'}}</th>
                                            <th>{{'Subjects'}}</th>
                                            <th>{{'Start_Time'}} - {{'End_Time'}}</th>
                                            <th>{{'Room'}}</th>
                                        </tr>
                                        @foreach($manage_exam_sch as $exam_sch)
                                        <tr>
                                            <td>{{$exam_sch->schedule_date}}</td>
                                            <td>{{$exam_sch->subject_subject_name}}</td>
                                            <td>{{date('h:m a', strtotime($exam_sch->start_time))}} - {{date('h:m a', strtotime($exam_sch->end_time))}}</td>
                                            <td>{{$exam_sch->room}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @endif
                            </div>    
                            <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <h4 class="quick-navigation">Quick Navigation</h4>
                                <div class="widget cs-widget-links">
                                    <ul>
                                        <li><a class="{{ request()->is('dress-code') ? 'ctg_active ' : '' }}" href="{{ route('dress-code-page') }}">Dress Code</a></li>
                                        <li><a class="{{ request()->is('academic-calendar') ? 'ctg_active ' : '' }}" href="{{ route('academic-calendar-page') }}">Academic Calendar</a></li>
                                        <li><a class="{{ request()->is('book-list-and-syllabust') ? 'ctg_active ' : '' }}" href="{{ route('book-list-and-syllabus-page') }}">Book List & Syllabus</a></li>
                                        <li><a class="{{ request()->is('class-routine') ? 'ctg_active ' : '' }}" href="{{ route('class-routine-page') }}">Class Routine</a></li>
                                        <li><a class="{{ request()->is('exam-routine') ? 'ctg_active ' : '' }} || {{ request()->is('showExamSchedule') ? 'ctg_active ' : '' }}" href="{{ route('exam-routine-page') }}">Exam Routine</a></li>
                                        <li><a class="{{ request()->is('teachers-and-staffs') ? 'ctg_active ' : '' }}" href="{{ route('teachers-and-staffs-page') }}">Teachers and Staffs</a></li>
                                    </ul>              
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main End -->

<script>
    $('#exam_id').change(function(){
        var exam_id = $('#exam_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                
                url: "{{ url('find_schedule') }}"+'/'+exam_id,
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

                url: "{{ url('find_section') }}"+'/'+class_id,
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