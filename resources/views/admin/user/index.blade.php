@extends('admin.master')
@section('title')
Employés
@stop
@section('content')

<div>
@livewire('user-form')

</div>




@section('script')
<link href="{{asset('/assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />
<script src="{{asset('/assets/plugins/select-picker/dist/picker.min.js')}}"></script>

    
@livewireStyles
@livewireScripts


@stop
@stop