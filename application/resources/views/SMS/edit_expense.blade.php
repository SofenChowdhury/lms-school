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
                            <a href="{{ route('expense') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateexpenseFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_expense as $expense)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Expance Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="exp_name" value="{{$expense->exp_name}}" class="form-control" >
                                    <input type="hidden" name="exp_id" value="{{$expense->exp_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Date* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="exp_date" value="{{$expense->exp_date}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Amount *  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="exp_amount" value="{{$expense->exp_amount}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note *</p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="exp_note"class="form-control">{{$expense->exp_note}}</textarea>
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