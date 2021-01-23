@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" action="{{route('show_profit')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label>Start Date </label>
                                    <input type="date" name="start_date" id="datepicker" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>End Date </label>
                                    <input type="date" name="end_date" id="datepicker" class="form-control">
                                </div>
                                <!-- <div class="col-md-3">
                                    <label>Month </label>
                                    <input type="month" name="end_date" id="datepicker" class="form-control">
                                </div> -->
                                <div class="col-md-4">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default btn-block m-t-10 pull-right">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#datepicker").datepicker( {
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months"
        });
</script>
@endsection