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
                                        Search Here For Class Routine
                                    </div>
                                    <div class="panel-body">
                                      @include('includes.messages')
                                      @if($class_id != NULL)
                                      @foreach($classes as $classes)
                                        <form id="basic-form" action="{{route('showClassRoutins')}}" method="post" novalidate>
                                            @csrf()
                                            <div class="row">
                                                <div class="col-md-12">
                                                   <div class="col-md-4">
                                                        <label>Class *</label>
                                                        <select  name="class_id" id="class_id" class="form-control">
                                                            <option value="{{$classes->class_id}}">{{$classes->class_name}}</option>
                                                            @foreach($manage_class as $key)
                                                            <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Section *</label>
                                                        <select  name="section_id" id="section_id" class="form-control">
                                                            <option value="{{$classes->saction_id}}">{{$classes->section_name}}</option>
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
                                      <form id="basic-form" action="{{route('showClassRoutins')}}" method="post" novalidate>
                                            @csrf()
                                            <div class="row">
                                                <div class="col-md-12">
                                                   <div class="col-md-4">
                                                        <label>Class *</label>
                                                        <select  name="class_id" id="class_id" class="form-control">
                                                            <option value="">Class Name</option>
                                                            @foreach($manage_class as $key)
                                                            <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Section *</label>
                                                        <select  name="section_id" id="section_id" class="form-control">
                                                            <option value="">Section Name</option>
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

                                @if($class_id != NULL)
                                
                                    <h2>Class: {{$classes->class_name}} || {{$classes->section_name}}</h2>
                                
                                <table id="tableid" class="table table-bordered table-hover table-striped">
                                    <tbody>
                                        <tr>
                                            <td>SATURDAY</td> 
                                            @foreach($sat as $key)
                                                @if($key->class_id == $class_id)
                                                <td>
                                                    {{$key->subject_subject_name}}<br>
                                                    {{$key->start_time}}<span> To </span>
                                                    {{$key->end_time}}
                                                </td> 
                                            @endif
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>SUNDAY</td>
                                            @foreach($sun as $key)
                                                @if($key->class_id == $class_id)
                                                <td>
                                                    {{$key->subject_subject_name}}<br>
                                                    {{$key->start_time}}<span> To </span>
                                                    {{$key->end_time}}

                                                </td>
                                                @endif
                                            @endforeach                                    
                                        </tr>                                        
                                        <tr>
                                            <td>MONDAY</td>  
                                            @foreach($mon as $key)
                                                @if($key->class_id == $class_id)
                                                <td>
                                                    {{$key->subject_subject_name}}<br>
                                                    {{$key->start_time}}<span> To </span>
                                                    {{$key->end_time}}
                                                </td> 
                                                @endif 
                                            @endforeach                                   
                                        </tr>                                        
                                        <tr>
                                            <td>TUESDAY</td> 
                                            @foreach($tus as $key)
                                                @if($key->class_id == $class_id)
                                                <td>
                                                    {{$key->subject_subject_name}}<br>
                                                    {{$key->start_time}}<span> To </span>
                                                    {{$key->end_time}}
                                                </td>
                                                @endif 
                                            @endforeach                                     
                                        </tr>                                     
                                        <tr>
                                            <td>WEDNESDAY</td>   
                                            @foreach($wed as $key)
                                                @if($key->class_id == $class_id)
                                                <td>
                                                    {{$key->subject_subject_name}}<br>
                                                    {{$key->start_time}}<span> To </span>
                                                    {{$key->end_time}}
                                                </td> 
                                                @endif 
                                            @endforeach                                 
                                        </tr>                              
                                        <tr>
                                            <td>THURSDAY</td>   
                                            @foreach($thu as $key)
                                                @if($key->class_id == $class_id)
                                                <td>
                                                    {{$key->subject_subject_name}}<br>
                                                    {{$key->start_time}}<span> To </span>
                                                    {{$key->end_time}}
                                                </td>
                                                @endif
                                            @endforeach                                   
                                        </tr>                             
                                        <tr>
                                            <td>FRIDAY</td>     
                                            @foreach($fri as $key)
                                                @if($key->class_id == $class_id)
                                                <td>
                                                    {{$key->subject_subject_name}}<br>
                                                    {{$key->start_time}}<span> To </span>
                                                    {{$key->end_time}}
                                                @endif     
                                            @endforeach                                       
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <h4 class="quick-navigation">Quick Navigation</h4>
                                <div class="widget cs-widget-links">
                                    <ul>
                                        <li><a class="{{ request()->is('dress-code') ? 'ctg_active ' : '' }}" href="{{ route('dress-code-page') }}">Dress Code</a></li>
                                        <li><a class="{{ request()->is('academic-calendar') ? 'ctg_active ' : '' }}" href="{{ route('academic-calendar-page') }}">Academic Calendar</a></li>
                                        <li><a class="{{ request()->is('book-list-and-syllabust') ? 'ctg_active ' : '' }}" href="{{ route('book-list-and-syllabus-page') }}">Book List & Syllabus</a></li>
                                        <li><a class="{{ request()->is('class-routine') ? 'ctg_active ' : '' }} || {{ request()->is('showClassRoutins') ? 'ctg_active ' : '' }}" href="{{ route('class-routine-page') }}">Class Routine</a></li>
                                        <li><a class="{{ request()->is('exam-routine') ? 'ctg_active ' : '' }}" href="{{ route('exam-routine-page') }}">Exam Routine</a></li>
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

    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({

                url: "{{ url('find_sections') }}"+'/'+class_id,
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