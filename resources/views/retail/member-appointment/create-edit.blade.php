@extends('layouts.app')

@section('content')
<style type="text/css">
.validation-error-message{
	color: red;
}
</style>
<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3">
	<div class="container">
		<div class="page-title-content">
			<h2>{{ empty($member_appointment) ? 'Add' : 'Edit' }} {{ $group_info->group_name }} Appointment</h2>
		</div>
	</div>
</div>
<!-- End Page Title Area -->
@if( !empty($member_appointment) )
@php extract( $member_appointment ); @endphp
@endif
<!-- Start Checkout Area -->
<section class="login-area ptb-100">
	<div class="container">
		<div class="bg-box-als">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<form id="add_member_appointment">
						@csrf
						<input type="hidden" class="form-control" required name="group_id" value="{{ Request::route('group_id') }}" autocomplete="off">
						@if( !empty($member_appointment) )
						<input type="hidden" name="appointment_id" value="{{ $id }}">
						@endif
						<div class="billing-details">
							<h3 class="title font-strs">{{ $group_info->group_name }} Appointment</h3>
							<div class="row">
								
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Title <span class="required">*</span></label>
										
										<input type="text" class="form-control" required name="title" value="{{ $title ?? '' }}" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Description <span class="required">*</span></label>
										<input type="text" class="form-control" required name="description" value="{{ $description ?? '' }}" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Start datetime <span class="required">*</span></label>
										<input type="text" class="form-control start-end-datetime" required name="start_datetime" value="{{ $start_datetime ?? '' }}" autocomplete="off" readonly="readonly">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>End datetime <span class="required">*</span></label>
										<input type="text" class="form-control start-end-datetime" required name="end_datetime" value="{{ $end_datetime ?? '' }}" autocomplete="off" readonly="readonly">
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<label>Members <span class="required">*</span></label>
										<select name="members[]" required class="chosen-select" multiple data-placeholder="Select members...">
											@foreach( $other_members as $single_member )
											<option value="{{ $single_member->id }}" {{ isset($members) && in_array( $single_member->id , $members ) ? 'selected' : ''  }}>
												{{ $single_member->name }} ({{ $single_member->email }})
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<button class="btn btn-save-stt submit_btn" type="submit"> {{ empty($member_appointment) ? 'Save' : 'Update' }} </button>
								</div>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</section>
<!-- End Checkout Area -->

@endsection
@section('footer_scripts')
<link rel="stylesheet" href="{{ asset('css/component-chosen.css') }} " />
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$('.chosen-select').chosen({
			allow_single_deselect: true,
			width: '100%',
		});
		var date_time_picker_setting = {
			format:"Y-m-d H:i:00",
			minDate:0
		};
		$('[name=end_datetime]').datetimepicker( date_time_picker_setting );
		date_time_picker_setting.onChangeDateTime = function( ct , $input ){
			console.log("Changed...");
			if( $input.attr("name") == "start_datetime" ){
				var start_date = $input.val();
				if( start_date ){
					start_date = start_date.replace(/-/g, "/");
					date_time_picker_setting.minDate = start_date.substring( 0, 10 );
					$('input[name=end_datetime]').datetimepicker(date_time_picker_setting);
					$('input[name=end_datetime]').val('');
				}
			}else if( $input.attr("name") == "end_datetime" ){
				var start_date = $("[name=start_datetime]").val();
				if( start_date ){
					date_time_picker_setting.minTime = "12:00:00";
					console.log( date_time_picker_setting );
					$('input[name=end_datetime]').datetimepicker(date_time_picker_setting);
				}
			}
		}
		$('[name=start_datetime]').datetimepicker( date_time_picker_setting );


		$('#add_member_appointment').validate({
			ignore: [],
			rules: {
			},
			highlight: function(element) {
				$(element).parent().addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('has-error');
			},
			errorElement: 'span',
			errorClass: 'validation-error-message help-block form-helper bold',
			errorPlacement: function(error, element) {
				if (element.is('select:hidden')) {
					error.appendTo(element.parent());
				}else{
					error.insertAfter(element);
				}
			},
			submitHandler: function(form){
				$('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
				var formData = new FormData(form);	
				$.ajax({
					url:"{{ route('retail.member.appointment.store-update') }}",
					type: 'POST',
					data: formData,
					contentType: false, 
					processData: false,
					success:function(result){
						if( result.status ){
							swal({
								title: "Success!", text: result.message, type: "success"
							},function(){
								location = '{{ route("retail.member.appointment",['group_id' => Request::route('group_id')]) }}'
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
							location = '{{ route("retail.member.appointment",['group_id' => Request::route('group_id')]) }}'
						});
					}
				});
			}
		});
	});

</script>





@stop