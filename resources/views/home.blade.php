@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                    Categorias
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $categorias_count  }}
                    </h1>
                </div>
                <div class="panel-footer text-center">
                    <a href="{{route('categories.index')}}" class="btn btn-primary">Listagem</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading text-center">
                    Postagens
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $posts_count  }}
                    </h1>
                </div>
                <div class="panel-footer text-center">
                    <a href="{{route('posts.index')}}" class="btn btn-primary">Listagem</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
