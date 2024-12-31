@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <a href="{{ route('contracts.index') }}" class="text-dark content-title mb-0 my-auto">
                    <h4>Contracts</h4>
                </a><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Show contract</span>
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
                    <h5 class="card-header text-primary p-0">Contract Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Project Name -->
                        <div class="col-md-6 mb-3">
                            <strong>Project Name:</strong> <span>{{ $contract->project->name }}</span>
                        </div>
                        <!-- Client Name -->
                        <div class="col-md-6 mb-3">
                            <strong>Client Name:</strong> <span>{{ $contract->client->name }}</span>
                        </div>
                        <!-- Freelancer Name -->
                        <div class="col-md-6 mb-3">
                            <strong>Freelancer Name:</strong> <span>{{ $contract->freelancer->name }}</span>
                        </div>
                        <!-- Price -->
                        <div class="col-md-6 mb-3">
                            <strong>Price:</strong> <span>${{ number_format($contract->price, 2) }}</span>
                        </div>
                        <!-- Contract Status -->
                        <div class="col-md-6 mb-3">
                            <strong>Contract Status:</strong> <span>{{ ucfirst($contract->status) }}</span>
                        </div>
                        <!-- Is Paid -->
                        <div class="col-md-6 mb-3">
                            <strong>Is Paid:</strong>
                            <span>{{ $contract->is_paid ? 'Yes' : 'No' }}</span>
                        </div>
                        <!-- Created At -->
                        <div class="col-md-6 mb-3">
                            <strong>Created At:</strong>
                            <span>{{ $contract->created_at->format('d/m/Y') }}</span>
                        </div>
                        <!-- Project Description -->
                        {{-- <div class="col-md-6 mb-3">
                            <strong>Project Description:</strong>
                            <span>{{ $contract->project->description }}</span>
                        </div> --}}
                        <!-- Expected Delivery Date -->
                        <div class="col-md-6 mb-3">
                            <strong>Expected Delivery Date:</strong>
                            <span>{{ $contract->project->exp_delivery_date->format('d/m/Y') }}</span>
                        </div>
                        <!-- Delivery Date -->
                        <div class="col-md-6 mb-3">
                            <strong>Delivery Date:</strong>
                            <span>
                                {{ $contract->project->delivery_date
                                    ? $contract->project->delivery_date->format('d/m/Y')
                                    : 'Not Delivered Yet' }}
                            </span>
                        </div>
                        <!-- Section Name -->
                        <div class="col-md-6 mb-3">
                            <strong>Section Name:</strong>
                            <span>{{ $contract->project->section->name }}</span>
                        </div>
                    </div>
                    <!-- Back Button -->
                    <div class="mt-3">
                        <a href="{{ route('projects.show', ['project' => $contract->project_id]) }}" class="btn btn-primary">Go to the Project</a>
                        <a href="{{ route('reports.show', ['id' => $contract->project->report->id]) }}" class="btn btn-secondary">Go to Project Report</a>

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
