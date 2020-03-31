@extends('layouts.app')
@section('content')
  <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Create a new post</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">user_id</th>
        <th scope="col">title</th>
        <th scope="col">body</th>
        <th scope="col">slug</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($posts as $post)
        <tr>
          <th scope="row">{{$post->id}}</th>
          <td>{{$post->title}}</td>
          <td>{{$post->body}}</td>
          <td>{{$post->slug}}</td>
          <td><a href="{{route('admin.posts.show', $post)}}">Show</a></td>
          <td><a href="{{route('admin.posts.edit', $post)}}">Edit</a></td>
          <td>
          <form action="{{route('admin.posts.destroy', $post)}}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection
