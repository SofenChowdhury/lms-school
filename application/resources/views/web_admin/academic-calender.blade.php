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
                            <form id="basic-form" method="post" novalidate>
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($academic_calender as $key)                                        
                                        <h4>{{ $key->title }}</h4><br>                                       
                                        <p>{!! $key->description !!}</p>                                         
                                        <br>
                                        <a href="{{ route('update-academic-calender-web',['id'=>$key->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
@endsection