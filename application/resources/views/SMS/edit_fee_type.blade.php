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
                            <a href="{{ route('fee_types') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateFeeTypeFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_fee_type as $fee_type)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Fee Type* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="fee_type" value="{{$fee_type->fee_type}}" class="form-control" >
                                    <input type="hidden" name="fee_type_id" value="{{$fee_type->fee_type_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Class Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="class_id" class="form-control">
                                        <option value="{{$fee_type->class_id}}">{{$fee_type->class_name}}</option>
                                        @foreach($manage_class as $class)
                                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Fee Category* </p>
                                </div>
                                <div class="col-md-6">
                                    <select  name="fee_type_category" class="form-control">
                                        <option value="{{$fee_type->fee_type_category}}">
                                            @if($fee_type->fee_type_category == 'M')
                                            {{'Monthly'}}
                                            @else
                                            {{'Yearly'}}
                                            @endif
                                        </option>
                                        <option value="M">Monthly</option>
                                        <option value="Y">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Amount* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="amount" value="{{$fee_type->amount}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="note" class="form-control">{{$fee_type->note}}</textarea>
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