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
                    <form type="get" action="{{ url('/presences/search') }}">
                        <div class="modal-body">
                        <input type="date" style="width:auto; display:inline;" class="form-control"  name="date" id="date" />
                        <button type="submit" class="btn btn-secondary btn-sm"> Rechercher </button>
                        </div>
                    </form>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $user->counter }}
                        
                        @foreach($presences as $presence)
                                <tr>
                                    <td>{{date('d-m-Y', strtotime($presence->date))}}</td>
                                    <td>{{$presence->prenom}} {{$presence->nom}}</td>
                                    <td>{{$presence->start_time}}</td>
                                    <td>{{$presence->end_time}}</td>
                                    <td>
                                        <button type="submit" id="{{ $presence->id }}" class="btn btn-warning btn-edit-user"><i class="fa-solid fa-pencil"></i></a>
                                    </td>
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