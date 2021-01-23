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
                            <a href="{{ route('markpercentage') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateMarkPercentageFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_per as $percentage)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Distribution Type * </p>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="distribution_type" value="{{$percentage->distribution_type}}" class="form-control" >
                                    <input type="hidden" name="mark_per_id" value="{{$percentage->mark_per_id}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Mark Value </p>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="distribution_value" value="{{$percentage->distribution_value}}" class="form-control" >
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-4 ">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection