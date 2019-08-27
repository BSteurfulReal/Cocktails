@extends('layouts.base')

@section('content')
  <nav class="navbar navbar-expand-md navbar-dark bg-success shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('admin') }}">
        {{ config('app.name') }}
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="@lang('Toggle navigation')">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cocktails.index') }}">
              @lang('Cocktails')
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('ingredients.index') }}">
              @lang('Dranken')
            </a>
          </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">
                @lang('Login')
              </a>
            </li>
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown"
                 class="nav-link dropdown-toggle"
                 href="#"
                 role="button"
                 data-toggle="dropdown"
                 aria-haspopup="true"
                 aria-expanded="false"
                 v-pre>
                {{ Auth::user ()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  @lang('Logout')
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible rounded-0 border-left-0 border-right-0 mb-0">
      <div class="container">
        {{ session()->get('success') }}
      </div>

      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="py-4">
    @include('partials.page')
  </div>
@endsection
