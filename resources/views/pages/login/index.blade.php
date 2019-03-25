@extends('layouts.master')
@section('content')
    @if (session()->get('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i aria-hidden="true" class="fas fa-times"></i>
            </button>
            {{ session()->get('message') }}
        </div>
    @endif
<div class="row justify-content-center">
    <h1 class="my-5">Log In</h1>
</div>
    <login-form></login-form>
@endsection
