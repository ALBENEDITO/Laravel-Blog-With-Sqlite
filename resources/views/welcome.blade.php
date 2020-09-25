@extends('layouts.frontend')

@section('content')
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4">Posts list</h1>

            @forelse($posts as $post)
                <!-- Blog Post -->
                <div class="card mb-4">
                    <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{{$post->title}}</h2>
                        <p class="card-text">{!! $post->body !!}</p>
                        <a href="#" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Category <a href="#">{{$post->category->name}}</a> <br>
                        Posted on {{$post->created_at->diffForHumans()}} by
                        <a href="#">{{$post->user->name}}</a>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">
                    Não há nenhuma postagem até o momento
                </div>
            @endforelse

        </div>

        <!-- Sidebar Widgets Column -->
        @include('partials.sidebar')

    </div>
    <!-- /.row -->
@endsection