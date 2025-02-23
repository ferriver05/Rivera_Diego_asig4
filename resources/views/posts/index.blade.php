@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Posts</h1>

    <div class="my-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Nuevo Post</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($posts->isEmpty())
        <div class="alert alert-warning">
            No hay posts disponibles.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Contenido</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $index => $post)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><b>{{ $post->title }}</b></td>
                            <td>{{ Str::limit($post->content, 50) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este post?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection