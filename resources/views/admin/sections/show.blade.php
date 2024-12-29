@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <a href="{{ route('sections.index') }}" class="text-dark content-title mb-0 my-auto">
                    <h4>Sections</h4>
                </a><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Show Section</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header text-primary p-0">Section Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>Section Name:</strong></label>
                        <p id="name">{{ $section->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label"><strong>Description:</strong></label>
                        <p id="description">{{ $section->description }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="created_at" class="form-label"><strong>Created At:</strong></label>
                        <p id="created_at">{{ $section->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
