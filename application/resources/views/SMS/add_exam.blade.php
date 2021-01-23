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
                            <a href="{{ route('exam') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                     <form  method="post" action="{{ route('submitExamFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Exam Name * </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="exam_name" class="form-control" >
                                </div>
                            </div>   
                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Date* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="exam_date" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                               <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="exam_note" class="form-control"></textarea>
                                </div>
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