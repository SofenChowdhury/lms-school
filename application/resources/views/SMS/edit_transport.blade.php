@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Edit {{ $title }}</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('transport') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateTransportFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_transport as $transport)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Route Name * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="route_name" value="{{$transport->route_name}}" class="form-control" >
                                    <input type="hidden" name="transport_id" value="{{$transport->transport_id}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Number of Vehicle* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="no_vehicle" value="{{$transport->no_vehicle}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Route Fare* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="route_fare" value="{{$transport->route_fare}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="note" class="form-control">{{$transport->note}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
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