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
        <div class="project-status mdi mdi-cloud "> Status : {{ $project->status }}</div>
        <div class="project-section fas fa-file"> Section : {{ $project->section->name }}</div>
        <div class="client-info">
    <span class="mdi mdi-account-outline"> Client Name: {{ $project->client->name }}</span>
    <br><br>
            <span class="mdi mdi-account-circle"> Freelancer Name:
                @if($project->freelancer)
                    {{ $project->freelancer->name }}
                @else
                    There is no Freelancer
                @endif
            </span>
                @if($project->customer_attachments)
                <div class="project-customer_attachments"> customer attachments :{{$project->customer_attachments}} <br><br>
                @endif
            </div>
            </div>
            <div>
                <div class="project-description mdi mdi-comment-text"> Description :{{$project->description }} .</div><br>
                <div class="project-exp_delivery_date mdi mdi-calendar-clock "> Expected Delivery Date:{{ $project->exp_delivery_date}} .</div><br>

                @if($project->delivery_date)
                <div class="project-delivery_date mdi mdi-calendar-clock"> Delivery date: <br>
                {{ $project->delivery_date}}
            </div>
            @elseif($project->status !== 'pending' && !$project->delivery_date)
            <div class="project-delivery_date mdi mdi-calendar-clock"> Delivery date: <br>
            The project is under preparation and has not yet been delivered .</div>
            @elseif($project->status == 'pending')
            <div class="project-delivery_date mdi mdi-calendar-clock"> Delivery date: The project is Pending .</div>
            @endif
            @if($project->independent_attachments)
            <div class="project-independent_attachments"> independent attachments : {{$project->independent_attachments}} <br><br>
            @endif
                            <br><br>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary ">Back</a>
                        <div class="project-date">Add Date : {{ $project->created_at->format('d/m/Y') }} .</div>
                        </div><div></div></div>
                        @if($project->offers->isEmpty())
                        The Offers :
                        <p>There are no offers available for this project.</p>
                        @else
                        @foreach($project->offers as $offer)
                            <li class="offer-item {{ $offer->status == 'accepted' ? 'accepted' : '' }}  "style="display: flex; flex-direction: column;">
                                <div class="offer-details">

                                    <h5 class="mdi mdi-account-outline">  {{ $offer->user->name }}</h5>
                                    <p>

                                    </p>
                                    <p><strong class="mdi mdi-comment-text"> {{ $offer->description }} </strong></p>
                                    <p class="mdi mdi-cloud"> Status: {{ $offer->status }} .</p>

                                    <p><strong class="mdi mdi-calendar-clock"> Project work period: {{ $offer->period }} .</strong>
                                    </p>
                                    <strong class="mdi mdi-currency-usd"> Price: {{ $offer->price }} $.</strong>
                                </div>
                                <div style="display: flex; justify-content: flex-end;">
                                    @if($offer->status == 'accepted')
                                    <a href="{{ route('contracts.show', $project->contract->id) }}"
                                        class="view-contract-button"> View contract </a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
@endif


</ul> </ul>

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
    background-color: #4CAF50; /* لون الخلفية */
    color: white; /* لون النص */
    padding: 8px 16px; /* حشوة الزر (تم تصغيرها) */
    border: none; /* إزالة الحدود */
    border-radius: 5px; /* زوايا دائرية */
    cursor: pointer; /* تغيير شكل المؤشر عند المرور فوق الزر */
    font-size: 14px; /* حجم الخط (تم تصغيره) */
    transition: background-color 0.3s ease, transform 0.2s ease; /* تأثير الانتقال عند تغيير اللون والحجم */
    display: inline-block; /* جعل الزر كعنصر كتلي */

}

.view-contract-button:hover {
    background-color: #45a049; /* تغيير اللون عند المرور فوق الزر */
    transform: scale(1.05); /* تكبير الزر قليلاً عند المرور عليه */
}


        .offer-item {
    border: 1px solid #ccc; /* يمكنك تعديل الحدود حسب الحاجة */
    padding: 10px; /* تقليل الحواف */
    margin: 5px; /* تقليل الهوامش */
    border-radius: 5px; /* لجعل الزوايا دائرية */
    font-size: 14px; /* تقليل حجم الخط */
}

.offer-details {
    line-height: 1.2; /* تقليل ارتفاع السطر */
}

        .offer-list {
    list-style-type: none;
    padding: 0;
}

.offer-item {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 10px;
    transition: background-color 0.3s;
}

.offer-item:hover {
    background-color: #f9f9f9;
}

.offer-item.accepted {
    border-color: #28a745; /* لون أخضر لحالة العرض المقبول */
    background-color: #d4edda; /* خلفية خضراء فاتحة */
}

.offer-title {
    font-size: 1.25rem;
    margin-bottom: 5px;
}

.offer-description {
    font-size: 1rem;
    color: #555;
}

.offer-user, .offer-price {
    font-weight: bold;
}

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
