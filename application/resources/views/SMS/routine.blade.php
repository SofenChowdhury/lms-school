@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            @include('includes.messages')
            @foreach($classes as $class)
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Class-{{$class->class_name}} || Section-{{$class->section_name}} {{ $title }}</h2>
                        </div>
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add-routine') }}" class="btn btn-primary  pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>SATURDAY</td>
                                    @foreach($sat as $key)
                                    @if($key->class_id == $class->class_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>SUNDAY</td>
                                    @foreach($sun as $key)
                                    @if($key->class_id == $class->class_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>MONDAY</td>
                                    @foreach($mon as $key)
                                    @if($key->class_id == $class->class_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>TUESDAY</td>
                                    @foreach($tus as $key)
                                    @if($key->class_id == $class->class_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>WEDNESDAY</td>
                                    @foreach($wed as $key)
                                    @if($key->class_id == $class->class_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>THURSDAY</td>
                                    @foreach($thu as $key)
                                    @if($key->class_id == $class->class_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>FRIDAY</td>
                                    @foreach($fri as $key)
                                    @if($key->class_id == $class->class_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection