@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('danger'))
            <div class="alert alert-danger">
                {{Session::get('danger')}}
            </div>
        @endif
        @if(Session::has('info'))
            <div class="alert alert-info">
                {{Session::get('info')}}
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{route('posts.create')}}" class="btn btn-primary">Adicionar</a>
                <hr>
                <table class="table table-hover">
                    <thead>
                    <th>Usuário</th>
                    <th>Categoria</th>
                    <th>Título</th>
                    <th>Criado em</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                    </thead>
                    <tbody>
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-xs btn-info">
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action="{{route('posts.destroy', $post->id)}}" onsubmit="return confirm('Deseja realmente deletar')">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td>Nenhuma postagem cadastrada</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection