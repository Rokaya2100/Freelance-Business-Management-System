@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <a href="{{ route('sections.index') }}" class="text-dark content-title mb-0 my-auto">
                    <h4>Users</h4>
                </a>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Add New Admin Or Client</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header text-primary p-0">Add New Admin Or Client</h5>
                </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="row mb-2">
                                <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Full Name') }}</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="fullname" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="country" class="col-md-3 col-form-label text-md-end">{{ __('Country') }}</label>
                                <div class="col-md-9">
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" autocomplete="country" autofocus>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="role" class="col-md-3 col-form-label text-md-end">{{ __('role') }}</label>
                                <div class="col-md-9">
                                    <select class="form-control select2-no-search" name="role" required>
                                        <option disabled label="">
                                        </option>
                                        <option value="client">
                                            client
                                        </option>
                                        <option value="admin">
                                            admin
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <div class="col-md-9">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-5 offset-md-3">
                                    <button type="submit" class="btn btn-primary btn-block col-md-12" style="border-radius: 0%">
                                        {{ __('Create Account') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
@endsection
