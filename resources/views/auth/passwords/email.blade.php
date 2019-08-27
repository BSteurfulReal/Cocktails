@extends('layouts.center_card')

@section('card')
  <div class="card-header">
    @lang('Reset Password')
  </div>

  <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="card-body">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

      <div class="form-group row mb-0">
        <label for="email" class="col-md-4 col-form-label text-md-right">
          @lang('E-Mail Address')
        </label>

        <div class="col-md-6">
          <input
            id="email"
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            name="email"
            value="{{ old('email') }}"
            required
            autocomplete="email"
            autofocus>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>
              {{ $message }}
            </strong>
          </span>
          @enderror
        </div>
      </div>
    </div>

    <div class="card-footer">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
          @lang('Send Password Reset Link')
        </button>
      </div>
    </div>
  </form>
@endsection
