<div class="card-footer text-muted">
    Category <a href="{{route('posts.category', ["category_id" => $post->category_id])}}">{{$post->category->name}}</a> <br>
    Posted on {{$post->created_at->diffForHumans()}} by
    <a href="{{route('posts.author', ["user_id" => $post->user_id])}}">{{$post->user->name}}</a>
</div>