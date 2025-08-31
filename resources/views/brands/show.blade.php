@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>View Brand: {{ $brand->name }}</span>
                    <div>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('brands.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Code:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $brand->code }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Name:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $brand->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Status:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $brand->status }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Created At:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $brand->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Updated At:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $brand->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection