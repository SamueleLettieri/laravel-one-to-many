@extends('layouts.app')

@section('title', 'post: ' . $post->title)

@section('content')

<div class="container mt-5">
    <div class="card text-center">
        <div class="card-header">
            post
        </div>
        <div class="text-center">
            <img src="{{$post->post_image}}" class="card-img-top w-50 rounded-0 m-3" alt="{{$post->title}}img">
        </div>    
        <div class="card-body">
            <h5 class="card-title m-3">{{$post->user->name}}</h5>
            <h3 class="card-title m-3">{{$post->title}}</h3>
            <p class="card-text m-3">{{$post->post_content}}</p>
            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn px-3 mx-2  btn-sm btn-primary">Edit</a>
            <form action="" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn px-3 mx-2  btn-sm btn-danger">Delete</button>
                </form>
        </div>
        <div class="card-footer text-muted ">
            {{$post->post_date}}
        </div>
    </div>
</div>


@endsection