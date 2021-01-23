@extends('layouts.SMS-APP')
@section('content')
<style>
    #invoice{
    padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,.invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,.invoice table .total,.invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px!important;
            overflow: hidden!important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>

<div id="invoice">
    <div class="invoice">
        <div class="container">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="">
                                <img src="{{asset('uploads').'/'.$manage_settings->image}}" data-holder-rendered="true" style="height: 100px;" />
                                </a>
                        </div>
                        <div class="col company-details">
                            <div style="width: 350px; float: right;">
                                <h2 class="name">
                                    <a target="_blank" href="">
                                    {{$manage_settings->name}}
                                    </a>
                                </h2>
                                <div>{{$manage_settings->address}}</div>
                                <div>{{$manage_settings->phone}}</div>
                                <div>{{$manage_settings->email}}</div>
                            <div>
                        </div>
                    </div>
                </header>
                <main>
                    @php
                        $user_role = Auth::user()->role;
                    @endphp
                    @if($user_role == 'PARENTS')
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <h4 class="to">{{$manage_message->guardian_name}}</h4>
                            <div class="address">{{$manage_message->guardian_address}}</div>
                            <div class="email"><a href="mailto:{{$manage_message->guardian_email}}">{{$manage_message->guardian_email}}</a></div>
                        </div>
                    </div>
                    @elseif($user_role == 'STUDENT')
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <h4 class="to">{{$manage_message->student_name}}</h4>
                            <div class="address">{{$manage_message->student_address}}</div>
                            <div class="email"><a href="mailto:{{$manage_message->student_email}}">{{$manage_message->student_email}}</a></div>
                        </div>
                    </div>
                    @else
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <h4 class="to">{{$manage_message->teacher_name}}</h4>
                            <div class="address">{{$manage_message->teacher_address}}</div>
                            <div class="email"><a href="mailto:{{$manage_message->student_email}}">{{$manage_message->teacher_email}}</a></div>
                        </div>
                    </div>
                    @endif
                    <div>
                        <h3 style="text-align: center;">{{$manage_message->inbox_title}}</h3>
                        <hr>
                       {!! $manage_message->inbox_message !!} 
                    </div>
                    <div style="font-size: 36px; font-weight: bold; padding-top: 50px; font-family: 'Arizonia'!important;">Thank you!</div>

                </main>
                <footer>
                    A Message from <span style="color: #4991b3;">{{ $manage_settings->name }}</span> Address : {{$manage_message->student_address}}
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            
        </div>
    </div>
</div>

@endsection