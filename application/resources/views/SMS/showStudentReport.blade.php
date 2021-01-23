@extends('layouts.SMS-APP')
@section('content')
<style>
    @media print {
        
    }
</style>
<div style="margin-bottom: 20px; margin-left: 30px;" id="button">
        <button class="btn btn-default" id='btn' onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
</div>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-6" style="float: left;">
                            <h2>{{ $title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="body" id="printableArea">
                    @include('includes.messages')
                    <div class="col-md-12">
                        @foreach($manage_student as $student)
                        <div class="col-md-6">
                            <div class="col-md-12" style="border:1px solid; margin: 5px;">
                                <div class="col-md-12" style="padding-top: 13px; margin-right: 10px;">
                                    <div class="col-md-3" style="padding-top: 15px; margin-left: -15px; margin-right: 10px ;">
                                        <img src="{{asset('uploads').'/'.$student->student_photo}}" width="100px;">
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h5>{{$manage_sattings->name}}</h5>
                                        <p>{{$manage_sattings->address}}</p>
                                        <p>{!! DNS1D::getBarcodeHTML($student->student_id, "C39",2,25,"#344857") !!}</p>
                                    </div>
                                    <div class="col-md-3"><img src="{{asset('uploads').'/'.$manage_sattings->image}}" width="100px;"></div>
                                </div>
                                <div class="col-md-9">
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <th>:</th>
                                            <th>{{$student->student_name}}</th>
                                        </tr>
                                        <tr>
                                            <th>ID-Card</th>
                                            <th>:</th>
                                            <th>{{$student->student_card_id}}</th>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <th>:</th>
                                            <th>{{$student->student_phone}}</th>
                                        </tr>
                                        <tr>
                                            <th>Group</th>
                                            <th>:</th>
                                            <th>{{$student->student_group}}</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-3" style="border: 3px solid gray; text-align: center;">
                                    <table class="table">
                                        <tr>
                                            <th>Roll</th>
                                        </tr>
                                        <tr>
                                            <th style="font-size: 20px; line-height: 12px;">{{$student->student_roll_no}}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection