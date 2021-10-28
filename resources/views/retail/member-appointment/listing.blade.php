@extends('layouts.app')

@section('content')
<style type="text/css">
.fontsizepara{
	font-size: 14px;
}
.single-listing-item:hover, .single-listing-item:focus {
	-webkit-transform: none;
	transform: none;
}
</style>
<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3">
	<div class="container">
		<div class="page-title-content">
			<h2>{{ ucfirst($group_info->group_name) }} Appointments</h2>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Checkout Area -->
<section class="login-area ptb-100">
	<div class="container">
		<div class="row">
			
			<div class="col-md-12">
				<div class="listings-alls">
					<div class="billing-details">
						<h3 class="title font-strs font-sma">
							{{ ucfirst($group_info->group_name) }} Appointments <a href="{{ route('retail.member.appointment.create-edit',['group_id'=>Request::route('group_id')]) }}" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> 
						</h3>
					</div>
					

					<div class="row searched_data">
						@if( $member_appointments->count() )
						<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item">
							<div class="single-listing-item new-stl-lyt">
								<div class="row">
									<div class="col-md-2">
										<b>Title</b>
									</div>
									<div class="col-md-2">
										<b>Description</b>
									</div>
									<div class="col-md-2">
										<b>Start datetime</b>
									</div>
									<div class="col-md-2">
										<b>End datetime</b>
									</div>
									<div class="col-md-2">
										<b>Members</b>
									</div>
									<div class="col-md-2">
										<b>Action</b>
									</div>
								</div>
							</div>
						</div>
						
						@foreach( $member_appointments as $single_appointment )
						<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item">
							<div class="single-listing-item new-stl-lyt">
								<div class="row">
									<div class="col-md-2">
										{{ $single_appointment->title }}
									</div>
									<div class="col-md-2">
										{{ $single_appointment->description }}
									</div>
									<div class="col-md-2">
										{{ $single_appointment->start_datetime }}
									</div>
									<div class="col-md-2">
										{{ $single_appointment->end_datetime }}
									</div>
									<div class="col-md-2">
										{{ $single_appointment->member_names }}
									</div>
									<div class="col-md-2">
										{{-- <a href="#" class="view-ayr"> <i class="fa fa-eye"></i> </a> --}}
										<a href="{{ route('retail.member.appointment.create-edit',['appointment_id' => $single_appointment->id , 'group_id'=>$single_appointment->group_id ]) }}" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
										<a href="javascript:void(0);" data-id="{{ $single_appointment->id }}" data-group-id="{{ $single_appointment->group_id  }}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr">
											<i class="bx bx-trash"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="col-lg-12 col-sm-12 col-md-6">
							<div class="single-listing-item new-stl-lyt">
								<center><h4 style="padding:15px 0">  No Appointment Added Yet.</h4></center>
							</div>
						</div>
						@endif
						
					</div>
                    {{-- <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $task_count > items_count() ? '' : 'display: none;' }}" data-id="{{ items_count() }}" total="{{ $task_count }}">
                                Load More
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Checkout Area -->

<div class="modal fade" id="delete-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-delete" role="document">
		<div class="modal-content">

			<div class="modal-body">
				<div class="delte-con-pop">
					<i class="bx bx-trash"></i>
					<h5> Are you sure! </h5>
					<p> Are you sure, you wants to delete it ? </p>
					<input type="hidden" id="group_id">
					<input type="hidden" id="list_delete">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger delete_listing_confirm">Yes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>


@endsection

@section('footer_scripts')
<link rel="stylesheet" href="{{url('/')}}/css/component-chosen.css" />
<script src="{{url('/')}}/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
	$(document).on('click','.delete_listing',function(){
		$('#group_id').val($(this).data('group-id'));
		$('#list_delete').val($(this).attr('data-id'));
	});
	$(document).on('click','.delete_listing_confirm',function(){
		$(this).html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
		var dis = this;
		var listing_id = $('#list_delete').val();
		$.ajax({
			url: '{{ route("retail.member.appointment.delete") }}/' + $('#group_id').val() + "/" +  listing_id,
			dataType: 'json',
			success: function(result) {
				$("#delete-pop").modal('hide');
				if( result.status ){
					swal({
						title: "Success!", text: result.message, type: "success"
					},function(){
						location.reload();
					});
				}else{
					swal({
						title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
					});
				}
			},
			error: function(){
				swal({
					title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
				},function(){
					location.reload();
				});
			}
		});
	});
	
</script>
@stop