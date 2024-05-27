@extends('layouts.admin')
@section('content')
  <div class="container my-3">
    <div class="p-2">
      <div class="d-flex justify-content-center">
        <img class="w-75" src="{{ asset('storage/' . $project->thumb) }}" alt="">
      </div>
      <div class="my-3">
        <span>{{ $project->description }}</span>
      </div>
    </div>
  </div>
@endsection
