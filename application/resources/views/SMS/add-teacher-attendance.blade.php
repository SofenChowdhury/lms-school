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
                            <a href="{{ route('teacher-attendance') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" method="post" action="{{ route('saveteacherForm') }}" validate enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                               <!-- <div class="col-md-3">
                                    <label>Class  </label>
                                    <select  name="country" class="form-control">
                                        <option value="">Select Class</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>  -->                                   
                               <!-- <div class="col-md-3">
                                    <label>Section  </label>
                                    <select  name="country" class="form-control">
                                        <option value="">Select Section</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div> -->
                               <div class="col-md-6"><label>Date </label>
                                    <input type="date" name="date" class="form-control" >
                                </div>
                                <div class="col-md-6">
                                    <label>  </label><br>
                                 <button type="submit" class="btn btn-block btn-default m-t-10">Show</button>
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