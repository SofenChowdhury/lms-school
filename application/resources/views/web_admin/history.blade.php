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
                                @foreach($history as $history)
                                <h4>{{ $history->title }}</h4><br>
                                <img src="{{ asset('uploads/'.$history->image) }}" style="width: 100%;">
                                <p>{!! $history->short_description !!}</p>
                                <p>{!! $history->description !!}</p>
                                <br>
                                <br>
                                <a href="{{ route('update-history-web',['id'=>$history->id]) }}"><button type="button" class="btn btn-default">Edit</button></a>
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