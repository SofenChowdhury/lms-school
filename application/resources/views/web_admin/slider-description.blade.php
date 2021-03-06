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
                            <a href="{{ route('slider-web') }}" class="btn btn-primary  pull-right"><i class="fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover">       
                            <tbody>                                        
                                <tr>       
                                    <td>Image</td>                                     
                                    <td><img src="{{ asset('uploads/'.$sliders->image) }}" style="width:100%;height: 350px"></td>
                                </tr>
                                <tr>
                                    <td>Title</td>   
                                    <td>{{ $sliders->title }}</td>
                                </tr>
                                <tr>
                                    <td>Short Descripton</td> 
                                    <td>{{ $sliders->short_description }}</td>  
                                <tr>
                                    <td> Descripton</td> 
                                    <td>{!!  $sliders->description !!}</td>                                           
                                </tr>
                              <tr>
                                    <td> Action</td> 
                                    <td> <a href="{{ route('update-slider-web',['id'=>$sliders->id]) }}" ><button class="btn btn-default">Edit</button> </a></td>                                           
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