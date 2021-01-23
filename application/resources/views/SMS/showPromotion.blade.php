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
                        <form action="{{route('save_promotionForm')}}"  method="post">
                            @csrf()
                            <table class="" style="margin-bottom: 40px;">
                                <tr>
                                    <th>Promoted Class</th>
                                    <th>:</th>
                                    <td>
                                        <select  name="promoted_class" class="form-control" style="width: 300px;">
                                            
                                            <option value="{{ $class_name->class_id }}"> {{ $class_name->class_name }}</option>
                                            @foreach($manage_class as $key)
                                            <option value="{{$key->class_id}}">{{$key->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        <th>Total Marks</th>
                                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($show_student as $student)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td><img src="{{asset('uploads').'/'.$student->student_photo}}" style="width: 80px; height: 80px;"></td>
                                        <td>{{$student->student_name}} <input type="hidden" name="up_student" value="{{date('y-m-d h:i:s')}}"></td>
                                        <td>{{$student->student_roll_no}}</td>
                                        @php
                                            $sum_mcq = DB::table('exam_marks')
                                                ->where('student_id',$student->student_id)
                                                ->sum('mcq_marks');
                                            $sum_theory = DB::table('exam_marks')
                                                ->where('student_id',$student->student_id)
                                                ->sum('theory_marks');
                                            $total_marks = $sum_mcq + $sum_theory;
                                        @endphp
                                        <td>{{$total_marks}}</td>
                                        <td>
                                            <input type="checkbox" class="btn present" value="{{$student->student_id}}" name="student_id[]">
                                            <label style="vertical-align:  middle;display: inline;">Promoted </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" style="margin-top: 20px;" class="btn btn-default pull-right save_attendance">Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection