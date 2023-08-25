@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Task Id</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{route('tasks.edit', ['id' => $task->id])}}"><i class="fas fa-edit"></i></a>
                        <a  href="{{route('tasks.destroy', ['id' => $task->id])}}"><i class="fas fa-trash" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $task->id }}').submit();"></i></a>
                        <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
  </tbody>
</table>
        </div>

</div>

@endsection