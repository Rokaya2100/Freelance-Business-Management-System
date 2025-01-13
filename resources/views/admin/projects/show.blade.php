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
                <a href="{{ route('projects.index') }}" class="text-dark content-title mb-0 my-auto">
                    <h4>Projects</h4>
                </a><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Prrojects Show</span>
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
                    <h2 class="pb-0" style="color:rgb(0,123,255); font-size:20px"><strong>Project Name : </strong>
                        {{ $project->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row" style="font-size: 16px">
                        <div class="col-md-6 mb-3 fe fe-airplay">
                            <strong>Description:</strong> <span>{{ $project->description }}</span>
                        </div>
                        <div class="col-md-6 mb-3 si si-layers">
                            <strong>Section Name:</strong> <span>{{ $project->section->name }}</span>
                        </div>
                        <div class="col-md-6 mb-3 mdi mdi-account-outline">
                            <span><strong> Client Name: </strong>
                                @if ($project->client)
                                    {{ $project->client->name }}
                                @else
                                    Unknown
                                @endif
                            </span>
                        </div>
                        <div class="col-md-6 mb-3 mdi mdi-account-outline">
                            <span><strong> Freelancer Name: </strong>
                                @if ($project->freelancer)
                                    {{ $project->freelancer->name }}
                                @else
                                    There is no Freelancer
                                @endif
                            </span>
                        </div>
                        <div class="col-md-6 mb-3 mdi mdi-calendar-clock">
                            <strong>Add Date:</strong>
                            <span>{{ $project->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="col-md-6 mb-3 mdi mdi-cloud">
                            <strong>Project Status:</strong>
                            <span>{{ $project->status }}</span>
                        </div>
                        <div class="col-md-6 mb-3 mdi mdi-calendar-clock">
                            <strong>Expected Delivery Date:</strong>
                            <span>{{ $project->exp_delivery_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="col-md-6 mb-3 mdi mdi-calendar-clock">
                            <strong>Delivery Date:</strong>
                            <span>
                                {{ $project->delivery_date ? $project->delivery_date->format('d/m/Y') : 'Not Delivered Yet' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            {{--
    <div class="project-title"> {{ $project->name }}</div>
    <div class="project-details">
        <div class="col-md-6 mb-3 mdi mdi-account-outline">
            <strong>Description : </strong> <span>{{ $project->description}}</span>
        </div>
        <div class="col-md-6 mb-3 fas fa-clipboard" >
            <strong>Section Name:</strong>
            <span>{{ $project->section->name }}</span>
        </div>
        <div class="col-md-6 mb-3 mdi mdi-account-outline">
            <strong>Client Name:</strong> <span>{{ $project->client->name }}</span>
        </div>
        <div class="project-status mdi mdi-cloud "> Status : {{ $project->status }}</div>
        <div class="project-section fas fa-file"> Section : {{ $project->section->name }}</div>
        <div class="client-info">
    <span class="mdi mdi-account-outline"> Client Name: {{ $project->client->name }}</span>
    <br><br>
            <span class="mdi mdi-account-circle"> Freelancer Name:
                @if ($project->freelancer)
                    {{ $project->freelancer->name }}
                @else
                    There is no Freelancer
                @endif
            </span>
                @if ($project->customer_attachments)
                <div class="project-customer_attachments"> customer attachments :{{$project->customer_attachments}} <br><br>
                @endif
            </div>
            </div>
            <div>
                <div class="project-exp_delivery_date mdi mdi-calendar-clock "> Expected Delivery Date:{{ $project->exp_delivery_date}} .</div><br>

                @if ($project->delivery_date)
                <div class="project-delivery_date mdi mdi-calendar-clock"> Delivery date: <br>
                {{ $project->delivery_date}}
            </div>
            @elseif($project->status !== 'pending' && !$project->delivery_date)
            <div class="project-delivery_date mdi mdi-calendar-clock"> Delivery date: <br>
            The project is under preparation and has not yet been delivered .</div>
            @elseif($project->status == 'pending')
            <div class="project-delivery_date mdi mdi-calendar-clock"> Delivery date: The project is Pending .</div>
            @endif
            @if ($project->independent_attachments)
            <div class="project-independent_attachments"> independent attachments : {{$project->independent_attachments}} <br><br>
            @endif
                            <br><br>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary ">Back</a>
                        <div class="project-date">Add Date : {{ $project->created_at->format('d/m/Y') }} .</div>
                        </div><div></div></div> --}}
            @if ($project->offers->isEmpty())
                The Offers :
                <p>There are no offers available for this project.</p>
            @else
                <h5 style="padding-left: 10px;"> The Offers :</h5>
                @foreach ($project->offers as $offer)
                    <li  class="offer-item {{ $offer->status == 'accepted' ? 'accepted' : '' }}  "style="display: flex; flex-direction: column;">
                            <h4><strong class="mdi mdi-account-outline" style="font-size: 20px;"></strong>{{ $offer->users?->name }}</h4>
                            <div class="row" style="font-size: 16px; padding:7px;">
                            <div class="col-md-5">
                                <strong class="fe fe-airplay"> Description:</strong>
                                <span>{{ $offer->description }}</span>
                            </div>
                            <div class="col-md-4">
                                <strong class="mdi mdi-calendar-clock"> Project work period:</strong>
                                <span> {{ $offer->period }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong class="mdi mdi-currency-usd"> Price:</strong>
                                <span> {{ $offer->price }} $</span>
                            </div>
                        </div>
                        <h3 class="mdi mdi-cloud" style="font-size: 17px; padding-left:8px; font-weight: bold;"> Status:
                            <span> {{ $offer->status }}</span></h3>
                        <div style="display: flex; justify-content: flex-end;">
                            @if ($offer->status == 'accepted')
                                <a href="{{ route('contracts.show', $project->contract->id) }}"
                                    class="view-contract-button"> View contract </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            @endif

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.offer-item').click(function() {
                        $(this).toggleClass('highlight');
                    });
                });
            </script>
            <style>
                .view-contract-button {
                    background-color: #4CAF50;
                    /* لون الخلفية */
                    color: white;
                    /* لون النص */
                    padding: 8px 16px;
                    /* حشوة الزر (تم تصغيرها) */
                    border: none;
                    /* إزالة الحدود */
                    border-radius: 5px;
                    /* زوايا دائرية */
                    cursor: pointer;
                    /* تغيير شكل المؤشر عند المرور فوق الزر */
                    transition: background-color 0.3s ease, transform 0.2s ease;
                    /* تأثير الانتقال عند تغيير اللون والحجم */
                    display: inline-block;
                    /* جعل الزر كعنصر كتلي */

                }

                .view-contract-button:hover {
                    background-color: #45a049;
                    /* تغيير اللون عند المرور فوق الزر */
                    transform: scale(1.05);
                    /* تكبير الزر قليلاً عند المرور عليه */
                }


                .offer-item {
                    border: 1px solid #ccc;
                    /* يمكنك تعديل الحدود حسب الحاجة */
                    padding: 15px;
                    /* تقليل الحواف */
                    border-radius: 8px;
                    /* لجعل الزوايا دائرية */
                }

                .offer-item {
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    padding: 15px;
                    margin-bottom: 10px;
                    background-color: #fff6f6c2;
                }


                .offer-item.accepted {
                    border-color: #28a745;
                    /* لون أخضر لحالة العرض المقبول */
                    background-color: #d4edda;
                    /* خلفية خضراء فاتحة */
                }
                /* .project-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 20px;
            background-color: #f9f9f9;
        }
        .project-title {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 10px;
            color: rgb(0,123,255);
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
        } */
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
