@extends('admin.master')
@section('title')
	Home
@stop
@section('content')





  <div class="row">
    <div class="col-sm">
      <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-teal" style="min-height: 199px;">
    
        <div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="assets/img/icon/employee-svgrepo-com.svg" alt="" class="ms-auto d-block mb-n3" style="max-height: 105px" />
        </div>
      
        <div class="card-body position-relative">
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">Employés</h5>
        <h3 class="text-white mt-n1">{{ $usersnb }}</h3>
        <div><a href="{{ route('admin.users.index') }}" class="text-white d-flex align-items-center text-decoration-none">Voir tout<i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
  
      </div>
    </div>

    <div class="col-sm">
      <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-orange" style="min-height: 199px;">

        <div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="assets/img/icon/check-svgrepo-com.svg" alt="" class="ms-auto d-block mb-n3" style="max-height: 105px" />
        </div>     
        
        <div class="card-body position-relative">
          <h5 class="text-white text-opacity-80 mb-3 fs-16px">Présences</h5>
          <h3 class="text-white mt-n1">{{ $usersnbatt }}</h3>

        <div><a href="{{ route('admin.presences.index') }}" class="text-white d-flex align-items-center text-decoration-none">Voir tout<i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
        
      </div>
    </div>

    <div class="col-sm">
      <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-orange-red" style="min-height: 199px;">
    
        <div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="assets/img/icon/unchecked-svgrepo-com.svg" alt="" class="ms-auto d-block mb-n3" style="max-height: 105px" />
        </div>
      
        <div class="card-body position-relative">
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">Absences</h5>
        <h3 class="text-white mt-n1">
          @php
          $nb =  $usersnb - $usersnbatt - $usersnbconge ;
         @endphp
          
          <?php echo $nb ?></h3>
        <div><a href="{{ route('admin.absencesjustifiees.index') }}" class="text-white d-flex align-items-center text-decoration-none">Voir tout<i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
  
      </div>
    </div>

    <div class="col-sm">
      <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-yellow-red" style="min-height: 199px;">
    
        <div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
        <img src="assets/img/icon/hurry-worker-svgrepo-com.svg" alt="" class="ms-auto d-block mb-n3" style="max-height: 105px" />
        </div>
      
        <div class="card-body position-relative">
        <h5 class="text-white text-opacity-80 mb-3 fs-16px">En congé</h5>
        <h3 class="text-white mt-n1">
          {{ $usersnbconge }}
        </h3>
        <div><a href="#" class="text-white d-flex align-items-center text-decoration-none">Voir tout<i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
        </div>
  
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-xl-7">
      <div class="card">
          <div class="card-header">   
            <i class="far fa-bell text-muted me-2"></i>
            Taux de présence cette année
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
            Demandes de congé les plus récentes
            <a href="{{route('admin.conge.index')}}" style="float:right" class="align-items-center text-decoration-none">Voir tout<i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a>    
          </div>
          <div class="card-body">

            <table class="table">
              <tbody>
                @foreach ($conges as $conge)
                  <div class="toast-header">
                    <strong class="me-auto">{{$conge->prenom}} {{$conge->nom}}</strong>
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



<div class=" mb-3 mt-3">

  <div class="card h-100">
  
  <div class="card-body">
  <div class="d-flex align-items-center mb-2">
  <div class="flex-grow-1">
  <h5 class="mb-1">Projets</h5>
  <div class="fs-13px">Dernier historique des projets</div>
  </div>
  <a href="#" class="text-decoration-none">Voir tout</a>
  </div>
  
  <div class="table-responsive mb-n2">
    <table class="table table-borderless mb-0">
  <thead>
  <tr class="text-dark">
  <th class="ps-0">No</th>
  <th>Order Details</th>
  <th class="text-center">Chef</th>
  <th class="text-center">Status</th>
  <th class="text-center">Tasks</th>
  <th class="text-end pe-0">Amount</th>
  </tr>
  </thead>
  <tbody>
    @foreach ($projets as $projet)
  <tr>
  <td class="ps-0">{{ $projet->id }}</td>
  <td>
    <div class="d-flex align-items-center">
  <div class="ms-3 flex-grow-1">
    <div class="fw-600 text-dark">{{ $projet->title }}</div>
    <div class="fs-13px">{{ $projet->created_at }}</div>
    </div>
  </div>
  </td>
  <td class="text-center">{{ $projet->prenom }} {{ $projet->nom }}</td>
    @switch($projet->status)
      @case(0)
      <td class="text-center"><span class="badge bg-warning bg-opacity-20 text-warning" style="min-width: 60px;">To do</span></td>
        @break
        @case(1)
        <td class="text-center"><span class="badge bg-warning bg-opacity-20 text-warning" style="min-width: 60px;">In progress</span></td>
        @break
      @default
      <td class="text-center"><span class="badge bg-success bg-opacity-20 text-success" style="min-width: 60px;">
      Done
    </span></td>
    @endswitch
    
    <td class="text-center">$1,699.00</td>
  <td class="text-end pe-0">{{ $projet->finish }}</td>
  </tr>
        
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
            label: '# de Présence',
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