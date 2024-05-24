@extends('layouts.admin')

@section('content')
  <div class="container form my-3 ">
    <form action={{ $route }} method="POST" class=" g-3">
      @csrf
      @method($method)

      <div class="mb-3">
        <label class="form-label"></label>
        <input value="{{ old('title', $project?->title) }}" name="title" placeholder="Titolo" type="text"
          class="form-control @error('title')
          is-invalid
          @enderror">
        @error('title')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-floating mb-3">
        <textarea value="" name="description"
          class="form-control @error('description')
        is-invalid
        @enderror" placeholder="Leave a comment here"
          id="floatingTextarea2Disabled">{{ old('description', $project?->description) }}</textarea>
        <label for="floatingTextarea2Disabled">Descrizione</label>
        @error('description')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <select name="type_id" class="form-select" aria-label="Default select example">
        @foreach ($types as $item)
          <option @if (old('type_id', $item->project?->id) == $item->id) selected @endif value="{{ $item->id }}">
            {{ $item->type }}
          </option>
        @endforeach

      </select>

      <button type="submit" class="btn btn-primary my-3">Invia</button>

    </form>
  </div>
@endsection
