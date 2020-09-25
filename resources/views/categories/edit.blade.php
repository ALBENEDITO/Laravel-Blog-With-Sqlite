@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Editar categoria: {{$category->name}}
                <a href="{{route('categories.index')}}" class="btn btn-warning">Voltar</a>
            </div>

            <div class="panel-body">

                @include('partials.errors')

                <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" class="form-control" value="{{$category->name}}">
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit"> Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection