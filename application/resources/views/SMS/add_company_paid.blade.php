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
                            <a href="{{ route('company_paid') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                     <form  method="post" action="{{ route('submitPaymentFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        	<div class="col-md-2">
                                <p>Marketing user_name *</p>
                            </div>
                            <div class="col-md-6">
                                <select  name="mm_id" class="form-control">
                                    <option value="">Select Marketing Officer</option>
                                    @foreach($manage_mm as $mm)
                                    <option value="{{$mm->id}}">{{$mm->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Title* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title" class="form-control" >
                                    <input type="hidden" name="school_name" value="{{$school_name}}" class="form-control" >
                                    <input type="hidden" name="domain_name" value="{{$domain_name}}" class="form-control" >
                                    @foreach($user_name as $user_name)
                                    <input type="hidden" name="user_name" value="{{$user_name->user_name}}" class="form-control" >
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Amount* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="amount" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Description </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="description" class="form-control" rows="5"></textarea>
                                </div>
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