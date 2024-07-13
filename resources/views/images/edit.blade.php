@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Image</h1>
        <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $image->title }}" required>
            </div>
            <div class="form-group">
                <label for="tag">Tag</label>
                <input type="text" name="tag" class="form-control" value="{{ $image->tag }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
