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
                            <a href="{{ route('books') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateBooksFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_book as $book)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Book Name* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="book_name" value="{{$book->book_name}}" class="form-control" >
                                    <input type="hidden" name="book_id" value="{{$book->book_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2" >
                                    <p>Photo  *    </p>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{asset('uploads').'/'.$book->book_image}}" style="width: 80px; height: 100px;">
                                    <input type="file" name="book_image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Book Author* </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="author" value="{{$book->author}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Serial ID *  </p>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="serial_id" value="{{$book->serial_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <p>Note </p>
                                </div>
                                <div class="col-md-6">
                                    <textarea type="text" name="note" class="form-control">{{$book->note}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
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