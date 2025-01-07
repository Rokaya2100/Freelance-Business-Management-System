@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Report</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ One
                    Report</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-12 col-sm-9 col-lg-6 col-xl-12">
            <div class="card card-info">
                <div class="card-header pb-0">
                    <h1 class="card-title mb-3 pb-0" style="color:rgb(0,123,255); font-size:20px"> Report Number :{{ $report->id }}</h1>
                </div>
                <div class="card-body text-dark ml-5" style=" font-size:18px">
                    <div class="mb-3">
                        <i class=" fas fa-cogs"></i>
                        Project Name : {{ $report->project->name }}
                    </div>
                    <div class="mb-3">
                        <i class="fe fe-airplay"></i>
                        Project Description : {{ $report->project->description }}
                    </div>
                    <div class="mb-3">
                        <i class="si si-layers"></i>
                        Section Name : {{ $section->name }}
                    </div>
                    <div class="mb-3">
                        <i class="mdi mdi-account-outline"></i>
                        Client Name : {{ $client->name }}
                    </div>
                    <div class="mb-3">
                        <i class="mdi mdi-account-outline"></i>
                        Freelancer Name : {{ $freelancer->name }}
                    </div>
                    <div class="mb-3">
                        <i class="la la-calendar"></i>
                        Exp Delivery Date : {{ $report->project->exp_delivery_date }}
                    </div>
                    <div class="mb-3">
                        <i class="la la-calendar"></i>
                        Delivery Date : {{ $report->project->delivery_date }}
                    </div>
                    <div class="mb-3 ">
                        <i class="mdi mdi-currency-usd"></i>
                        Price : {{ $report->project->contract->price }}$
                    </div>
                    <div class="mb-3">
                        <i class="mdi mdi-currency-usd"></i>
                        Is Paid : @if ($report->project->contract->is_paid == '1')
                            Yse
                        @else
                            No
                        @endif
                    </div>
                    <div class="mb-3">
                        <i class="mdi mdi-cloud"></i>
                        Contract Status : {{ $report->project->contract->status }}
                    </div>
                    <div class="mb-3">
                        <i class="la la-calendar"></i>
                        Rate : 
                    </div>
                </div>
                <div class="card-footer mt-3">
                    <div style=" font-size:16px">
                        <i class="la la-calendar"></i>
                        Published by client at :
                        {{ $report->created_at }}
                    </div>
                </div>
                <a href="{{ route('reports.oneExcel', $report->id) }}" class="btn btn-secondary btn-with-icon btn-block">
                    <i class="far fa-arrow-alt-circle-down"></i>
                    Export Report</a>
                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-with-icon btn-block"><i class="typcn typcn-delete"></i>
                        Delete</button>
                </form>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
