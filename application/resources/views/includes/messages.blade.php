@if(count($errors) > 0)
    @foreach($errors->all() as $error)     
  
    <div class="alert alert-warning" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center justify-content-start">
        <i class="fas fa-exclamation-trianglealert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
        <span><strong>Warning!</strong> {{$error}}</span>
    </div><!-- d-flex -->
    </div>    
        
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center justify-content-start">
        <i class="fas fa-check-circle mg-t-5 mg-xs-t-0"></i>
        <span><strong>Well done!</strong> {{session('success')}}.</span>
    </div><!-- d-flex -->
    </div><!-- alert -->
@endif

@if(session('error'))    
    <div class="alert alert-warning" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center justify-content-start">
        <i class="fas fa-exclamation-trianglealert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
        <span><strong>Warning!</strong> {{session('error')}}</span>
    </div><!-- d-flex -->
    </div>    
        
@endif