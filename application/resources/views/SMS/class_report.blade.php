@extends('layouts.SMS-APP')
@section('content')
<style>
    .noPrint{
        display: none;

    }
    .tableHead{
        background-color: #4391b1; 
        color: white;
    }
    @media print {
        @page { 
            size: auto; 
            margin: 0mm;
        }       
        .table_head{
            background-color: #4391b1!important; 
            color: white;
        }
        .noPrint{
            display: block !important;
            padding-bottom: 35px !important;
            text-align: center !important;
        }
        .tableHead{
            background-color: #4391b1 !important; 
            color: white;
        }
    }

</style>
@if($user_role = Auth::user()->role == 'STUDENT' || $user_role = Auth::user()->role == 'PARENTS')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>{{ $title }} <button class="btn btn-default" id='btn' onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button></h2>
                        </div>
                    </div>
                </div>
                <div class="body" id="printableArea">
                    <div class="row clearfix" style="margin-top: 0px;">
                        @foreach($school_info as $info)
                        @if($info->logo_banner)
                        <div class="col-lg-12" style="background-image: url('{{asset('uploads').'/'.$info->logo_banner}}'); height: 170px; margin-bottom: 50px; background-position: center; background-size: cover;">
                        </div>
                        @else
                        <div class="col-lg-12" >
                            <center>
                            <img src="{{asset('uploads').'/'.$info->image}}" style="border-radius: 50%; border:5px solid lightgray; width: 100px;height: 100px;">
                            </center><br>
                            <p style="text-align: center; line-height: 9px;">{{$info->name}}</p>
                            <p style="text-align: center; line-height: 9px;">{{$info->address}}</p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 text-center noPrint">
                            <h5><b>{{$title}} || Class: {{$get_class->class_name}}, Section: {{$get_class->section_name}}</b></h5>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-hover" style="border: #4391b1 solid;">
                                    
                                    <tbody>
                                        <tr class="tableHead">
                                            <td colspan="3">#Class Information</td>
                                        </tr>
                                        <tr>
                                            <td>Number of Students</td>
                                            <td>:</td>
                                            <td>{{$count_student}}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Subject Assigned</td>
                                            <td>:</td>
                                            <td>{{$count_subject}}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="">
                                <table class="table table-hover pTable" style="border: #4391b1 solid;">
                                    <tbody>
                                        <tr class="tableHead">
                                            <th colspan="2">#Subjects And Teachers</th>
                                        </tr>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                        </tr>
                                        @foreach($subject_teacher as $key)
                                        <tr>
                                            <td>{{$key->subject_subject_name}}</td>
                                            <td>{{$key->teacher_name}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <table class="table table-hover" style="border: #c74b81 solid;">
                                    <tbody>
                                        <tr class="tableHead">
                                            <th>#Class Teacher</th>
                                        </tr>
                                        @foreach($class_teacher as $teacher)
                                        <tr>
                                            <td style="background-color: #e8e8e8;">
                                                <center>
                                                <img src="{{asset('uploads').'/'.$teacher->teacher_photo}}" style="border-radius: 50%; border:5px solid lightgray; width: 100px;">
                                                </center><br>
                                                <div class="col-md-12">
                                                    <table class="table">
                                                        <tr>
                                                            <td><i class="fa fa-phone"></i></td>
                                                            <td>Phone</td>
                                                            <td>:</td>
                                                            <td>{{$teacher->teacher_phone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fa fa-envelope"></i></td>
                                                            <td>Email</td>
                                                            <td>:</td>
                                                            <td>{{$teacher->teacher_email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fa fa-globe"></i></td>
                                                            <td>Address</td>
                                                            <td>:</td>
                                                            <td>{{$teacher->teacher_address}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
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
    </div>
</div>
@else
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-lg-6" style="float: left;">
                            <h2>Search {{ $title }}</h2>
                        </div>
                    </div>
                    
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form id="basic-form" action="{{route('show_class_report')}}" method="post" novalidate>
                        @csrf()
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label>Class </label>
                                    <select  name="class_id" id="class_id" class="form-control" >
                                        <option value="">Select Class</option>
                                        @foreach($manage_class as $class)
                                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Section </label>
                                    <select  name="saction_id" id="section_id" class="form-control" >
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label> </label><br>
                                    <button type="submit" class="btn btn-default m-t-10 btn-block">Show</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script>
    $('#class_id').change(function(){
        var class_id = $('#class_id option:selected').val();       
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ url('find-routine-section') }}"+'/'+class_id,
                method: 'get',
                success: function(result){
                    $('#section_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Section</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#section_id").append(new Option(result[i].section_name, result[i].saction_id));
                    }
                  }
              });
           });
</script>

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