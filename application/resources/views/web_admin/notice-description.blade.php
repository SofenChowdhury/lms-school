@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">            
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} Description</h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('notice-web') }}" class="btn btn-primary  pull-right"> <i class="fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover">       
                            <tbody>                                        
                                <tr>       
                                    <td>Image</td>                                     
                                    <td><img src="{{ asset('uploads/'.$notice->image) }}" style="width:100%;height: 350px"></td>
                                </tr>
                                <tr>
                                    <td>Title</td>   
                                    <td>{{ $notice->title }}</td>
                                </tr>
                                <tr>
                                    <td>Short Descripton</td> 
                                    <td>{!! $notice->short_description !!}</td>  
                                <tr>
                                    <td> Descripton</td> 
                                    <td>{!!  $notice->description !!}</td>                                           
                                </tr>
                                <tr>
                                    <td> Action</td> 
                                    <td> <a href="{{ route('update-notice-web',['id'=>$notice->id]) }}" ><button class="btn btn-default">Edit</button> </a></td>                                           
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>
@endsection