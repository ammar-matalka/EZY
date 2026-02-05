@extends('admin.layouts.app')

@section('content')
<h2>Add New Certification</h2>

<form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
    @csrf

    <div class="form-group mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
