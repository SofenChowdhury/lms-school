@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} || {{date('F')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <style type="text/css">
                        .col-md-offset-3{
                        margin-left: 25%;
                    }
                    .attn{
                            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.12);
                        }
                    .holiday{
                        color: #e0443f;
                        font-weight: bold;
                    }
                    .present{
                        color: #00801e;
                        font-weight: bold;
                    }
                    .absent{
                        color: #e0443f;
                        font-weight: bold;
                    }
                    .attn p{
                        background-color: white;
                    }
                    </style>
                <div class="col-md-6 col-md-offset-3" style="margin:0px auto; margin-left: 25%; margin-bottom: 50px;" >
                    <div style="margin-left: 30px; margin-bottom: 30px; margin-top: 20px;">
                        <?php
                            $str=0;
                            $ser_date=[];
                            for ($i=01; $i<=$month_day; $i++){
                                foreach ($noti_attn as $attn) {
                                    if($month == date('m') && date('d')==$i){
                                        $month_day=date('d');
                                    }
                                    $ser_date[] = date('Y-m-d',strtotime($attn->att_created_at));
                                }
                                if($i<10){
                                    $str = $year.'-'.$month.'-0'.$i;

                                }else{
                                    $str = $year.'-'.$month.'-'.$i;
                                }
                                $res_day = date('D',strtotime($year.'-'.$month.'-'.$i));
                                if(in_array($str, $ser_date)) {
                                    if($res_day == "Fri"){?>
                                        <div class="attn" style="text-align: center; color: white;  background-color: #29b056;height: 60px;width: 70px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p  class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><p  class="holiday" style="font-size: 15px;margin: 0px">Holiday</p></span></div>
                                    <?php }else{?>
                                        <div class="attn" style="text-align: center; color: white;  background-color: green;height: 60px;width: 70px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="present" style="font-size: 10px;margin: 0px">{{$res_day}}</p><p class="present" style="font-size: 15px;margin: 0px">Present</p></span></div>
                                    <?php }
                                } else {
                                    if($res_day == "Fri"){?>
                                        <div class="attn" style="text-align: center; color: white;  background-color: #da413f;height: 60px;width: 70px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="holiday" style="font-size: 10px;margin: 0px">{{$res_day}}</p><p class="holiday" style="font-size: 15px;margin: 0px">Holiday</p></span></div>
                                    <?php }else{?>
                                        <div class="attn" style="text-align: center; color: white;  background-color: #f5b120;height: 60px;width: 70px;float: left;margin: 5px;font-size: 10px;padding: 2px;padding-bottom: 0px !important;"><span>{{$i}}<p class="absent" style="font-size: 10px;margin: 0px">{{$res_day}}</p><p class="absent" style="font-size: 15px;margin: 0px">Absent</p></span></div>
                                    <?php }
                                } ?>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection