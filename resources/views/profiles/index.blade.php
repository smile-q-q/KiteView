@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileimage() }}" class="rounded-circle img-fluid" alt="Profile Picture">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4 pt-2">{{ $user->username }}</div>
                    
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                <!-- secure -->
                @can('update' , $user->profile)
                <a href="/p/create" class="btn btn-primary">Add New Post</a>
                @endcan
            </div>
            <!-- secure -->
            @can('update' , $user->profile)
                <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-danger mb-2">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pe-5"><strong>{{ $postCount }}</strong> Posts</div>
                <div class="pe-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pe-5"><strong>{{ $followingCount }}</strong> Following</div>
            </div>
            <div class="fw-bold pt-4">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#" class="text-decoration-none text-danger">{{ $user->profile->url}}</a></div>
        </div>
    </div>
<!-- posts -->
    <div class="row p-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{ $post->id }}">
            <img src="/storage/{{$post->image }}" class="w-100 h-100" alt="">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
