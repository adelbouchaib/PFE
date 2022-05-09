@extends('admin.master')
@section('title')
Présence
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">Présence</h4>
    {{-- <a href="#" title="" style="float:right" class="btn btn-primary btn-add-user"><i class="fa-solid fa-plus"></i></a> --}}
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
                            <th>Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($attendances as $attendance)
                            @if(Auth::User()->role==0)
                                <tr>
                                    <td>{{date('d-m-Y', strtotime($attendance->date))}}</td>
                                    <td>{{$attendance->user['first_name']}} {{$attendance->user['last_name']}}</td>
                                    <td>{{$attendance->start_time}}</td>
                                    <td>{{$attendance->end_time}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{date('d-m-Y', strtotime($attendance->date))}}</td>
                                    <td>{{$attendance->user['first_name']}} {{$attendance->user['last_name']}}</td>
                                    <td>{{$attendance->start_time}}</td>
                                    <td>{{$attendance->end_time}}</td>
                                </tr>
                            @endif
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