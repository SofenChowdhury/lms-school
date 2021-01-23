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
                            <a href="{{ route('user-attendance') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form id="basic-form" method="post" novalidate>
                        <div class="row">
                            <div class="col-md-12">
                               <div class="col-md-3">
                                    <label>Class  </label>
                                    <select  name="country" class="form-control">
                                        <option value="">Select Class</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>                                    
                               <div class="col-md-3">
                                    <label>Section  </label>
                                    <select  name="country" class="form-control">
                                        <option value="">Select Section</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                    </select>
                                </div>
                               <div class="col-md-3"><label>Date  </label>
                                    <input type="date" name="name" class="form-control" >
                                </div>
                                <div class="col-md-3">
                                    <label>  </label><br>
                                 <button type="submit" class="btn btn-default m-t-10">Add</button>
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