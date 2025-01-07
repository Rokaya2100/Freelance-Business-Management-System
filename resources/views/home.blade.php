@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex"><h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ General analyzes of the site</span></div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<div class="row row-sm">
					<div class="col-lg-6 col-xl-3 col-md-6 col-12">
						<div class="card bg-primary-gradient text-white ">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="icon1 m-2 text-center">
											<i class="fe fe-users tx-60"></i>
										</div>
									</div>
									<div class="col-6">
										<div class="mt-1 text-center">
											<span class="text-white tx-20">Users</span>
											<h1 class="text-white mb-2">120</h1>
										</div>
									</div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Client</span>
                                        <h3 class="text-white mb-0">40</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Freelancer</span>
                                        <h3 class="text-white mb-0">80</h3>
                                    </div>
                                </div>
                                 </div><hr>
                                <div class="tx-24 ml-5">
                                    <a href="{{ route('users.index')}}" class="small-box-footer text-center text-white">More info <i class="typcn typcn-arrow-right-outline"></i></a>
                                </div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-xl-3 col-md-6 col-12">
						<div class="card bg-success-gradient text-white">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="icon1 m-2 text-center">
											<i class="fa fa-thin fa-lightbulb tx-60"></i>
										</div>
									</div>
									<div class="col-6">
										<div class="mt-1 text-center">
											<span class="text-white tx-20">Projects</span>
											<h1 class="text-white mb-2">450</h1>
										</div>
									</div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Pending</span>
                                        <h3 class="text-white mb-0">250</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Completed</span>
                                        <h3 class="text-white mb-0">200</h3>
                                    </div>
                                </div>
                                 </div><hr>
                                <div class="tx-24 ml-5">
                                    <a href="{{-- {{ route('orders.index')}} --}}" class="small-box-footer text-center text-white">More info <i class="typcn typcn-arrow-right-outline"></i></a>
                                </div>
							</div>
						</div>
					</div>
                    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
						<div class="card bg-danger-gradient text-white">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="icon1 mt-2 text-center">
                                        <i class="fa fa-thin fa-file-signature tx-60"></i>
										</div>
									</div>
                                    <div class="col-6">
										<div class="mt-1 text-center">
											<span class="text-white tx-20">Contracts</span>
											<h1 class="text-white mb-2">320</h1>
										</div>
									</div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">In progress</span>
                                        <h3 class="text-white mb-0">120</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Finished</span>
                                        <h3 class="text-white mb-0">200</h3>
                                    </div>
                                </div>
                                 </div><hr>
                                <div class="tx-24 ml-5">
                                    <a href="{{-- {{ route('orders.index')}} --}}" class="small-box-footer text-center text-white">More info <i class="typcn typcn-arrow-right-outline"></i></a>
                                </div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-xl-3 col-md-6 col-12">
						<div class="card bg-warning-gradient text-white">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="icon1 text-center" style="margin: -20px">
                                            <i class="typcn typcn-star tx-70"></i>
										</div>
									</div>
                                    <div class="col-6">
										<div class="mt-1 text-center">
											<span class="text-white tx-20">Reviews</span>
											<h1 class="text-white mb-2">320</h1>
										</div>
									</div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Rates</span>
                                        <h3 class="text-white mb-0">120</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Reviews</span>
                                        <h3 class="text-white mb-0">200</h3>
                                    </div>
                                </div>
                                 </div><hr>
                                <div class="tx-24 ml-5">
                                    <a href="{{-- {{ route('orders.index')}} --}}" class="small-box-footer text-center text-white">More info <i class="typcn typcn-arrow-right-outline"></i></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
				<!-- end row -->
				<!-- row -->
				<div class="row row-sm">
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="plan-card text-center">
									<i class="fas fa-tags plan-icon text-primary"></i>
									<h6 class="text-drak text-uppercase mt-2">Total Categories</h6>
									<h2 class="mb-2">24</h2>
                                    <div class="tx-20 ml-3">
                                        <a href="{{-- {{ route('orders.index')}} --}}" class="small-box-footer text-center">Show <i class="typcn typcn-arrow-right-outline"></i></a>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="plan-card text-center">
									<i class="fas fa-comments plan-icon text-primary"></i>
									<h6 class="text-drak text-uppercase mt-2">Total Reviews</h6>
									<h2 class="mb-2">493</h2>
									<div class="tx-20 ml-3">
                                        <a href="{{-- {{ route('orders.index')}} --}}" class="small-box-footer text-center">Show <i class="typcn typcn-arrow-right-outline"></i></a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="plan-card text-center">
									<i class="fas fa-envelope-open-text plan-icon text-primary"></i>
									<h6 class="text-drak text-uppercase mt-2">Total Portfolio</h6>
									<h2 class="mb-2">279</h2>
									<div class="tx-20 ml-3">
                                        <a href="{{-- {{ route('orders.index')}} --}}" class="small-box-footer text-center">Show <i class="typcn typcn-arrow-right-outline"></i></a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3 col-md-6 col-lg-6 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="plan-card text-center">
									<i class="fas fa-file text-primary plan-icon"></i>
									<h6 class="text-drak text-uppercase mt-2">Total Reports</h6>
									<h2 class="mb-2">678</h2>
                                    <div class="tx-20 ml-3">
                                        <a href="{{-- {{ route('orders.index')}} --}}" class="small-box-footer text-center">Show <i class="typcn typcn-arrow-right-outline"></i></a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-4">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<h4 class="card-title">Active Projects</h4>
									<i class="mdi mdi-dots-vertical"></i>
								</div>
								{{-- <p class="card-description mb-1">What're people doing right now</p> --}}
								<div class="list d-flex align-items-center border-bottom py-3">
									<div class="avatar brround d-block cover-image" data-image-src="{{URL::asset('assets/img/faces/5.jpg')}}">
										<span class="avatar-status bg-green"></span>
									</div>
									<div class="wrapper w-100 mr-3">
										<p class="mb-0">
										<b>Lilly </b>posted in Website</p>
										<div class="d-sm-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted ml-1"></i>
												<p class="mb-0">Awesome websites!</p>
											</div>
											<small class="text-muted mr-auto">2 hours ago</small>
										</div>
									</div>
								</div>
								<div class="list d-flex align-items-center border-bottom py-3">
									<div class="avatar brround d-block cover-image" data-image-src="{{URL::asset('assets/img/faces/14.jpg')}}">
										<span class="avatar-status bg-green"></span>
									</div>
									<div class="wrapper w-100 mr-3">
										<p class="mb-0">
										<b>Marry cott </b>posted in photo</p>
										<div class="d-sm-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted ml-1"></i>
												<p class="mb-0">That's Great!</p>
											</div>
											<small class="text-muted mr-auto">1 hours ago</small>
										</div>
									</div>
								</div>
								<div class="list d-flex align-items-center pt-3">
									<div class="avatar brround d-block cover-image" data-image-src="{{URL::asset('assets/img/faces/4.jpg')}}">
										<span class="avatar-status bg-green"></span>
									</div>
									<div class="wrapper w-100 mr-3">
										<p class="mb-0">
										<b>John </b>posted in Status</p>
										<div class="d-sm-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted ml-1"></i>
												<p class="mb-0">Awesome websites!</p>
											</div>
											<small class="text-muted mr-auto">1 hours ago</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-md-12 col-xl-4">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<h4 class="card-title">Lasted Projects</h4>
									<i class="mdi mdi-dots-vertical"></i>
								</div>
								<div class="list d-flex align-items-center border-bottom py-3">
									<div class="avatar brround d-block cover-image" data-image-src="{{URL::asset('assets/img/faces/5.jpg')}}">
										<span class="avatar-status bg-green"></span>
									</div>
									<div class="wrapper w-100 mr-3">
										<p class="mb-0">
										<b>Lilly </b>posted in Website</p>
										<div class="d-sm-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted ml-1"></i>
												<p class="mb-0">Awesome websites!</p>
											</div>
											<small class="text-muted mr-auto">2 hours ago</small>
										</div>
									</div>
								</div>
								<div class="list d-flex align-items-center border-bottom py-3">
									<div class="avatar brround d-block cover-image" data-image-src="{{URL::asset('assets/img/faces/1.jpg')}}">
										<span class="avatar-status bg-green"></span>
									</div>
									<div class="wrapper w-100 mr-3">
										<p class="mb-0">
										<b>Thomos</b>posted in Material</p>
										<div class="d-sm-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted ml-1"></i>
												<p class="mb-0">Awesome websites!</p>
											</div>
											<small class="text-muted mr-auto">3 hours ago</small>
										</div>
									</div>
								</div>
								<div class="list d-flex align-items-center pt-3">
									<div class="avatar brround d-block cover-image" data-image-src="{{URL::asset('assets/img/faces/14.jpg')}}">
										<span class="avatar-status bg-green"></span>
									</div>
									<div class="wrapper w-100 mr-3">
										<p class="mb-0">
										<b>Marry cott </b>posted in photo</p>
										<div class="d-sm-flex justify-content-between align-items-center">
											<div class="d-flex align-items-center">
												<i class="mdi mdi-clock text-muted ml-1"></i>
												<p class="mb-0">That's Great!</p>
											</div>
											<small class="text-muted mr-auto">1 hours ago</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12 col-lg-6 col-xl-4 col-sm-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex justify-content-between">
									<h4 class="card-title">Latest Ratings and Reviews</h4>
									<i class="mdi mdi-dots-vertical"></i>
								</div>
							</div>
							{{-- <p class="tx-12 tx-gray-500 mb-0 pl-3 pr-3"><a href="">Learn more</a></p> --}}
							<div class="rating-scroll ps ps--active-y">
								<div class="pl-3 pr-3 py-3 border-bottom">
									<div class="media mt-0">
										<div class="d-flex ml-3">
											<a href="#">
												<img class="media-object avatar brround w-7 h-7" alt="64x64" src="{{URL::asset('assets/img/faces/9.jpg')}}">
											</a>
										</div>
										<div class="media-body">
											<div class="d-flex">
												<h6 class="mt-0 mb-0 font-weight-semibold ">Cristobal Sharp</h6>
												<span class="tx-12 mr-auto">
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star-half text-warning"></i>
													<i class="ion ion-md-star-outline text-warning"></i>
												</span>
											</div>
											<div class="d-flex">
												<p class="tx-12 text-muted mb-1">The point of using Lorem..</p>
												<small class="mr-auto text-left">5 reviews</small>
											</div>
										</div>
									</div>
								</div>
								<div class="pl-3 pr-3 py-3 border-bottom">
									<div class="media mt-0">
										<div class="d-flex ml-3">
											<a href="#">
												<img class="media-object avatar brround w-7 h-7" alt="64x64" src="{{URL::asset('assets/img/faces/4.jpg')}}">
											</a>
										</div>
										<div class="media-body">
											<div class="d-flex">
												<h6 class="mt-0 mb-0 font-weight-semibold ">Velma Wellons </h6>
												<span class="tx-12 mr-auto">
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star-half text-warning"></i>
												</span>
											</div>
											<div class="d-flex">
												<p class="tx-12 text-muted mb-1">Various versions have..</p>
												<small class="mr-auto text-left">5 reviews</small>
											</div>

										</div>
									</div>
								</div>
								<div class="pl-3 pr-3 py-3 border-bottom">
									<div class="media mt-0">
										<div class="d-flex ml-3">
											<a href="#">
												<img class="media-object avatar brround w-7 h-7" alt="64x64" src="{{URL::asset('assets/img/faces/12.jpg')}}">
											</a>
										</div>
										<div class="media-body">
											<div class="d-flex">
												<h6 class="mt-0 mb-0 font-weight-semibold ">Aurelio Dahmer </h6>
												<span class="tx-12 mr-auto">
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star text-warning"></i>
													<i class="ion ion-md-star-half text-warning"></i>
												</span>
											</div>
											<div class="d-flex">
												<p class="tx-12 text-muted mb-0">Ut enim ad minim veniam..</p>
												<small class="mr-auto text-left">5 reviews</small>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!-- Internal Piety js -->
<script src="{{URL::asset('assets/plugins/peity/jquery.peity.min.js')}}"></script>
<!-- Internal Chart js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endsection
