@extends('layouts.admin')

@section('content')
  <div class="container form my-3 ">
    <form action={{ $route }} method="POST" class=" g-3" enctype="multipart/form-data">
      @csrf
      @method($method)

      <div class="mb-3">
        @if ($method == 'PUT')
          <label for="exampleInputEmail1" class="form-label">Titolo</label>
        @endif
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
          class="form-control t-area-he @error('description')
        is-invalid
        @enderror"
          placeholder="Leave a comment here" id="floatingTextarea2Disabled">{{ old('description', $project?->description) }}</textarea>
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
      <div class="mb-3">
        @if ($method == 'PUT')
          <label for="exampleInputEmail1" class="form-label mt-3">Github link</label>
        @endif

        <input value="{{ old('github', $project?->github) }}" name="github" placeholder="Github link" type="text"
          class="form-control mt-3 @error('github')
          is-invalid
          @enderror">
        @error('github')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="mb-3">
        @if ($method == 'PUT')
          <label for="exampleInputEmail1" class="form-label">Immagine</label>
        @endif
        <div class="input-group">
          <input name="thumb" type="file" class="form-control @error('thumb') is-invalid @enderror"
            id="inputGroupFile02">
        </div>
        @error('thumb')
          <small class="text-danger d-block mt-1">{{ $message }}</small>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary my-3">Invia</button>
    </form>
  </div>
@endsection
