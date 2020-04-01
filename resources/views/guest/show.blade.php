@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>{{$post->title}}</h2>
          <small>Scritto da: {{$post->user->name}}</small>
          <div>
            {{$post->body}}
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-12">
          <h2>Commenti</h2>
          @forelse ($post->comments as $comment)
              <h3>{{$comment->title}}</h3>
              <small>{{$comment->name}}</small>
              <div>
                {{$comment->body}}
              </div>
          @empty
              <p>No Comments</p>
          @endforelse
        </div>

      </div>

      <div class="row">
        <div class="col-12">
          <form action="{{route('comments.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="title">Title</label>
              <input class="form-control" type="text" name="title">
            </div>
            <div class="form-group">
              <label for="body">Comment</label>
              <textarea class="form-control"  name="body" id="body" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="name">Your Name</label>
              <input class="form-control"  type="text" name="name">
            </div>
            <div class="form-group">
              <label for="email">Your mail</label>
              <input class="form-control"  type="text" name="email">
            </div>
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <button class="btn btn-primary" type="submit">Invia</button>
          </form>
        </div>
      </div>
    </div>
@endsection
