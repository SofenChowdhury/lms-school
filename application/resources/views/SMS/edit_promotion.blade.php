@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                        <!-- @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add-assignment') }}" class="btn btn-primary  pull-right">Add {{ $title }}</a>
                        </div>
                        @endif -->
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <div class="table-responsive">
                        <form action="{{route('edit_promotionForm')}}"  method="post">
                            @csrf()
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stu as $student)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td><img src="{{asset('uploads').'/'.$student->student_photo}}" style="width: 80px; height: 80px;"></td>
                                        <td>{{$student->student_name}} <input type="hidden" name="up_student" value="{{date('y-m-d h:i:s')}}"></td>
                                        <td>{{$student->class_name}}</td>
                                        <td>
                                            <table class="" style="margin-bottom: 40px;">
                                                <tr>
                                                    <th>Promoted Class</th>
                                                    <th>:</th>
                                                    <td>
                                                        <select  name="promoted_class" class="form-control" readonly>
                                                            <option value="{{$student->class_id}}"> {{$student->class_name}}</option>
                                                            
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>:</th>
                                                    <td><input type="text" name="role[]" value="{{$student->student_roll_no}}" class="form-control"></td>
                                                    <input type="hidden" class="btn present" value="{{$student->student_id}}" name="student_id[]">
                                                </tr>
                                                <tr>
                                                    <th>Section</th>
                                                    <th>:</th>
                                                    <td>
                                                        @php
                                                        $class_id = $student->student_class_id;
                                                        $manage_section = DB::table('sections')
                                                            ->where('class_id',$class_id)
                                                            ->get();
                                                        @endphp
                                                        <select  name="promoted_section[]" class="form-control">
                                                            <option value=""> Select Section</option>
                                                            @foreach($manage_section as $key)
                                                            <option value="{{$key->saction_id}}"> {{$key->section_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" style="margin-top: 20px;" class="btn btn-default pull-right save_attendance">Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection