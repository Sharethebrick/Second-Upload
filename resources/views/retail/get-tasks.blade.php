<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item ScrollStyles">

<div class="table-responsive" >          
  <table class="table single_listing_item-table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <!-- <th>Note</th> -->
		<th>Assigned To</th>
		<th>Assigned By</th>
        <!-- <th style="width:100px;">Due Date</th> -->
        <th>Action</th>
        <!-- <th>Spent Time</th> -->
      </tr>
    </thead>
    <tbody>
	@if( $member_tasks->count() )
		@foreach( $member_tasks as $single_task )
		<tr>
			<td>{{ $single_task->title }}</td>
			<td>
				<span style="cursor:pointer;" class="tooltip-r" data-toggle="tooltip" data-placement="left" title="{{ $single_task->description }}">
					{{Getdesc($single_task->description, 10)}}				
					</span>
			</td>
			<!-- <td>
				<span style="cursor:pointer;" class="tooltip-r" data-toggle="tooltip" data-placement="left" title="{{ $single_task->note }}">
					{{Getdesc($single_task->note, 10)}}				
				</span>
			</td> -->
			<td>{{ $single_task->assigned_to_user ? $single_task->assigned_to_user->name : 'NA' }}</td>
			<td>{{ $single_task->assigned_by_user ? $single_task->assigned_by_user->name : 'NA' }}</td>
			<!-- <td>{{ $single_task->due_date }}</td> -->
			<td>
		
					@if(!empty($single_task->assigned_to_user) &&  $single_task->assigned_to_user->id != "")
					
						@if($single_task->assigned_to_user->id == Auth::user()->id && $single_task->is_completed == 'no')
						
							<!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="openTaskModal({{$single_task->id}})" data-backdrop="static" data-keyboard="false" data-target="#exampleModal" >
							<i class="fa fa-edit"></i>
							</button> -->
							
							<button title="View Note" type="button" style="background-color:black" class="btn btn-dark btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#exampleModalLong" onclick="openNoteModal({{$single_task->id}},'{{$single_task->title}}')"><i class="fa fa-eye"></i></button>
							<a href="javascript:void(0);" title="Complete" class="btn btn-success btn-sm" onclick="completeTask({{$single_task->id}})">
							<i class="fa fa-check-circle"></i></a>


							
							<!-- <a href="javascript:void(0);" class="btn btn-danger btn-sm" data-id="{{ $single_task->id }}" data-toggle="modal" data-target="#delete-pop" class="delete_listing ">
						<i class="fa fa-trash"></i>
							</a> -->
						@else
						
							<!-- <span>N/A</span> -->
						@endif
					@else
						<!-- <span>N/A</span> -->
					@endif
					@if($single_task->assigned_to_user->id != Auth::user()->id && $single_task->is_completed == 'no')
					<button title="View Note" type="button" style="background-color:black" class="btn btn-dark btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#exampleModalLong" onclick="openNoteModal({{$single_task->id}},'{{$single_task->title}}')"><i class="fa fa-eye"></i></button>
					@endif
					@if($single_task->is_completed == 'yes')
					<button title="View Note" type="button" style="background-color:black" class="btn btn-dark btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#exampleModalLong" onclick="openNoteModal({{$single_task->id}},'{{$single_task->title}}')"><i class="fa fa-eye"></i></button>

					<a href="javascript:void(0);" title="Completed" class="btn btn-success btn-sm" >
					<i class="fa fa-check-circle"></i></a>
					@endif


					@if($single_task->assigned_by == Auth::user()->id)
					<a class="btn  btn-sm" data-id="{{ $single_task->id }}" style="background-color:#1D8DD3;color:#ffff" id="update-task-tab" data-toggle="tab" href="#updateTask" role="tab" aria-controls="updatetask" aria-selected="false">
									<i class="fa fa-edit"> </i>												
					</a>
					@endif
				</td>
			<!-- <td>@if(!empty($single_task->working_hours))
					<span class="badge badge-secondary">
						
						@php
						$minutes = $single_task->working_hours;

						$hours = intdiv($minutes, 60).':'. ($minutes % 60);
						@endphp
						{{$hours}} Hrs
						</span>
					@else
					 
					   @if(!empty($single_task->assigned_to_user) &&  $single_task->assigned_to_user->id != "")
					   
					        @if($single_task->assigned_to_user->id == Auth::user()->id)
					        
								<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" onclick="openTaskModal({{$single_task->id}})" data-backdrop="static" data-keyboard="false" data-target="#exampleModal" >
								Add Time
								</button>
							@else
								<span>N/A</span>
							@endif
						@else
						     <span>N/A</span>
						@endif
					@endif
			</td> -->
		</tr>
		@endforeach
		@else
		<tr align="center"><td colspan="8" style="text-align: center;">No record found</td></tr>
		@endif
    </tbody>
  </table>
  </div>
</div>
