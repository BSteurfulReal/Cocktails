@extends('layouts.base')

@section('content')
  <div class="container vh-100">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-md-8">
        <div class="card">
          @yield('card')
        </div>
      </div>
    </div>
  </div>
@endsection
