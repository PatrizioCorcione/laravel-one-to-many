@extends('layouts.admin')
@section('content')
  <div class="container my-3">

    @if (session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif

    @if (session('deleted'))
      <div class="alert alert-primary" role='alert'>
        {{ session('deleted') }}
      </div>
    @endif

    <table class="table">
      <thead>
        <tr>
          <th scope="col"><a href="{{ route('admin.orderby', ['direction' => $direction, 'column' => 'id']) }}">ID</a>
          </th>
          <th scope="col"><a
              href="{{ route('admin.orderby', ['direction' => $direction, 'column' => 'title']) }}">Titolo</a></th>
          <th scope="col">Descrizione</th>
          <th class=" " scope="col"><a
              href="{{ route('admin.orderby', ['direction' => $direction, 'column' => 'type_id']) }}">Tipi</a>
          </th>
          <th class="text-end " scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($project as $item)
          <tr>
            <form action="{{ route('admin.project.update', $item) }}" method="POST" id="form-edit-{{ $item->id }}">
              @csrf
              @method('PUT')

              <td>
                {{ $item->id }}

              </td>
              <td>
                {{ $item->title }}
              </td>
              <td>
                {{ $item->description }}
              </td>
              <td>
                {{ $item->type?->type }}
              </td>
            </form>
            <td class="d-flex flex-row-reverse ">
              <form class="d-inline-block" action="{{ route('admin.project.destroy', $item->id) }}" method="POST"
                onsubmit="return confirm('Sei sicuro di voler eliminare questo progetto ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger  index-btn"><i class="fa-solid fa-circle-xmark"></i></button>
              </form>
              <a href="{{ route('admin.project.edit', $item) }}" class="btn btn-warning index-btn mx-2">
                <i class="fa-solid fa-pen-nib text-black "></i></a>
              </a>
            </td>
          </tr>
        @empty
          <h2>Nessun elemento presente</h2>
        @endforelse
      </tbody>
    </table>
    {{ $project->links('pagination::bootstrap-5') }}
  </div>
@endsection
