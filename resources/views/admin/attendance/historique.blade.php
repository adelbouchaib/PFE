@extends('admin.master')
@section('title')
Présence
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">Présence</h4>
    @can('index', \App\Dashboard::class)
    <a href="#" title="" style="float:right" class="btn btn-primary btn-add-user"><i class="fa-solid fa-plus"></i></a>
    @endcan   
</div>
<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <form type="get" action="{{ url('/attendances/search') }}">
                        <div class="modal-body">
                        <input type="date" style="width:auto; display:inline;" class="form-control"  name="date" id="date" />
                        <button type="submit" class="btn btn-secondary btn-sm"> Rechercher </button>
                        </div>
                    </form>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Matricule</th>
                            <th>Nom complet</th>

                           
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{$date}}</td>
                                    <td>{{$attendance->matricule}}</td>
                                    <td>{{$attendance->prenom}} {{$attendance->nom}}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@section('script')


   
@stop
@stop