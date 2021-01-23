@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add_book') }}" class="btn btn-primary  pull-right"> <i class="fa fa-plus-square"></i> Add {{ $title }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <div class="table-responsive">
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Book Name</th>
                                    <th>Photo</th>
                                    <th>Author</th>
                                    <th>Serial No.</th>
                                    <th>Note</th>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manage_books as $book)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><img src="{{asset('uploads').'/'.$book->book_image}}" style="width: 100px; height: 100px;"></td>
                                    <td>{{$book->book_name}}</td>
                                    <td>{{$book->author}}</td>
                                    <td>{{$book->serial_id}}</td>
                                    <td>{{$book->note}}</td>
                                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SUPPERADMIN')
                                    <td class="actions">
                                        <a href="{{route('edit_book',['id'=>$book->book_id])}}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                        @if(Auth::user()->role == 'SUPPERADMIN')
                                        <a href="{{route('delete_book',['id'=>$book->book_id])}}" id="delete"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection