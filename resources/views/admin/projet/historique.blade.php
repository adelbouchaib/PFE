@extends('admin.master')
@section('title')
Historique
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">Historique</h4>
 </div>

<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table mb-0">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                     

                        @foreach($projets as $projet)
                        <tr>
                            <td>{{$projet->id}}</td>
                            <td>{{$projet->title}}</td>
                            <td>{{$projet->prenom}} {{$projet->nom}}</td>
                            <td>$1,699.00</td>
                            <td>{{$projet->start}}</td>
                            <td>{{$projet->finish}}</td>
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