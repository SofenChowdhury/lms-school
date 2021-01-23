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
                            <a href="{{ route('invoice') }}" class="btn btn-primary  pull-right"> <i class="fa fa fa-list-alt"></i> {{ $title }} List</a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('includes.messages')
                    <form  method="post" action="{{ route('updateInvoiceFrom') }}" validate enctype="multipart/form-data">
                        @csrf
                        @foreach($manage_fee_type as $invoice)
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <p>Class *  </p>
                                    </div>
                                    <div class="col-md-6">
                                        <select  name="class_id" id="class_id" class="form-control">
                                            <option value="{{$invoice->class_id}}">{{$invoice->class_name}}</option>
                                            @foreach($class as $key)
                                            <option value="{{$key->class_id}}"><span>{{$key->class_name}}</span></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <p>Student *  </p>
                                    </div>
                                    <div class="col-md-6">
                                        <select  name="student_id" id="student_id" class="form-control">
                                            <option value="{{$invoice->student_id}}">{{$invoice->student_name}}</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12">
                                    <div class="col-md-2">
                                        <p>Fee Type *  </p>
                                    </div>
                                    <div class="col-md-6">
                                        <select  name="fee_type_id" class="form-control" id="addon-select">
                                            <option value="{{$invoice->fee_type_id}}">{{$invoice->fee_type}}</option>
                                            @foreach($fee_type as $key)
                                            <option value="{{$key->fee_type_id}}">{{$key->fee_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                                
                                <!-- <input type="text" name="fee_type_id[]" value="'+feeTypes[i]+'"> -->
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <p>Paid *  </p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="paid" value="{{$invoice->paid}}" class="form-control" >
                                        <input type="hidden" name="invoice_id" value="{{$invoice->invoice_id}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <p>Discount *  </p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="discount" value="{{$invoice->discount}}" class="form-control" placeholder="Enter Discount percent (%)" >
                                    </div>
                                    <div class="col-md-6" id="totalamountInput">
                                        
                                    </div>
                                    <div class="col-md-6" id="feeTypeInput">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <p>Note </p>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea type="text" name="note" class="form-control">{{$invoice->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pull-right">
                                <table class="table table-bordered " id="fee_type_list">
                                    <tr >
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </table>
                                <div id="totalamount" style="float: right;"></div>
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
                url: "{{ url('find-students') }}"+'/'+clsas_id,
                method: 'get',
                success: function(result){
                    $('#student_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Student</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#student_id").append(new Option(result[i].student_name + ' Roll: ' + result[i].student_roll_no + ' Section: ' + result[i].section_name, result[i].student_id));
                    }
                  }
              });
        $.ajax({

                url: "{{ url('find-fee-type') }}"+'/'+clsas_id,
                method: 'get',
                success: function(result){
                    $('#addon-select')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select fee_type</option>'); 
                    for ( var i = 0, l = result.length; i < l; i++ ) {
                        $("#addon-select").append(new Option(result[i].fee_type, result[i].fee_type_id));
                    }
                  }
              });
           });
</script>

<script>

      // Create an empty array to store results      
      var totalamount =0;
      var feeTypes =[];
      // Delegate the change event on each .addon-select
      $('#addon-select').on('change', function() {
         var fee_id = $('#addon-select option:selected').val();   
         $('#addon-select option:selected').hide(); 

         console.log(fee_id);
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({

                url: "{{ url('find-fee-type-invoice') }}"+'/'+fee_id,
                method: 'get',
                success: function(result){ 

                     for ( var i = 0, l = result.length; i < l; i++ ) {
                        feeTypes[i] = result[i].fee_type_id;
                        $("#totalamount span").remove();
                        $("#totalamountInput input").remove();
                          totalamount +=  parseInt(result[i].amount)  
                        $("#fee_type_list").append('<tr><td id="'+ result[i].fee_type_id+'">'+ result[i].fee_type + '</td><td>'+ result[i].amount+'</td><tr>');
                        $('#feeTypeInput').append('<input type="text" name="fee_type_id[]" value="'+feeTypes[i]+'">');

                      }
                     $("#totalamount").append('<span>Total Amount :'+ totalamount+' </span>');
                     $("#totalamountInput").append('<input type="text" name="totalfee" value="'+ totalamount+'">');

                  }

              });

      

    });
         
</script>
@endsection