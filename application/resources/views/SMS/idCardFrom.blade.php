@extends('layouts.SMS-APP')
@section('content')
<style>

    .id-card-holder {
        padding: 4px;
        border-radius: 5px;
        position: relative;
    }
    .id-card-holder:after {
        content: '';
        width: 7px;
        display: block;
        background-color: #0f5586;
        height: 100px;
        position: absolute;
        top: 105px;
        border-radius: 0 5px 5px 0;
    }
    .id-card {

        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 1.5px 0px #b9b9b9;
        height: 100%;
    }
    .id-card img {
        margin: 0 auto;
    }
    .header img {
        width: 100px;
        /*margin-top: 6px;*/
    }
    .photo img {
        width: 80px;
        margin-top: 15px;
    }

    .id-card-hook {
        background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }
    .id-card-hook:after {
        content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }
    .id-card-tag-strip {
        width: 45px;
        height: 40px;
        background-color: #0950ef;
        margin: 0 auto;
        border-radius: 5px;
        position: relative;
        top: 9px;
        z-index: 1;
        border: 1px solid #0041ad;
    }
    .id-card-tag-strip:after {
        content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #c1c1c1;
        position: relative;
        top: 10px;
    }
    .id-card-tag {
        width: 0;
        height: 0;
        border-left: 100px solid transparent;
        border-right: 100px solid transparent;
        border-top: 100px solid #0958db;
        margin: -10px auto -30px auto;
    }
    .id-card-tag:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 100px solid #d7d6d3;
        margin: -10px auto -30px auto;
        position: relative;
        top: -130px;
        left: -50px;
    }
    @media print {
        @page {
            size: auto;
            margin: 0mm;
        }
        #btn{
            visibility: hidden !important;
        }
        .table_head{
            background-color: #4391b1!important;
            color: white;
        }
        .noPrint{
            display: none;
        }
        .tableHead{
            background-color: #4391b1 !important;
            color: white;
        }
        .header{
            background-color: #4991b3 !important;
            height: 40px;
        }
    }
</style>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>{{$title}} <button class="btn btn-default" id='btn' onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button></h2>
                    <ul class="header-dropdown dropdown dropdown-animated scale-left">
                        <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                        <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);">Print Invoices</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="javascript:void(0);">Export to XLS</a></li>
                                <li><a href="javascript:void(0);">Export to CSV</a></li>
                                <li><a href="javascript:void(0);">Export to XML</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body" >
                    <div class="tab-content mt-3">
                        <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
                            
                            <div class="row clearfix"  style="margin-left: 7%;">
                                <div class="col-md-11" style="border:1px solid black; background-color: #eff5f5;">
                                    <div class="container">
                                        <div class="row" style="padding-top: 20px; padding-bottom: 50px;" id="printableArea">
                                            <div class="col-md-2"><img src="" style="width: 100%;"></div>
                                            <div class="col-md-8 noPrint" style="text-align: center; padding-top: 20px;">
                                                <h3></h3>
                                                <p style="line-height: 9px;"></p>
                                                <p style="line-height: 9px;"><div style="margin-bottom: 20px; margin-left: 30px;" id="button">
                                                    
                                                </div></p>
                                            </div>
                                            <div class="col-md-6" >
                                                <div class="id-card-holder">
                                                    <div class="id-card" >
                                                        @foreach($manage_settings as $settings)
                                                        <div style='background-image: url("{{asset('uploads/idcard-banner.png')}}");background-size: cover; background-position: center;'>
                                                            <img src="{{asset('uploads').'/'.$settings->image}}" style="width: 35%;">
                                                        </div>
                                                        @endforeach
                                                        <br>
                                                        @foreach($manage_mambers as $members)
                                                        <div class="qr-code">
                                                            <img src="{{asset('uploads').'/'.$members->student_photo}}" style="width: 30%; border-radius: 50%; ">
                                                        </div>
                                                        <h3>{{$members->student_name}}</h3>
                                                        <p>CLass: {{$members->class_name}} , Section: {{$members->section_name}}, Roll: {{$members->student_roll_no}}</p>
                                                        <table class="table" >
                                                            <tr>
                                                                <td>Email</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_phone}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Address</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_address}}</td>
                                                            </tr>
                                                        </table>
                                                        @endforeach
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="id-card-holder">
                                                    <div class="id-card">
                                                        <div class="">
                                                            <img src="{{asset('uploads').'/'.$settings->logo_banner}}" style="width: 100%;">
                                                        </div>
                                                        <br>
                                                        <div class="qr-code">
                                                            <center>{!! DNS1D::getBarcodeHTML($members->student_card_id, "C39",2,30,"#344857") !!}</center>
                                                        </div><br>
                                                        <table class="table">
                                                            <tr>
                                                                <td>Guardian</td>
                                                                <td>:</td>
                                                                <td>{{$members->guardian_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Country</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_country}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Birthday</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_birthday}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Blood</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_blood_group}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gender</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_gender}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Group</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_group}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Registration</td>
                                                                <td>:</td>
                                                                <td>{{$members->student_register_no}}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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