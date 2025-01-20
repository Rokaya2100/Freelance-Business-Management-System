@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Profile</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
                                        @if($user->role === 'freelancer')
												<h4 class="main-profile-name">{{ $user->name }}</h4>
												<h3 class="main-profile-name-text">{{ $user->email}}</h3>
											</div>
                                            </div>
										<div class="main-profile-bio">
										</div><!-- main-profile-bio -->
										<div class="row">
											<div class="col-md-4 col mb20">
												<h5>{{ $projectCountfreelancer }}</h5>
												<h6 class="text-small text-muted mb-0">Projects</h6>
											</div>
											<div class="col-md-4 col mb20">
												<h5>{{$reviewscount}}</h5>
												<h6 class="text-small text-muted mb-0">Reviews</h6>
											</div>

										</div>
										<hr class="mg-y-30">
										<label class="main-content-label tx-15 mg-b-20">About me</label>
										<div class="main-profile-social-list">
											<div class="media">
												<div class="media-icon bg-primary-transparent text-primary">
													<h3 class="typcn typcn-user"></h3>
												</div>
												<div class="media-body">
													<span>login as:</span> <a href="">{{ $user->role}}</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-success-transparent text-success">
													<h3 class="typcn typcn-home"></h3>
												</div>
												<div class="media-body">
                                                    <span>country</span> <a href="">{{ $user->country}}</a>
												</div>
											</div>
										</div>
									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">

                        <div class="card">
							<div class="card-body">
                                <div class="tabs-menu">
                                    <!-- Tabs -->

                                    @if($portfolio)
							<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab">
            <i class="fas fa-briefcase"></i> PORTFOLIO
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="projects-tab" data-toggle="tab" href="#projects" role="tab">
            <i class="fas fa-project-diagram"></i> PROJECTS
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab">
            <i class="fas fa-star"></i> REVIEWS
        </a>
    </li>
</ul>

<div class="tab-content">
<div class="tab-pane fade" id="portfolio" role="tabpanel">
        <h4 class="col-md-6 mb-3 mdi mdi-calendar-clock"> Description</h4>
        <p class="col-md-6 mb-3">{{ $portfolio->description }}</p>
        <div class="m-t-30">
            <h4 class="col-md-6 mb-3 si si-layers"> Skills</h4>
            <div class="p-t-10">
                <h5 class="col-md-6 mb-3 ">{{ $portfolio->skills }}</h5>
            </div>
            <hr>
        </div>
    </div>

	<div class="tab-pane fade" id="projects" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                @if($project->isEmpty())
                    <p>No projects available.</p>
                @else
                    @foreach($project as $project)
                        <div class="col-md-4 mb-4">
                            <div class="card project-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->name }}</h5>
                                    <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">View Project</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade show active" id="reviews" role="tabpanel">
    <span><i class="fas fa-comments"></i> Review</span>
    <div class="project-reviews mt-3">
        @if($reviews->isEmpty())
                <p>No reviews available yet.</p>
            @else
            @foreach($reviews as $review)
                    <div class="review border p-2 mb-2 rounded">
                        <strong>Client: {{ $review->user->name }}</strong><br>
                        <strong>Rating:</strong>
                        <span class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rate)
                                    <span class="star-filled">★</span>
                                    @else
                                    <span class="star-empty">☆</span>
                                    @endif
                                    @endfor
                                </span>
                                <br>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>


                @elseif(!$portfolio)
                There is no portfolio yet
                @endif
         @elseif($user->role === 'client')
                    <h4 class="main-profile-name">{{ $user->name }}</h4>
					    <h3 class="main-profile-name-text">{{ $user->email}}</h3>
							<div class="main-profile-bio">
								</div><!-- main-profile-bio -->
								    <div class="row">
									    <div class="col-md-4 col mb20">
											<h5>{{ $projectCountclient }}</h5>
												<h6 class="text-small text-muted mb-0">Projects</h6>
											</div>
										</div>
									<hr class="mg-y-30">
								<label class="main-content-label tx-15 mg-b-20">About me</label>
							<div class="main-profile-social-list">
						<div class="media">
					<div class="media-icon bg-primary-transparent text-primary">
				        <h3 class="typcn typcn-user"></h3>
					    </div>
                        <div class="media-body">
													<span>login as:</span> <a href="">{{ $user->role}}</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-success-transparent text-success">
													<h3 class="typcn typcn-home"></h3>
												</div>
												<div class="media-body">
													<span>country</span> <a href="">{{ $user->country}}</a>
												</div>
                                                <div>

                                                </div>

         @endif
         <script>
         $(document).ready(function () {
    // تفعيل التبويبات عند الضغط
    $('.nav-tabs a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</script>
        <style>

    .project-card:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .review {
        background-color: #e9ecef;
        border-radius: 8px;
    }

    .star-filled {
        color: gold;
    }

    .star-empty {
        color: lightgray;
    }

nav-tabs .nav-link {
        color: #6c757d;
        font-weight: bold;
        transition: background-color 0.3s;
    }

	project-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .project-card img {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        color: #6c757d;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }


/* تنسيق التبويبات */
.nav-tabs {
    border-bottom: 2px solid #ddd;
}

.nav-tabs .nav-item {
    margin-bottom: 0;
}

.nav-tabs .nav-link {
    padding: 10px 20px;
    font-weight: bold;
    text-transform: uppercase;
    border: 0;
    color: #333;
}

.nav-tabs .nav-link.active {
    color: #007bff;
    border-bottom: 2px solid #007bff;
}

/* تنسيق المحتوى داخل التبويبات */
.tab-content {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
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
/* تنسيق h4 (عنوان المهارات) */
h4.tx-15 {
    font-size: 18px; /* حجم الخط */
    margin-top: 20px; /* المسافة العلوية */
    color: #333; /* لون النص */
}

/* تنسيق div (المحتوى) */
.p-t-10 {

    font-size: 16px; /* حجم النص */
    line-height: 1.6; /* تباعد الأسطر */
    color: #555; /* لون النص */
}
portfolio-description {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #333;
    }

    .skills-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .skills-list {
        padding-left: 0;
    }

    .skill-item {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #555;
        position: relative;
        padding-left: 25px;
    }

    .skill-item i {
        position: absolute;
        left: 0;
        color: #007bff; /* لون الأيقونة */
        font-size: 1.2rem; /* حجم الأيقونة */
    }

    hr {
        border-top: 2px solid #007bff; /* لون الخط الفاصل */
    }
</style>


@endsection
@section('js')
@endsection
