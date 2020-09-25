@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Criar postagem
                <a href="{{route('posts.index')}}" class="btn btn-warning">Voltar</a>
            </div>

            <div class="panel-body">

                @include('partials.errors')

                <form action="{{ route('posts.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title">Categoria</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Corpo da postagem</label>
                        <textarea name="body" class="form-control"></textarea>
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