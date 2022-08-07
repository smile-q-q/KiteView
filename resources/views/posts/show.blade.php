@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100" alt="">
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
                <div class="pe-3">
                    <img src="{{ $post->user->profile->profileImage() }}" class="w-100 rounded-circle" style="max-width: 40px;" alt="">
                </div>
                <div>
                    <div class="fw-bold">
                        <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <hr>
            <p> <span class="fw-bold">
                    <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                </span> {{ $post->caption }}
            </p>
        </div>
    </div>
</div>
@endsection
