@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="row">
      <p>{{ $project->description }}</p>
    </div>
  </div>
@endsection
