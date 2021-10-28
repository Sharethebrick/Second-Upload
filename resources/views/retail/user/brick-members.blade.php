<form action="{{ route('retail.update-brick-members') }}" method="post" id="update-brick-members">
	@csrf
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="form-group">
				<input type="hidden" name="brick_id" id="brick_id" value="{{ $brick_details->id }}">
				<select class="form-control multipleSelects" data-placeholder="Choose members..." name="invited_to[]" multiple>
					@foreach($users as $single_user)
					<option value="{{ $single_user->id }}" {{ in_array( $single_user->id , $members ) ? 'selected' : '' }}>
						{{ $single_user->name }}&lt;{{ $single_user->email }}&gt;
					</option>
					@endforeach    
				</select>
			</div> 
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<button class="submit_btn btn btn-save-stt" type="submit"> Save </button>
		</div>
	</div>
</form>
