@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD de Tareas</h2>
        </div>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>

    @if (Session::get('success'))
     <div class="alert alert-success mt-2">
          <strong>{{ Session::get('success') }}</strong> <br>
     </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>

            @if ($tasks->count() < 1)
                 <tr>
                    <td colspan="5" class="fw-bold text-center">No hay registros</td>
                 </tr>
            @endif

            @foreach ($tasks as $task)

                 
            <tr>
                <td class="fw-bold">{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    {{ $task->due_time }}
                </td>
                <td>
                    <span class="badge bg-warning fs-6">{{ $task->status }}</span>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Editar</a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="post" class="d-inline eliminar">

                         @csrf
                         @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>

            @endforeach

        </table>

        {{ $tasks->links() }}

    </div>
</div>
@endsection

@section('scripts')
     <script>
          $('.eliminar').submit(function(e){
               e.preventDefault();

               Swal.fire({
                    title: 'Estas seguro?',
                    text: "No se recuperaran los datos!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar'
               }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
               })
          });
     </script>
@endsection