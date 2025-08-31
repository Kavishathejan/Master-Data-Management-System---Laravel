@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>View Category: {{ $category->name }}</span>
                    <div>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Code:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $category->code }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Name:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $category->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Status:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $category->status }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Created At:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $category->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Updated At:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection