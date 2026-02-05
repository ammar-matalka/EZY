@extends('admin.layouts.app')

@section('content')
<h2>Certifications</h2>

<a href="{{ route('admin.certifications.create') }}" class="btn btn-primary">Add New</a>

@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

<div class="row mt-4">
    @foreach($certifications as $cert)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $cert->image) }}" class="card-img-top" alt="{{ $cert->title }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $cert->title }}</h5>
                    <form method="POST" action="{{ route('admin.certifications.destroy', $cert->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
