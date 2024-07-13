@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Image Gallery</h1>
        <a href="{{ route('images.create') }}" class="btn btn-primary">Upload Image</a>
        <div class="row mt-4">
            @foreach($images as $image)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ url('').Storage::url($image->url) }}" class="card-img-top" alt="{{ $image->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $image->title }}</h5>
                            <p class="card-text">{{ $image->tag }}</p>
                            <a href="{{ route('images.edit', $image->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
