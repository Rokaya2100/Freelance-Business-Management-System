@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
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
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">SECTIONS TABLE</h4>
                                    <a href="{{ route('sections.create') }}" class="btn btn-primary btn-with-icon btn-block col-sm-6 col-md-2"><i class="typcn typcn-plus"></i> ADD SECTION</a>                                                </td>

                                </div>
							</div>
							<div class="card-body">
								<div class="table">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">ID</th>
                                                <th class="wd-15p border-bottom-0">Name</th>
												<th class="wd-15p border-bottom-0">Description</th>
                                                <th class="wd-15p border-bottom-0">Add Date</th>
                                            	<th class="border-bottom-0"></th>
                                                <th class="border-bottom-0"></th>
                                            	<th class="border-bottom-0"></th>
											</tr>
										</thead>
										<tbody>
											@foreach($sections as $section)
												<tr>
													<td>{{ $section->id }}</td>
													<td>{{ $section->name }}</td>
													<td>{{ $section->description }}</td>
													<td>{{ $section->created_at->format('d/m/Y') }}</td>

													<td>
														<form action="{{ route('admin.sections.restore', $section->id) }}" method="POST">
															@csrf
															<button type="submit" class="btn btn-success btn-with-icon btn-block">
																<i class="typcn typcn-edit"></i> Restore
															</button>
														</form>
													</td>


												</tr>
											@endforeach
										</tbody>
									</table>
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
