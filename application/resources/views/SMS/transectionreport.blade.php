@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" action="{{route('showTransectionreport')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label>Start Date *</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                                <div class="col-md-4">
                                    <label>End Date *</label>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                                <!-- <div class="col-md-3">
                                    <label>Student *</label>
                                    <select  name="student_id" id="student_id" class="form-control">
                                        <option value="">Select Student</option>
                                    </select>
                                </div> -->
                                <div class="col-md-4 pull-right">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection