@extends('layouts.admin')

@php($show = isset($ingredient))

@section('modals')
  @if($show)
    <div class="modal fade" id="destroy" tabindex="-1" role="dialog" aria-labelledby="destroyLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
          <div class="modal-header bg-danger rounded-0 text-light">
            <h5 class="modal-title" id="destroyLabel">
              @lang('Drank verwijderen')
            </h5>

            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-body">
              <p>
                @lang('Weet je zeker dat je deze drank wilt verwijderen? Je kan hem dan niet meer gebruiken in nieuwe cocktails.')
              </p>
              <p class="mb-0">
                @lang( 'Het blijft wel zichtbaar in eerder gemaakte cocktails.' )
              </p>
            </div>

            <div class="modal-footer bg-dark rounded-0">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Annuleer')</button>
                <button type="submit" class="btn btn-danger">@lang('Verwijderen')</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endif
@endsection

@section('page')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-info text-light">
          <div class="card-header">
            @lang($show ? 'Drank bewerken' : 'Drank toevoegen')
          </div>

          <form action="{{ $show ? route('ingredients.update', $ingredient) : route('ingredients.store') }}"
                method="POST">

            @csrf
            @method($show ? 'PATCH' : 'POST')

            <div class="card-body">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <label for="name" class="input-group-text">
                      <i class="fas fa-key"></i>
                    </label>
                  </div>

                  <input
                    class="form-control @error('name') is-invalid rounded-right @enderror"
                    id="name"
                    name="name"
                    value="{{ $show ? $ingredient->name : old('name') }}"
                    type="text"
                    placeholder="@lang('Naam')"/>

                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>
                      {{ $message }}
                    </strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <label for="volume" class="input-group-text">
                      <i class="fas fa-wine-bottle"></i>
                    </label>
                  </div>

                  <input
                    class="form-control @error('volume') is-invalid @enderror"
                    id="volume"
                    name="volume"
                    value="{{ $show ? $ingredient->volume : old('volume') }}"
                    type="number"
                    step="0.01"
                    placeholder="@lang('Inhoud')"/>

                  <div class="input-group-append">
                    <span class="input-group-text @error('volume') rounded-right @enderror">
                      @lang('liter')
                    </span>
                  </div>

                  @error('volume')
                  <span class="invalid-feedback" role="alert">
										<strong>
                      {{ $message }}
                    </strong>
									</span>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <label for="percentage" class="input-group-text">
                      <i class="fas fa-percentage"></i>
                    </label>
                  </div>

                  <input class="form-control @error('percentage') is-invalid rounded-right @enderror"
                         id="percentage"
                         name="percentage"
                         value="{{ $show ? $ingredient->percentage : old('percentage') }}"
                         type="number"
                         placeholder="@lang('Percentage')"/>

                  @error('percentage')
                  <span class="invalid-feedback" role="alert">
										<strong>
                      {{ $message }}
                    </strong>
									</span>
                  @enderror
                </div>
              </div>

              <div class="form-group mb-0">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <label for="pump" class="input-group-text">
                      <i class="fas fa-gas-pump"></i>
                    </label>
                  </div>

                  <select
                    class="custom-select @error('pump') is-invalid rounded-right @enderror"
                    id="pump"
                    name="pump">
                    <option
                      disabled
                      @if($show ? !$ingredient->pump_id : !old('pump')) selected @endif>
                      @lang('Pomp')
                    </option>

                    @foreach($pumps as $pump)
                      <option
                        @if(($show ? $ingredient->pump_id : old('pump')) === $pump->id) selected @endif
                      value="{{ $pump->id }}">
                        {{ $pump->id }} - {{ $pump->type }} - {{ $pump->pin }}
                      </option>
                    @endforeach
                  </select>

                  @error('pump')
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
              @if($show)
                <div class="btn-group">
                  @endif
                  <button
                    class="btn btn-primary"
                    type="submit">
                    @if($show)
                      @lang('Opslaan')
                    @else
                      <i class="fas fa-plus"></i> @lang('Toevoegen')
                    @endif
                  </button>

                  @if($show)
                    <button
                      class="btn btn-danger"
                      type="button"
                      data-toggle="modal"
                      data-target="#destroy">
                      @lang('Verwijderen')
                    </button>
                </div>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
