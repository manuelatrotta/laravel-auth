@extends('layouts.app')
@section('content')
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
          <td><a class="btn btn-primary" href="{{route('admin.posts.show', $post->slug)}}">View</a> </td>
          <td><a class="btn btn-primary" href="{{route('admin.posts.edit', $post->slug)}}">Edit</a> </td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection
