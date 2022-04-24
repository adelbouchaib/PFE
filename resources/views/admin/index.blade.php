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
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">Total Employees</h5>
        <h3 class="text-white mt-n1">{{ $usersnb }}</h3>
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
          <h5 class="text-white text-opacity-80 mb-3 fs-16px">IN Employees</h5>
          <h3 class="text-white mt-n1">{{ $usersnbatt }}</h3>

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
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">OUT Employees</h5>
        <h3 class="text-white mt-n1">
          @php
          $nb =  $usersnb - $usersnbatt - $usersnbconge ;
         @endphp
          
          <?php echo $nb ?></h3>
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
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">Conge</h5>
        <h3 class="text-white mt-n1">
          {{ $usersnbconge }}
        </h3>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
  
      </div>
    </div>
  </div>

{{-- 
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
  </div> --}}
  <div class="row">
    <div class="col-xl-7">
      <div class="card">
          <div class="card-header">   
            <i class="far fa-bell text-muted me-2"></i>
            Demandes de congé récentes
            <a href="{{route('admin.conge.index')}}" style="float:right" class="align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a>    
          </div>
          <div class="card-body">
            <canvas id="myChart" width="400" height="400" style="max-height: 350px"></canvas>
          </div>
    </div>
  </div>
    <div class="col-xl-5">
      <div class="card">
          <div class="card-header">   
            <i class="far fa-bell text-muted me-2"></i>
            Demandes de congé récentes
            <a href="{{route('admin.conge.index')}}" style="float:right" class="align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a>    
          </div>
          <div class="card-body">

            <table class="table">
              <tbody>
                @foreach ($conges as $conge)
                  <div class="toast-header">
                    <strong class="me-auto">{{$conge->first_name}} {{$conge->last_name}}</strong>
                    <small>{{$conge->created_at->diffForHumans()}}</small>
                  </div>
                  <div class="toast-body">
                    a demandé un congé de  {{ $conge->duree }}
                  </div>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
  </div>
 
</div>
  
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>


<script>
  var datas = <?php echo json_encode($datas); ?>;
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Aout', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: '# of Votes',
            data: datas,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true   

            }
        }
    }
});
</script>
@stop
  


@stop