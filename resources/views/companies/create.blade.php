@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1>Company Create</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
                <li class="breadcrumb-item active">Company Create</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create Company</h3>
    </div>
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter company name">
                @error('name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter company email">
                @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="website" placeholder="Enter company website">
                @error('website')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <div class="input-group @error('logo') is-invalid @enderror">
                    <div class="custom-file">
                        <input type="file" id="logo" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="logo">
                        <label class="custom-file-label" for="logo">Choose logo</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
                @error('logo')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop
