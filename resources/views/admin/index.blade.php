@extends('admin.master')
@section('title')
	Home
@stop
@section('content')





  <div class="row">
    <div class="col-sm">
      <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-orange" style="min-height: 199px;">
    
        <div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="assets/img/icon/order.svg" alt="" class="ms-auto d-block mb-n3" style="max-height: 105px" />
        </div>
      
        <div class="card-body position-relative">
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">New Orders</h5>
        <h3 class="text-white mt-n1">56</h3>
        <div class="progress bg-black bg-opacity-50 mb-2" style="height: 6px">
        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
        </div>
        <div class="text-white text-opacity-80 mb-4"><i class="fa fa-caret-up"></i> 16% increase <br />compare to last week</div>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
  
      </div>
    </div>

    <div class="col-sm">
      <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-teal" style="min-height: 199px;">

        <div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="assets/img/icon/visitor.svg" alt="" class="ms-auto d-block mb-n3" style="max-height: 105px" />
        </div>     
        
        <div class="card-body position-relative">
          <h5 class="text-white text-opacity-80 mb-3 fs-16px">Page Visitors</h5>
          <h3 class="text-white mt-n1">60.5k</h3>
          <div class="progress bg-black bg-opacity-50 mb-2" style="height: 6px">
          <div class="progrss-bar progress-bar-striped bg-white" style="width: 50%"></div>
          </div>

        <div class="text-white text-opacity-80 mb-4"><i class="fa fa-caret-up"></i> 33% increase <br />compare to last week</div>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
        
      </div>
    </div>

    <div class="col-sm">
      <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-orange-red" style="min-height: 199px;">
    
        <div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="assets/img/icon/order.svg" alt="" class="ms-auto d-block mb-n3" style="max-height: 105px" />
        </div>
      
        <div class="card-body position-relative">
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">New Orders</h5>
        <h3 class="text-white mt-n1">56</h3>
        <div class="progress bg-black bg-opacity-50 mb-2" style="height: 6px">
        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
        </div>
        <div class="text-white text-opacity-80 mb-4"><i class="fa fa-caret-up"></i> 16% increase <br />compare to last week</div>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
  
      </div>
    </div>
  </div>


  <div class="list-group">
    @foreach($users as $user)
    <a href="{{route('admin.users.employee', ['id' => $user->id ])}}" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div>
          <h6 class="mb-0">{{ $user->first_name }} {{ $user->last_name }}</h6>
        </div>
      </div>
    </a>
    @endforeach
  </div>

  


@stop