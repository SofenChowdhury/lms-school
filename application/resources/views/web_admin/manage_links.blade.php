@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">            
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} </h2>
                        </div>
                        <div class="col-lg-6" style="float: right;">
                            <a href="{{ route('add_links') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus-square"></i> {{ $title }}</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        @include('includes.messages')
                        <table id="tableid" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Short Descripton</th>
                                    <th>Action</th>
                                </tr>
                            </thead>                                   
                            <tbody>
                                @foreach($manage_links as $key)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $key->title }}</td>
                                    <td>{{ $key->links }}</td>
                                    <td class="actions">                          
                                        <a href="{{ route('edit_links',['id'=>$key->id]) }}"><button class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                        data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button></a>
                                        <a href="{{ route('delete_links',['id'=>$key->id]) }}" onclick="return confirm('Are you sure?')"><button class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></a>
                                    </td>
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