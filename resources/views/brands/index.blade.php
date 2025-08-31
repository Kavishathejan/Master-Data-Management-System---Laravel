@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Brands') }}</span>
                    <a href="{{ route('brands.create') }}" class="btn btn-primary">Create New Brand</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->code }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->status }}</td>
                                    <td>
                                        <a href="{{ route('brands.show', $brand->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form id="delete-brand-{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="confirmDelete('delete-brand-{{ $brand->id }}', '{{ $brand->name }}', 'Brand')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection