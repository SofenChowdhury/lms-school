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
                                @foreach($chairman_message as $key)
                                <div class="col-md-4" style="background:#ddd; margin-right: 15px;padding: 15px;    border-radius: 12px;">
                                    <img src="{{ asset('uploads/'.$key->image) }}" style="width: 100%;    border-radius: 12px;margin-bottom: 10px ">
                                    <h5 style="text-align: center;">{{ $key->name }}</h5>
                                    <p style="text-align: center;">{{ $key->designation }}<br>{{ $key->institute_name }}
                                </div>
                                <br>
                                <h4>{{ $key->title }}</h4><br>
                                <p>{!! $key->short_description !!}</p>
                                <p>{!! $key->description !!}</p>
                                <br>
                                <a href="{{ route('update-chairma-message-web',['id'=>$key->id]) }}"><button type="button" class="btn btn-default">Edit</button></a>
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