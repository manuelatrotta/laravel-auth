@extends('layouts.app')
@section('content')
  <form action="{{route('admin.posts.update', $post)}}" method="post">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" value="{{$post->title}}">
      </div>
      <div class="form-group">
        <label for="body">body</label>
        <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>

        <div class="form-group">
          <label for="tags">Tags</label>
          @foreach ($tags as $tag)
          <div>
            <span>{{$tag->name}}</span>
            <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{($post->tags->contains($tag->id)) ? 'checked' : ''}}>
          </div>
          @endforeach
        </div>

        
        <button type="submit" name="button">Salva</button>
      </div>
    </form>
@endsection
