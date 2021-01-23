@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            @include('includes.messages')
            @foreach($subject as $subject)
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-12" style="float: left;">
                            <h2>Teacher Name- {{$subject->teacher_name}}&nbsp; <button class="btn btn-default" id='btn' onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button></h2>
                        </div>
                        <!-- <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add-routine') }}" class="btn btn-primary  pull-right">Add {{ $title }}</a>
                        </div> -->
                    </div>
                </div>
                <div class="body" id="printableArea">
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>SATURDAY</td>
                                    @foreach($sat as $key)
                                    @if($key->subject_teacher_id == $subject->subject_teacher_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}<br>
                                        Class : {{$key->class_name}}<br>
                                        Room : {{$key->room}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>SUNDAY</td>
                                    @foreach($sun as $key)
                                    @if($key->subject_teacher_id == $subject->subject_teacher_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}<br>
                                        Class : {{$key->class_name}}<br>
                                        Room : {{$key->room}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>MONDAY</td>
                                    @foreach($mon as $key)
                                    @if($key->subject_teacher_id == $subject->subject_teacher_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}<br>
                                        Class : {{$key->class_name}}<br>
                                        Room : {{$key->room}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>TUESDAY</td>
                                    @foreach($tus as $key)
                                    @if($key->subject_teacher_id == $subject->subject_teacher_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}<br>
                                        Class : {{$key->class_name}}<br>
                                        Room : {{$key->room}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>WEDNESDAY</td>
                                    @foreach($wed as $key)
                                    @if($key->subject_teacher_id == $subject->subject_teacher_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}<br>
                                        Class : {{$key->class_name}}<br>
                                        Room : {{$key->room}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>THURSDAY</td>
                                    @foreach($thu as $key)
                                    @if($key->subject_teacher_id == $subject->subject_teacher_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}<br>
                                        Class : {{$key->class_name}}<br>
                                        Room : {{$key->room}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </p>
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>FRIDAY</td>
                                    @foreach($fri as $key)
                                    @if($key->subject_teacher_id == $subject->subject_teacher_id)
                                    <td>
                                        {{$key->subject_subject_name}}<br>
                                        {{$key->start_time}}<span> To </span>
                                        {{$key->end_time}}<br>
                                        Class : {{$key->class_name}}<br>
                                        Room : {{$key->room}}
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <p class="actions" style="margin-top: 5px; margin-bottom: -5px;">
                                            <a href="{{route('edit_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->role == 'SUPPERADMIN')
                                            <a href="{{route('delete_routine',['id'=>$key->routine_id])}}" class="btn btn-sm btn-icon btn-pure btn-default on-editing m-r-5 button-save"
                                                data-toggle="tooltip" data-original-title="Delete" id="delete"><i class="icon-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
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
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection