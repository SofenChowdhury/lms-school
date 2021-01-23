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
                            <a href="{{ route('machines') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('submitmachine') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Machine_sn </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="machine_sn" placeholder="Machine_sn ...." class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Machinestype </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="machinestype" class="form-control">
                                        <option value="">Select Machine</option>
                                        <option value="SCHOOLGATE">School Gate</option>
                                        <option value="SCHOOLROOM">School Room</option>
                                    </select>
                                </div>
                            </div>
                            
                            <br>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection