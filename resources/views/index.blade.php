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
											<h1 class="text-white mb-2">{{DB::table('users')->count()}}</h1>
										</div>
									</div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Client</span>
                                        <h3 class="text-white mb-0">{{DB::table('users')->where('role','client')->count()}}</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Freelancer</span>
                                        <h3 class="text-white mb-0">{{DB::table('users')->where('role','freelancer')->count()}}</h3>
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
											<h1 class="text-white mb-2">{{DB::table('projects')->count()}}</h1>
										</div>
									</div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Pending</span>
                                        <h3 class="text-white mb-0">{{DB::table('projects')->where('status','pending')->count()}}</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Completed</span>
                                        <h3 class="text-white mb-0">{{DB::table('projects')->where('status','completed')->count()}}</h3>
                                    </div>
                                </div>
                                 </div><hr>
                                <div class="tx-24 ml-5">
                                    <a href="{{ route('projects.index')}}" class="small-box-footer text-center text-white">More info <i class="typcn typcn-arrow-right-outline"></i></a>
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
											<h1 class="text-white mb-2">{{DB::table('contracts')->count()}}</h1>
										</div>
									</div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">In progress</span>
                                        <h3 class="text-white mb-0">{{DB::table('contracts')->where('status','in_progress')->count()}}</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-3 text-center">
                                        <span class="text-white">Finished</span>
                                        <h3 class="text-white mb-0">{{DB::table('contracts')->where('status','expired')->count()}}</h3>
                                    </div>
                                </div>
                                 </div><hr>
                                <div class="tx-24 ml-5">
                                    <a href="{{ route('contracts.index')}}" class="small-box-footer text-center text-white">More info <i class="typcn typcn-arrow-right-outline"></i></a>
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
									<h2 class="mb-2">{{DB::table('sections')->count()}}</h2>
                                    <div class="tx-20 ml-3">
                                        <a href="{{ route('sections.index')}}" class="small-box-footer text-center">Show <i class="typcn typcn-arrow-right-outline"></i></a>
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
									<h2 class="mb-2">{{DB::table('reports')->count()}}</h2>
                                    <div class="tx-20 ml-3">
                                        <a href="{{ route('reports.index')}}" class="small-box-footer text-center">Show <i class="typcn typcn-arrow-right-outline"></i></a>
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
