@extends('layouts.frontend')

@section('content')
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4">Posts list on the <strong>{{$category->name}}</strong></h1>

            @forelse($posts as $post)
                <!-- Blog Post -->
                <div class="card mb-4">
                    @if($post->image)
                    <img class="card-img-top" src="{{$post->image_url}}" alt="Card image cap">
                    @else
                    <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{$post->title}}</h2>
                        <p class="card-text">{!! $post->body !!}</p>
                        <a href="{{route('post.single', ['id' => $post->id])}}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                        @include('partials.footer-post')
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