@extends('layouts.app')

@section('content')
    <display-appointment :appointment="{{ $appointment }}"></display-appointment>
@endsection