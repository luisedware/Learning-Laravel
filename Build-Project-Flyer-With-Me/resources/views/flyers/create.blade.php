@extends('layout')
@section('content')
<h1>Selling Your Home?</h1>
<hr>
<form method="post" action="{{route('flyers.store')}}">
@include('flyers.form')
</form>
@stop
