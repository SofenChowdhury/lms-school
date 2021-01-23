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
                            <a href="{{ route('income') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateincomeFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_income as $income)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Income Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="income_name" value="{{$income->income_name}}" class="form-control" >
                                    <input type="hidden" name="income_id" value="{{$income->income_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Date* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="income_date" value="{{$income->income_date}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Amount *  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="income_amount" value="{{$income->income_amount}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Pdf  * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="pdf" value="{{$income->pdf}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note *</p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="income_note" class="form-control">{{$income->income_note}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
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