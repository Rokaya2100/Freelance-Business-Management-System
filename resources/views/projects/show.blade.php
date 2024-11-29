@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Projects</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Prrojects Show</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

<div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Projects TABLE</h4>

                    </div>
                    <div class="project-container">
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

    <div class="project-title"> {{ $project->name }}</div>
    <div class="project-details">
        <div class="project-status">Status : {{ $project->status }}</div>
        <div class="project-section">Section : {{ $project->section->name }}</div>
        <div class="client-info">
            Client Name :{{$project->client->name}}
            <br><br>
            Freelancer Name :
            @if($project->freelancer)
            {{ $project->freelancer->name   }}
            @else
            There is no Freelancer
        @endif



                @if($project->customer_attachments)
                <div class="project-customer_attachments"> customer attachments :{{$project->customer_attachments}} <br><br>
                @endif
            </div>
            </div>
            <div>
                @if($project->independent_attachments)
                <div class="project-independent_attachments"> independent attachments : {{$project->independent_attachments}} <br><br>
                @endif




        <div class="project-description">Description : <br>
        {{$project->description }}
    </div>


                    <div class="project-exp_delivery_date">Expected Delivery Date: <br>
                        {{ $project->exp_delivery_date}}
                    </div>
                    <br>
                        @if($project->delivery_date)
                        <div class="project-delivery_date">Delivery date: <br>
                        {{ $project->delivery_date}}
                        </div>
                        @elseif($project->status !== 'pending' && !$project->delivery_date)
                        <div class="project-delivery_date">Delivery date: <br>
                        The project is under preparation and has not yet been delivered</div>
                        @elseif($project->status == 'pending')
                        <div class="project-delivery_date">Delivery date: The project is Pending</div>
                        @endif
                            <br>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        <div class="project-date">Add Date : {{ $project->created_at->format('d/m/Y') }}</div>
                        </div><div></div></div>
    <style>
    .project-container {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        margin: 20px;
        background-color: #f9f9f9;
    }
    .project-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .project-details {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .project-status {
        text-align: left;
    }
    .client-info {
        text-align: right;
    }
    .project-description {
        margin-top: 10px;
        font-size: 16px;
        margin-bottom: 10px;
    }
    .project-date {
        text-align: right;
        font-size: 14px;
        color: gray;
    }
</style>

@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
