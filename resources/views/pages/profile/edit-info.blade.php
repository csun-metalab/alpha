@extends('layouts.master')

@section('content')
    <user-profile user-info="{{ session()->get('user') }}"/>
@endsection
