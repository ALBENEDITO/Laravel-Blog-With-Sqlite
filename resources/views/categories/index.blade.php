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
                <a href="{{route('categories.create')}}" class="btn btn-primary">Adicionar</a>
                <hr>
                <table class="table table-hover">
                    <thead>
                    <th>Categoria</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                    </thead>
                    <tbody>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-xs btn-info">
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action="{{route('categories.destroy', $category->id)}}" onsubmit="return confirm('Deseja realmente deletar')">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td>Nenhuma categoria cadastrada</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection