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
                            <a href="{{ route('hostel') }}" class="btn btn-primary pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateHostelFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_hostel as $hostel)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Hostel Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="hostel_name" value="{{$hostel->hostel_name}}" class="form-control" >
                                    <input type="hidden" name="hostel_id" value="{{$hostel->hostel_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Hostel type* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="hostel_type" class="form-control">
                                        <option value="{{$hostel->hostel_type}}">
                                            @if($hostel->hostel_type == 'b')
                                            {{"Boys"}}
                                            @else
                                            {{"Girls"}}
                                            @endif
                                        </option>
                                        <option value="b">Boys</option>
                                        <option value="g">Girls</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Hostel Address *  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="hostel_address" value="{{$hostel->hostel_address}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Hostel Fees *  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="hostel_fee" value="{{$hostel->hostel_fee}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="note" class="form-control">{{$hostel->note}}</textarea>
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