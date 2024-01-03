@extends('admin.admin_master')

@section('content')

<div class="page-content">
    <h2>Welcome {{Auth()->user()->name}}</h2>
</div>

@endsection


{{--
@php


    for ($i=1; $i <= 10 ; $i++) {

       for ($j= 1; $j <= 10 ; $j++) {

            echo $i ."X". $j ."=". $i * $j."</br>";
       }

    }


@endphp --}}
