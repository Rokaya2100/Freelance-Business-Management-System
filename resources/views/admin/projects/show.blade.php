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
        </div><div></div></div>
        <!-- Display offers and comments -->
        <!-- Display reviews -->

        <div class="row mt-4">
    <div class="col-lg-4">
        <div class="card project-section">
            <div class="card-body">
                <h4>Comments</h4>
                @if($comments->isEmpty())
                    <p>No comments available yet.</p>
                @else
                    @foreach($comments as $comment)
                        <div class="comment">
                            <strong>{{ $comment->client->name  }}:</strong>
                            <p>{{ $comment->content }}</p>
                            <p class="project-date">{{ $comment->created_at->format('m/d/Y') }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card project-section">
            <div class="card-body">
                <h4>Project Ratings</h4>
                @if($reviews->isEmpty())
                    @if($project->status == 'pending')
                        <p>The project does not have a rating because it is pending</p>
                    @else
                        <p>No reviews available yet.</p>
                    @endif
                @else
                    @foreach($reviews as $review)
                        <div class="review">
                            <strong>Client: {{ $review->client->name }}</strong><br>
                            <strong>Rating:</strong>
                            <span class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rate)
                                        <span class="star-filled">★</span>
                                    @else
                                        <span class="star-empty">☆</span>
                                    @endif
                                @endfor
                                <p class="project-date">{{ $review->created_at->format('m/d/Y') }}</p>
                            </span>
                            <br>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card project-section">
            <div class="card-body">
                <h4>Project Offers</h4>
                @if($project->offers->isEmpty())
                    <p>There are no offers available for this project.</p>
                @else
                    @foreach($project->offers as $offer)
                        <li class="offer-item {{ $offer->status == 'accepted' ? 'accepted' : '' }}" style="display: flex; flex-direction: column;">
                            <div class="offer-details">
                                <h5 class="mdi mdi-account-outline">{{ $offer->users->name }}</h5>
                                <p><strong class="mdi mdi-comment-text">{{ $offer->description }}</strong></p>
                                <p class="mdi mdi-cloud"> Status: {{ $offer->status }}.</p>
                                <p><strong class="mdi mdi-calendar-clock"> Project work period: {{ $offer->period }}.</strong></p>
                                <strong class="mdi mdi-currency-usd"> Price: {{ $offer->price }} $.</strong>
                                @if($offer->status == 'accepted')
                                <a href="{{ route('contracts.show', $project->contract->id) }}" class="view-contract-button"> View contract </a>
                            @endif
                            <p class="project-date">{{ $offer->created_at->format('m/d/Y') }}</p>
                            </div>
                        </li>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>



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

.project-section {
    background-color: #fff;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px; /* مسافة بين الأقسام */
}

.divider-line {
    border-top: 1px solid #ddd; /* تغيير اللون والفاصلة */
    margin: 20px 0; /* إضافة مسافة بين الفواصل */
}

.project-offers-comments {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.project-offers, .project-comments {
    width: 48%; /* تحديد العرض لكل قسم ليكون 48% */
}

.project-offers {
    border-right: 1px solid #ddd; /* فاصل بين العروض والتعليقات */
    padding-right: 20px;
}

.project-comments {
    padding-left: 20px;
}

/* تحسين مظهر الفاصل */
.project-offers-comments::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 1px;
    background-color: #ddd; /* يمكنك تعديل لون الفاصل حسب الرغبة */
}

.star-filled {
    color: gold;  /* جعل النجمة المملوءة باللون الذهبي */
    font-size: 20px; /* حجم النجمة */
}

.star-empty {
    color: #ccc;  /* جعل النجمة الفارغة بلون رمادي */
    font-size: 20px; /* نفس حجم النجمة */
}

.stars {
    font-size: 1.2rem; /* ضبط حجم النجوم */
}

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
