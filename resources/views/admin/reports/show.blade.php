@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Report</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ One Report</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
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
                                    <h1 class="card-title mb-3 pb-0" style="color: blue; font-size:20px">
                                    <li class="icons-list-item">
                                    {{$report->id}}
                                    </li>
                                </h1>
                                    <h2 class="card-body mb-3 pb-0  text-info" style=" font-size:20px">
                                    <i class="typcn typcn-archive"></i>
                                         Project Name  :  {{$report->project->name}}</h2>
                                </div>
                                <div class="card-body text-dark ml-5" style=" font-size:18px">
                               <div class="mb-3">
                                    <i class="fe fe-airplay"></i>
                                            Description : {{$report->description}}
                               </div>
                               <div class="mb-3">
                                    <i class="mdi mdi-account-outline"></i>
                                    User Name : {{$user->name}}
                               </div>
                               <div class="mb-3">
                               <i class="si si-layers"></i>
                                    Section Name : {{$section->name}}
                               </div>
                               <div class="mb-3">
                                    <i class="la la-calendar"></i>
                                    Exp Delivery Date : {{$report->project->exp_delivery_date}}
                               </div>
                               <div class="mb-3">
                                    <i class="la la-calendar"></i>
                                    Delivery Date : {{$report->project->delivery_date}}
                               </div>
                                </div>
                                <div class="card-footer mt-3">
                                    <div  style=" font-size:16px">
                                        <i class="la la-calendar"></i>
                                        Created At :
                                        {{$report->created_at}}
                                    </div>
                            </div>
                                            <a href="{{route('reports.oneExcel',$report->id)}}"
                                                class="btn btn-secondary btn-with-icon btn-block">
                                                <i class="far fa-arrow-alt-circle-down"></i>
                                                Export Report</a>
                                            <form action="{{route('reports.destroy',$report->id)}}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-with-icon btn-block"><i
                                                        class="typcn typcn-delete"></i> Delete</button>
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
