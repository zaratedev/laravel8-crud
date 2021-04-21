@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
<div class="container-fluid">
    <div class="mb-2 row">
        <div class="col-sm-6">
            <h1>Company Details</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
                <li class="breadcrumb-item active">Company Details</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card card-solid">
    <div class="pb-0 card-body">
        <div class="col-12">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>{{ $company->present()->name }}</b></h2>
                            <ul class="mb-0 ml-4 fa-ul text-muted">
                                <li class="text-md">
                                    <span class="fa-li"><i class="fas fa-envelope"></i></span>
                                    Email: {{ $company->present()->email }}
                                </li>
                                <li class="text-md">
                                    <span class="fa-li"><i class="fas fa-globe-asia"></i></span>
                                    Website: {{ $company->present()->website }}
                                </li>
                            </ul>
                        </div>
                        <div class="text-center col-5">
                            <img src="{{ $company->present()->logo }}" alt="{{ $company->name }}" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
