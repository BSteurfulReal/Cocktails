@extends('layouts.admin')

@section('page')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-info">
          <div class="card-header bg-primary text-light">
            @lang('Dranken')
          </div>

          <table class="card-body table table-dark table-striped table-hover mb-0">
            <thead>
            <tr>
              <th scope="col">Drank</th>
              <th scope="col">Pomp</th>
            </tr>
            </thead>

            <tbody>
            @foreach($ingredients as $ingredient)
              <tr onclick="window.location = '{{ route('ingredients.show', $ingredient) }}'">
                <th scope="row">{{ $ingredient->name }}</th>
                <td>{{ $ingredient->pump->type }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <div class="card-footer">
            <a class="btn btn-primary float-right" href="{{ route ( 'ingredients.create' ) }}">
              <i class="fas fa-plus"></i> @lang('Toevoegen')
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
