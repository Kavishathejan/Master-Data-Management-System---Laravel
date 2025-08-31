@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>View Item: {{ $item->name }}</span>
                    <div>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Code:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $item->code }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Name:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $item->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Brand:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $item->brand->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Category:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $item->category->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Status:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $item->status }}</p>
                        </div>
                    </div>

                    @if($item->attachment)
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Attachment:</label>
                        <div class="col-md-6">
                            <a href="{{ Storage::url($item->attachment) }}" target="_blank" class="btn btn-info btn-sm">
                                View Attachment
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Created At:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $item->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Updated At:</label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $item->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection