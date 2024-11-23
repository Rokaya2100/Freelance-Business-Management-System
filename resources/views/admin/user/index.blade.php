@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Sections</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Sections List</span>
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
                                    <button class="btn btn-primary btn-with-icon btn-block col-sm-6 col-md-2"><i class="typcn typcn-plus"></i> ADD SECTION</button>                                                </td>
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
											<tr>
                                                <td>1</td>
												<td>Mobile Applications</td>
												<td>there are projects about Mobile Applications</td>
                                                <td>1/2/2024</td>
												<td>
                                                <button class="btn btn-primary btn-with-icon btn-block"><i class="typcn typcn-eye-outline"></i> Show</button>                                                </td>
                                                </td>
                                                <td>
                                                <button class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i> Edit</button>                                                </td>
                                                <td>
                                                <button class="btn btn-danger btn-with-icon btn-block"><i class="typcn typcn-delete"></i> Delete</button>                                                </td>
                                                </td>
											</tr>
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
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection