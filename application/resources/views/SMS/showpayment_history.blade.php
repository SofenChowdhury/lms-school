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
              </div>
            </div>
            <div class="body">
              @include('includes.messages')
              <div class="table-responsive">
                <table id="tableid" class="table table-bordered table-hover">
                  @foreach($get_invoice as $key_invoice)
                  <tr>
                    <td>
                      <img src="{{asset('uploads').'/'.$key_invoice->student_photo}}" style="width: 150px;">
                    </td>
                    <td>
                      <p>{{$key_invoice->student_name}}</p>
                      <p>Class: {{$key_invoice->class_name}}</p>
                      <p>Paid : {{$key_invoice->paid}}</p>
                    </td>
                    <td>
                      <table class="table">
                        @foreach($manage_payment_history as $payment_history)
                        @if($payment_history->random_id == $key_invoice->fee_type_id)
                        <tr>
                          <td>fee_type</td>
                          <td>{{$payment_history->fee_type}}</td>
                        </tr>
                        @endif
                        @endforeach
                      </table>
                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection