@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1>Company Edit</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
                <li class="breadcrumb-item active">Company Edit</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General</h3>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"" value="{{ old('name', $company->name) }}">
                        @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Company Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"" value="{{ old('email', $company->email) }}">
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="website">Company Website</label>
                        <input type="url" id="website" name="website" class="form-control @error('website') is-invalid @enderror"" value="{{ old('website', $company->website) }}">
                        @error('website')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <div class="mb-4 d-flex justify-content-center align-items-center">
                            <img src="{{ $company->present()->logo }}" class="w-full" alt="{{ $company->name }}">
                        </div>
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
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="pb-4 row">
        <div class="col-12">
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Save Changes" class="float-right btn btn-success">
        </div>
    </div>
</form>
@stop
