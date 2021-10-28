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
			<h2>{{ empty($member_task) ? 'Add' : 'Edit' }} Member Task</h2>
		</div>
	</div>
</div>
<!-- End Page Title Area -->
@if( !empty($member_task) )
@php extract( $member_task ); @endphp
@endif
<!-- Start Checkout Area -->
<section class="login-area ptb-100">
	<div class="container">
		<div class="bg-box-als">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<form id="add_member_task">
						@csrf
						@if( !empty($member_task) )
						<input type="hidden" name="task_id" value="{{ $id }}">
						@endif
						<div class="billing-details">
							<h3 class="title font-strs">Member Task</h3>
							<div class="row">
								<div class="col-lg-4 col-md-4">
									<div class="form-group">
										<label>Title <span class="required">*</span></label>
										<input type="text" class="form-control" required name="title" value="{{ $title ?? '' }}" autocomplete="off">
									</div>
								</div>
								<div class="col-lg-4 col-md-4">
									<div class="form-group">
										<label>Due Date <span class="required">*</span></label>
										<input type="text" class="form-control start-end-datetime" required name="due_date" value="{{ $due_date ?? '' }}" autocomplete="off" readonly="readonly">
									</div>
								</div>
														
								<div class="col-lg-4 col-md-4">
									<div class="form-group">
										<label>Assigned to <span class="required">*</span></label>
										<select name="assigned_to" required class="chosen-select">

											<option value=""> Select member </option>
											@foreach( $other_members as $single_member )
											<option value="{{ $single_member->id }}" {{ isset($assigned_to) && $assigned_to == $single_member->id ? 'selected' : ''  }}>
												{{ $single_member->name }} ({{ $single_member->email }})
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<label>Description <span class="required">*</span></label>
										<textarea name="description" required id="description" cols="30" rows="5" placeholder="" class="form-control">{{ $description ?? '' }}</textarea>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<label>Note <span class="required"></span></label>
										<textarea name="note" id="note" cols="30" rows="5" placeholder="" class="form-control">{{ $note ?? '' }}</textarea>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<button class="btn btn-save-stt submit_btn" type="submit"> {{ empty($member_task) ? 'Save' : 'Update' }} </button>
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
		
		var date_time_picker_setting = {
			format:"Y-m-d",
			minDate:0
		};
		$('[name=due_date]').datepicker( {
			format:"Y-m-d",
			minDate:0
		} );
		
		$('.chosen-select').chosen({
			allow_single_deselect: true,
			width: '100%',
		});
		$('#add_member_task').validate({
			ignore: [],
			rules: {
				due_date: {
                required: true,
                date: true
            	}
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
					url:"{{ route('retail.member.task.store-update') }}",
					type: 'POST',
					data: formData,
					contentType: false, 
					processData: false,
					success:function(result){
						if( result.status ){
							swal({
								title: "Success!", text: result.message, type: "success"
							},function(){
								location = '{{ route("retail.member.task") }}'
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
			}
		});
	});

</script>





@stop