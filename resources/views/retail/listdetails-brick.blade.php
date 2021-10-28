<?php ?>@extends('layouts.app')
@section('content')

<style>
.error{
	color:red;
}
</style>
<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3 pdd-sechr userbanner small-bsn">
	<div class="container">
		<div class="page-title-content">
			<h2><span class="icon-ttl"><i class="bx bxs-building-house"></i>  </span> {{$title}}</h2>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start listing Details Area -->
<section class="listing-details-area pt-100 pb-70">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="listing-details-header">
					<div class="row align-items-center">
						<div class="col-lg-12">
							
							<!-- Meta Tabs start -->
							<div id="custom-meta-tabs">
								<div class="brick-tabs">
									<ul class="nav nav-tabs brickDetailPageTabListUL" id="brick-group-tabs" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">
												<i class="fa fa-table"></i> Details
											</a>
										</li>
										@if (Auth::check())
									
											@if((in_array(Auth::user()->id, get_brick_members($list_details->id)) || $list_details->user_id == Auth::user()->id) && !empty(get_brick_group($list_details->id)))										
											<li class="nav-item" role="presentation">
												<a class="nav-link" id="chat-tab" data-toggle="tab" href="#chat" role="tab" aria-controls="chat" aria-selected="false">
												<i class="fa fa-comment"></i>	Chat
												</a>
											</li>											
										
										<li class="nav-item" role="presentation">
											<a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">
											<i class="fa fa-file"></i> Files												
											</a>
										</li>
										<li class="nav-item" role="presentation">
											<a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
											<i class="fa fa-picture-o"></i> Images												
											</a>
										</li>
										
											<li class="nav-item" role="presentation">
												<a class="nav-link" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="calendar" aria-selected="false">
												<i class="fa fa-calendar-o"></i> Calendar												
												</a>
											</li>
									
											<li class="nav-item" role="presentation">
												<a class="nav-link" id="task-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false">
												<i class="fa fa-tasks" aria-hidden="true"></i> Tasks												
												</a>
											</li>
											@endif
										@endif										
									</ul>
									<div class="tab-content" id="brick-group-tabs-content">
										<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
											<div class="listing-title">
												<h2 class="brs-tra">
													{{$list_details->name}}
													<span class="apply_nowspan">
														@if(Auth::check() && $list_details->user_id !=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
														<!--  <a href="javascript:void(0);" class="apply-bew" id="apply_now"> Apply Now </a> -->
														@elseif(!empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
														<!-- <a href="javascript:void(0);" class="apply-bew"> Applied </a> -->
														@endif
														@if($title== 'Brick Details' && !empty($member_invited))
															@if($member_invited->status == 0)
															<a href="javascript:void(0);" class="apply-bew reject_invite" data-id="{{$member_invited->id}}"> Reject Invitation </a>
															<a href="javascript:void(0);" class="apply-bew accept_invite" data-id="{{$member_invited->id}}"> Accept Invitation </a>
															@elseif($member_invited->status == 1)
															<a href="javascript:void(0);" class="apply-bew"> Invitation Accepted </a>
															@elseif($member_invited->status == 2)
															<a href="javascript:void(0);" class="apply-bew"> Invitation Rejected </a>
															@endif
														@endif
													</span>
												</h2>
												<p>{{Getdesc($list_details->description, 150)}}</p>
											</div>
											<div class="listing-meta">
												<ul style="display:inline-block;">
													<li>
														<i class='bx bx-location-plus'></i>
														<span>Location</span>
														<a>{{$list_details->location_city}}</a>
														<input type="hidden" value="{{$list_details->location_city}}" id="location">
													</li>
													@isset($space_type[0])
													<li>
														<i class='bx bx-area'></i>
														<span>Space Type</span>
														<a>{{$space_type[0]->name}}</a>
													</li>
													@endisset
													<li class="collaboration_class">
														<i class='bx bx-building'></i>
														<span>Collaboration Type</span>
														<a>@if(count($collaboration_cat)>0)
															@foreach($collaboration_cat as $value)
															{{$value->name}}
															@if(!$loop->last)
															,
															@endif
															@endforeach
														@endif</a>
													</li>
												</ul>
											</div>
											<div class="listing-details-image-slides owl-carousel owl-theme heigt-ctaa">
												@if(count($listing_images) > 0)
													@foreach($listing_images as $key)
													<div class="listing-details-image text-center">
														<img src="{{url('/')}}/uploads/files/{{$key->name}}" alt="image">
													</div>
													@endforeach
												@endif
											</div>
											<div class="listing-details-desc">
												<!-- <h3>Description</h3> -->
												<!-- {{$list_details->description}} -->												
												@if($list_details->file_upload_viewer == 0 && count($listing_files)>0)
												<h3>Files</h3>
												<div class="amenities-list">
													<div class="row">
													
														@foreach($listing_files as $key)
														<div class="col-lg-3 col-md-3">
															<div class="image-uploda">
																<a href="{{url('/')}}/uploads/files/{{$key->name}}" target="_blank">
																	<img src="{{url('/')}}/img/pdf.jpg">
																</a>
															</div>
														</div>
														@endforeach
													</div>
												</div>
												@endif
												<h3>Location</h3>
												<div class="col-lg-12 col-md-12 showmap" style="display: none;">
													<div id="map_canvas" style="width:100%;height:380px;"></div>
												</div>
											</div>
										</div>
										<!-- Chat Functionality -->										
										<div style="border:3px solid #e8e5e5; padding:8px;" class="tab-pane fade" id="chat"  role="tabpanel" aria-labelledby="chat-tab">
											<div class="chats-alls" id="main-ac">											
												<ul class="list-all-chat mCustomScrollbar ScrollStyle group-chat" id="ScrollStyle">													
												</ul>
												<div class="loader" >
													<center><img src="{{url("/")}}/img/loading.gif" height="70" width="70"></center>													
												</div>												
											</div>											
											<div class="chat-foots" >
												<input type="hidden" name="brick_id" id="brick_id" value="@isset($list_details){{$list_details->id}}@endisset">
												@if (Auth::check())
													@if((in_array(Auth::user()->id, get_brick_members($list_details->id)) || $list_details->user_id == Auth::user()->id) && !empty(get_brick_group($list_details->id)))

													<div class="cont-all-set">											
														<input  type="text" class="fld-sa text_message_for_send" placeholder="Type message here...">
														@if(Auth::check())
														<a href="javascript:void(0)" sender-id="{{Auth::User()->id}}"   class="sbmt-s send_text_msg_btn"> <i class="fa fa-paper-plane"></i> <span>Send</span></a>
														@endif
													</div>
													@endif
												@endif													
											</div>											
										</div>										
										<div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
											
											<a class="nav-link upgrd uprde" id="add-files-tab" data-toggle="tab" href="#addFiles" role="tab" aria-controls="addfiles" aria-selected="false">
												<i class="bx bx-plus"> </i> Upload</a>
										
											<div class="loader" >
												<center><img src="{{url("/")}}/img/loading.gif" height="70" width="70"></center>													
											</div>
											<div class="file-container row" id="group-files">							</div>
										</div>
										<div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">				
											<a class="nav-link upgrd uprde" id="add-images-tab" data-toggle="tab" href="#addImages" role="tab" aria-controls="addimages" aria-selected="false"><i class="bx bx-plus"></i> 	Upload
											</a></br>					
											<div class="loader" >
												<center><img src="{{url("/")}}/img/loading.gif" height="70" width="70"></center>
												</div>
											
											<div class="file-container">
												<div id="group-file-slider">
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">
											<!-- <a style="float:right; margin-bottom:10px;" href="{{url("/retail/calender")}}" 	class="default-btn fillclr"> Add Meeting 
											</a> -->
											<a style="float:right; margin-bottom:10px;" class="nav-link upgrd uprde" id="add-meeting-tab" data-toggle="tab" href="#addMeeting" role="tab" aria-controls="addmeeting" aria-selected="false">
												<i class="bx bx-plus"> </i> Add Meeting												
											</a>
											<br /><br /><br />
											<div id="tab-calendar">
											</div>
											<div id="display-calendar">
												<div class="loader" >
													<center><img src="{{url("/")}}/img/loading.gif" height="70" width="70"></center>													
												</div>
											</div>											
										</div>
										<div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="task-tab">
											<!-- Task tab start	-->
											<div class="row">
												<div class="col-md-12">
													<div class="listings-alls">
														<div class="billing-details">
															<h3 class="title font-strs font-sma">
																Member Tasks 													<a class="nav-link upgrd uprde" id="add-task-tab" data-toggle="tab" href="#addTask" role="tab" aria-controls="addtask" aria-selected="false">
																	<i class="bx bx-plus"> </i> Add Task												
																</a>
																<!-- <a href="{{ route('retail.member.task.create-edit') }}" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New  -->
															</a> 
															</h3>
														</div>														
														<div class="row searched_data" id="displayMembers">
															<div class="loader" style="text-align:center;">
															<center><img src="{{url("/")}}/img/loading.gif" height="70" width="70"></center>													
															</div>																					
															<!-- <div id="displayMembers"></div> -->
														</div>
                									</div>
        										</div>
        									</div>
											<!-- Task tab end -->
										</div>
										<div class="tab-pane fade" id="addTask" role="tabpanel" aria-labelledby="add-task-tab">
											<!-- Task tab start	-->
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<form id="add_member_task">
														@csrf
														@if( !empty($member_task) )
														<input type="hidden" name="task_id" value="{{ $id }}">
														@endif
														<div class="billing-details">
															<h3 class="title font-strs">Add Task</h3>
															<div class="row">
																<div class="col-lg-6 col-md-6">
																	<div class="form-group">
																		<label>Title <span class="required">*</span></label>
																		<input type="text" class="form-control" required name="title" value="" autocomplete="off">
																	</div>
																</div>
																<!-- <div class="col-lg-4 col-md-4">
																	<div class="form-group">
																		<label>Due Date <span class="required">*</span></label>
																		<input type="text" class="form-control start-end-datetime" required name="due_date" value="" autocomplete="off" readonly="readonly">
																	</div> 
																</div>-->													<div class="col-lg-6 col-md-6">
																	<div class="form-group">
																		<label>Assigned to <span class="required">*</span></label>
																		<select name="assigned_to" required class="form-control">
																			<option value=""> Select member </option>
																			@if(Auth::check())
																			@foreach( $other_members as $single_member )
																			<option value="{{ $single_member->userId }}" {{ isset($assigned_to) && $assigned_to == $single_member->userId ? 'selected' : ''  }}>
																				{{ $single_member->name }} ({{ $single_member->email }})
																			</option>
																			@endforeach
																			@endif
																		</select>
																	</div>
																</div>
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label>Description <span class="required">*</span></label>
																		<textarea name="description" required id="description" cols="30" rows="5" placeholder="" class="form-control"></textarea>
																	</div>
																</div>
																<!-- <div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label>Note <span class="required"></span></label>
																		<textarea name="note" id="note" cols="30" rows="5" placeholder="" class="form-control"></textarea>
																	</div>
																</div> -->
																<div class="col-lg-12 col-md-12">
																	<button class="btn btn-save-stt submit_task_btn" type="submit"> {{ empty($member_task) ? 'Save' : 'Update' }} </button>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!-- Add meeting -->
										
										<div class="tab-pane fade" id="addMeeting" role="tabpanel" aria-labelledby="add-meeting-tab">
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<input type="hidden" id="is_admin" value="@isset($is_admin){{$is_admin}}@endisset">
													<form id="add_meeting">
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<input type="hidden" name="type" value="2">
														<div class="billing-details">
														<h3 class="title font-strs">Create Meeting </h3>
														<div class="row">
															<div class="col-lg-6 col-md-6">
																<div class="form-group">
																	<label>Title <span class="required">*</span></label>
																	<input type="text" class="form-control" name="title" value="">
																</div>
															</div>
															<div class="col-lg-6 col-md-6">
																<div class="form-group">
																	<label>Date and Time <span class="required">*</span></label>
																	<input type="text" class="form-control" id="datetimepicker" name="datetime" readonly>
																</div>
															</div>

															<div class="col-lg-6 col-md-6 ">
																<div class="form-group">
																	<label>Invite User <span class="required">*</span></label>
																	<select class="form-control multipleSelect1 " data-placeholder="Choose a user..." name="invited_to[]" multiple>
																	
																		@if(Auth::check())
																			@foreach( $other_members as $single_member )
																			<option value="{{ $single_member->userId }}">
																				{{ $single_member->name }} ({{ $single_member->email }})
																			</option>											@endforeach
																			@if(Auth::User()->id != $brickOwner->id)
																			<option value="{{ $brickOwner->id }}">
																				{{ $brickOwner->name }} ({{ $brickOwner->email }})
																			</option>
																			@endif
																		@endif
																	</select>
																	<div class="collab_type_class"></div>
																</div>
															</div>
															
															<div class="col-lg-12 col-md-12">
																<button class="btn btn-save-stt submit_btn" type="submit"> Save </button>
															</div>
														</div>
													</div>
													</form>
												</div>											
											</div>
										</div>
										
										<!-- Upload Files -->
										<div class="tab-pane fade" id="addFiles" role="tabpanel" aria-labelledby="add-files-tab">
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<input type="hidden" id="is_admin" value="@isset($is_admin){{$is_admin}}@endisset">
													<form method="post"  class="user full-width" id="upload_files" enctype="multipart/form-data">@csrf
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<input type="hidden" name="brick_id"  value="@isset($list_details){{$list_details->id}}@endisset">
														<input type="hidden" name="type" value="2">
														<div class="billing-details">
														<!-- <h3 class="title font-strs">Upload File </h3> -->
														<div class="row">
															<div class="col-lg-6 col-md-6">
																<div class="form-group">
																	<label>Upload File <span class="required">*</span></label>
																	<input type="file" class="form-control" name="file_name" value="">
																</div>
															</div>
																											
															<div class="col-lg-12 col-md-12">
																<button class="btn btn-save-stt file_submit_btn" type="submit"> Save </button>
															</div>
														</div>
													</div>
													</form>
												</div>											
											</div>
										</div>

										<!-- Upload Images -->
										<div class="tab-pane fade" id="addImages" role="tabpanel" aria-labelledby="add-images-tab">
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<input type="hidden" id="is_admin" value="@isset($is_admin){{$is_admin}}@endisset">
													<form method="post" class="user full-width" id="upload_images" enctype="multipart/form-data">@csrf
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<input type="hidden" name="type" value="1">
														<input type="hidden" name="brick_id"  value="@isset($list_details){{$list_details->id}}@endisset">
														<div class="billing-details">
														<!-- <h3 class="title font-strs">Upload File </h3> -->
														<div class="row">
															<div class="col-lg-6 col-md-6">
																<div class="form-group">
																	<label>Upload File <span class="required">*</span></label>
																	<input type="file" class="form-control" name="file_name" value="">
																</div>
															</div>
																											
															<div class="col-lg-12 col-md-12">
																<button class="btn btn-save-stt file_submit_btn" type="submit"> Save </button>
															</div>
														</div>
													</div>
													</form>
												</div>											
											</div>
										</div>

										<!-- Update Task -->
										<div class="tab-pane fade" id="updateTask" role="tabpanel" aria-labelledby="update-task-tab">
											<!-- Task tab start	-->
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<form id="update_member_task">
														@csrf
														
														<input type="hidden" name="update_task_id" id="update_task_id" value="">
														
														<div class="billing-details">
															<h3 class="title font-strs">Update Task</h3>
															
															<div class="row">
																<div class="col-lg-6 col-md-6">
																	<div class="form-group">
																		<label>Title <span class="required">*</span></label>
																		<input type="text" class="form-control" required name="title" id="task-title" value="" autocomplete="off">
																	</div>
																</div>													
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label>Description <span class="required">*</span></label>
																		<textarea name="description" required id="task-description" cols="30" rows="5" placeholder="" class="form-control"></textarea>
																	</div>
																</div>
																
																<div class="col-lg-12 col-md-12">
																	<button class="btn btn-save-stt update_task_btn" type="submit"> Update </button>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				@if($title== 'Brick Details')
				<div class="col-lg-4 col-md-12">
					<div class="listing-sidebar-widget">
						<div class="listing-contact-info">
							<h3>Associated Brands</h3>
							<ul class="bg-othsr memberslist brde-n">
								@if(count($brand_details)>0)
									<li class="txt-tltd">
										<!-- <p class="bricks"> <b> Brick Owner: </b> {{$list_details->brick_owner}}  </p> -->
										<b> Brick Opened by: </b> {{$brand_details[0]->fname}} {{$brand_details[0]->lname}}
									</li>
									<li>
										<img src="{{url('/')}}/uploads/files/{{$brand_details[0]->image}}" class="rounded-circle"/>
										<h2><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup" data-id="{{$brand_details[0]->id}}"> {{$brand_details[0]->name}}</a>
											<span class="loca"> <i class="bx bx-map"></i> {{$brand_details[0]->location_city}}</span>
										</h2>
									</li>

								@else
									<li class="text-show">
										<p class="bricks"> <b> No Data Found. </b> </p>

									</li>
								@endif
									<li> <h4 class="rems-brns"> Brick Members </h4> 
										@if(Auth::check())
											@if($list_details->user_id == Auth::user()->id)
											<a href="#" title="Add/Remove Brick Members" class="manage-brick-members" data-brick-id="@isset($list_details){{$list_details->id}}@endisset"> <i style="color:black" class="fa fa-users" aria-hidden="true"></i> </a>
											@endif
										@endif									
									</li>
								<!-- Manage members -->																													
								@if(count($members)>0)
								@foreach($members as $value)
								<li>
									<img src="{{!empty($value->image) ? url('/uploads/user/').'/'.$value->image : url('/').'/img/user.png'}}" class="rounded-circle"/>
									<h2><a href="{{url('/view-profile')}}/{{$value->user_id}}"> {{$value->fname}} {{$value->lname}}</a>
										<span class="loca"> <i class="bx bx-map"></i> {{$value->company_address}} </span>
									</h2>
								</li>
								@endforeach
								@else
								<li class="text-show">
									<p class="bricks"> <b> No Data Found. </b> </p>

								</li>
								@endif
							</ul>
						</div>
						<div class="listing-contact-info">
							<h3>Additional Details</h3>
							<ul class="bg-othsr">
								<li><span>Collaboration Type :</span> 
									<a>
									@if(count($collaboration_cat)>0)
										@foreach($collaboration_cat as $value)
											{{$value->name}}
											@if(!$loop->last)
											,
											@endif
										@endforeach
									@endif
									</a>
								</li>
									@isset($space_type[0])
										<li><span>Space Type:</span> <a>{{$space_type[0]->name}}</a></li>
									@endisset
								<li><span>Retail Category:</span> <a>{{$retail_cat->name}}</a></li>
								<li class="conts-sa"> <h4 class="ownr-nsrs"> Owner Details </h4></li>
								<li>
									<a href="{{url('/view-profile')}}/{{$listing_owner->id}}" class="nav-link  desn-slts">
												<img src="{{!empty($listing_owner->image) ? url('/uploads/user/').'/'.$listing_owner->image : url('/').'/img/user.png'}}" class="img-usrea"><h4> {{$listing_owner->name}} {{$listing_owner->last_name}}
												</h4> 
									</a>
									@if($listing_owner->company_icon)
										<a href="{{$listing_owner->website}}" class="nav-link  desn-slts">
										<img src="{{!empty($listing_owner->company_icon) ? url('/uploads/user/').'/'.$listing_owner->company_icon : url('/').'/img/user.png'}}" class="img-usrea"></a>
									@endif
									@if($listing_owner->business_number)
										<a href="tel:{{$listing_owner->business_number}}" class="send-imsy-b">
											<i class="fa fa-phone"></i> {{$listing_owner->business_number}} 
										</a>
									@endif
									<a href="mailto:{{$listing_owner->email}}" class="send-imsy-b">
										<i class="bx bx-envelope"></i> {{$listing_owner->email}} 
									</a>
									<p>{{$listing_owner->company_address}}</p>

									@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
										<a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalsendmsg" class="send-imsy-b"><i class="bx bx-envelope"></i> 
											Contact Us 
										</a>
									@elseif(!empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
									<a href="javascript:void(0);" class="apply-bew"> Applied </a>
									@endif

								</li>
							</ul>
						</div>
						@if(count($list_associated)>0)
						<div class="listing-contact-info">
							<h3>Associated Listing </h3>
							<div class="single-listing-item brick-strs">
								<div class="listing-image">
									<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block get_list_details_popup" data-id="{{$list_associated[0]->id}}"><img src="{{url('/')}}/uploads/files/{{$list_associated[0]->image}}" alt="image">
									</a>
									<div class="listing-tag">
										<a href="#" class="d-block"><b> ID: </b>#{{$list_associated[0]->id}}</a>
									</div>
								</div>
								<div class="listing-content">
									<h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block get_list_details_popup" data-id="{{$list_associated[0]->id}}">{{$list_associated[0]->name}}</a></h3>
									<p class="mt-2">{{Getdesc($list_associated[0]->description,200,1)}}</p>
								</div>
								<div class="listing-box-footer br-st-a ptb-10 tsts-sla">
									<span class="add-bt"> <b> Listed By: </b> {{$list_associated[0]->fname}} {{$list_associated[0]->lname}}
										<span>
											<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" data-id="{{$list_associated[0]->id}}" class="bts-aea get_list_details_popup"> View Details </a>
										</span>
									</span>
								</div>
							</div>
						</div>
						@endif
						<a href="{{$list_details->link}}" target="_blank">
							<div class="pl-0 pt-0">
								<h3>External Listing</h3>
								<div class="listing-sidebar-widget">
									<div class="listing-contact-info">
										<ul class="bg-othsr memberslist brde-n">
											<li>
												<img src="{{$external_link}}" class="rounded-circle"/>
												<h2>
													<span class="loca">{{$external_title}}</span>
												</h2>

											</li>
										</ul>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				@endif
			<div>
		</div>								
		
    </div>
</div>
</section>


<div class="modal fade" id="listing-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-review modal-lg" role="document">
		<div class="modal-content contnt-design-new">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-4 pb-4">
				<center><img src="{{url('/')}}/img/loading.gif" height="100" width="100"></center>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModalsendmsg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Listing ID #{{$list_details->id}} @if(Auth::check()) <b>From:</b> {{Auth::User()->name}} {{Auth::User()->last_name}} @endif</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="send_enquiry_msg_form">
				@csrf
				<div class="modal-body">
					<input type="hidden" name="listing_id" value="{{$list_details->id}}">
					<input type="hidden" name="request_to" value="{{$list_details->user_id}}">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Subject:</label>
						<input type="text" class="form-control" id="subject" name="subject" value="Inquiry about listing #{{$list_details->id}}">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Message:</label>
						<textarea class="form-control" id="message-text" rows="5" name="message"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary submit_btn">Send message</button>
				</div>
			</form>
		</div>
	</div>
</div>
		<!-- Manage brick members popup -->
<div class="modal fade" id="manage-brick-members-popup" tabindex="-1" role="dialog" 	aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-review modal-lg" role="document">
			<div class="modal-content contnt-design-new">
				<div class="modal-header">
					<h5 class="modal-title">Members </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>  </button> 
				</div>
				<div class="modal-body pt-4 pb-4">

				</div>
			</div>
			
		</div>
</div>

<!-- Delete Task -->
<div class="modal fade" id="delete-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-delete" role="document">
		<div class="modal-content">

			<div class="modal-body">
				<div class="delte-con-pop">
					<i class="bx bx-trash"></i>
					<h5> Are you sure! </h5>
					<p> Are you sure, you wants to delete it ? </p>
					<input type="hidden" id="list_delete">
				</div>
			</div>
			<div class="modal-footer">						
				<button type="button" class="btn btn-danger " data-dismiss="modal">No</button>
				<button type="button" class="btn btn-secondary delete_listing_confirm">Yes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Note</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body task-chat">
			</div>
		</div>
  	</div>
</div>
@endsection
@section('footer_scripts')
		
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&libraries=places"></script>

{{-- <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script> --}}
<script src='{{ asset('js/moment-with-locales.min.js') }}'></script>
<script src='{{ asset('js/fullcalendar.js') }}'></script>
<link rel="stylesheet" href="{{url('/')}}/css/component-chosen.css" />
<script src="{{url('/')}}/js/chosen.jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
<script type="text/javascript">

$( document ).ready(function() {	
	$.validator.addMethod('filesize', function (value, element, param) {
    	return this.optional(element) || (element.files[0].size <= param)
	}, 'File size must be less than {0}');

	$("form[id='upload_files']").validate({
		// Specify validation rules
		ignore: '',
		rules: {
			file_name: {
				required: true,
				extension: "docx|doc|csv|pdf|xls",
				filesize: 4000000
			},
		},
		// Specify validation error messages
		messages: {
			file_name: {
				required: 'File is required',
				extension: 'Please upload xls, csv, doc and pdf files only',
				filesize: "File size must be less than 4MB"
			},   
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.closest(".form-group") );
		},
		submitHandler: function(form) {
			var formData = new FormData($("#upload_files")[0]);
			$('.file_submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
			$.ajax({
					url:'{{url("/")}}/{{getUrl()}}'+'/upload-file',
					type: 'POST',
					processData: false,
					contentType: false,
					data: formData,
					dataType: 'json',
					success:function(result){             
									
					$('.file_submit_btn').html('Save').prop('disabled',false);
						if(result.status == 1){                              
							swal({title: "Success!", text: "File uploaded successfully.", type: "success"});                         								
							$("#files-tab").removeClass('active');									
							$("#files-tab").click();
								
					}else if(result.status == 2){
								swal("File size must be less than 4MB");
								$(".fa-check-circle").hide();
					}else if(result.status == 3){
								swal("This field allows xls, csv, doc and pdf files only ");
								$(".fa-check-circle").hide();
					}else{
						swal({title: "Error", text: "Oops! Something went wrong.", type: "error"});
					}                         
				}
			});
		}
	});
});
$( document ).ready(function() {
	$("form[id='upload_images']").validate({
		// Specify validation rules
		ignore: '',
		rules: {
			file_name: {
				required: true,
				extension: "jpg|jpeg|png",
				filesize: 4000000
			},
		},
		// Specify validation error messages
		messages: {
			file_name: {
				required: 'File is required',
				extension: "Please upload jpg, jpeg, png files only",
				filesize: "File size must be less than 4MB"
			}, 
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.closest(".form-group") );
		},
		submitHandler: function(form) {
			var formData = new FormData($("#upload_images")[0]);
			$('.file_submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
			$.ajax({
					url:'{{url("/")}}/{{getUrl()}}'+'/upload-file',
					type: 'POST',
					processData: false,
					contentType: false,
					data: formData,
					dataType: 'json',
					success:function(result){             							
					$('.file_submit_btn').html('Save').prop('disabled',false);
						if(result.status == 1){                              
							swal({title: "Success!", text: "File uploaded successfully.", type: "success"});                         								
							$("#images-tab").removeClass('active');									
							$("#images-tab").click();
								
					}else if(result.status == 2){
								swal("Image size must be less than 4MB");
								$(".fa-check-circle").hide();
					}else if(result.status == 3){
								swal("This field allows jpg, jpeg, png files only ");
								$(".fa-check-circle").hide();
					}else{
						swal({title: "Error", text: "Oops! Something went wrong.", type: "error"});
					}                         
				}
			});
		}
	});
});

$('.tooltip-r').tooltip();

$(function(){
	$('.multipleSelect1').chosen({
		allow_single_deselect: true,
		width: '100%',
	});
});
function calendarView(){
	jQuery.ajax({									 
			type: 'GET',
			url:'{{url("/")}}'+'/retail/get-calendar',
			beforeSend: function() {
				$(".loader").show();
			},
			success:function(data)
			{             					
				jQuery("#display-calendar").html(data);
				$(".loader").hide();						
			}
	});
}
		
$("#add-meeting-tab").click(function(){
	$("#calendar-tab").removeClass('active');
});
$("#calendar-tab").click(function(){
	$("#add-meeting-tab").removeClass('active');	
});
$("#add-files-tab").click(function(){
	$("#files-tab").removeClass('active');
});
$("#files-tab").click(function(){
	$("#add-files-tab").removeClass('active');	
});
$("#add-images-tab").click(function(){
	$("#images-tab").removeClass('active');
});
$("#images-tab").click(function(){
	$("#add-images-tab").removeClass('active');	
});

jQuery('#datetimepicker').datetimepicker({
	minDate:0, // disable past date	
});
$('#add_meeting').validate({
	ignore: [],
	rules: {
		'invited_to[]':{
			required:true
		},
		title:{
			required:true
		},
		datetime:{
			required:true,
			date:true
		},				
	},
	messages:{
		datetime:{
			date:"Please enter a valid datetime",
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
		if(element.attr("name") == "invited_to[]"){
			error.insertAfter(".collab_type_class");
		}else{
			error.insertAfter(element);
		}
	},
	submitHandler: function(form){
		var formData = new FormData($("#add_meeting")[0]);
		$('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
		$.ajax({
				url:'{{url("/")}}/{{getUrl()}}'+'/add_meeting',
				type: 'POST',
				processData: false,
				contentType: false,
				data: formData,
				dataType: 'json',
				success:function(result)
				{                           
					$('.submit_btn').html('Save').prop('disabled',false);
						if(result.status == 1){                              
							swal({title: "Success!", text: "Meeting created Successfully.", type: "success"});                         
							
							$("#calendar-tab").removeClass('active');													$("#calendar-tab").click();
							// setTimeout(function(){ 
							// 	calendarView();
							//  }, 100);
							
							
					}else if(result.status == 2){
					swal({title: "Error", text: "Please select atleast one user", type: "error"});
					
					}else{
					swal({title: "Error", text: "Oops! Something went wrong. Please try again later", type: "error"});
					
					}                         
			}
		});
	}
});
	
function openTaskModal(taskId){
	jQuery.ajax({				
		data: {'task_id':taskId, "_token": "{{ csrf_token() }}"},       
		type: 'post',
		url:'{{url("/")}}'+'/retail/get-task-note',
		success:function(data)
		{                        
			var res = JSON.parse(data);	  
			$("#taskTId").val(taskId);
			$("#note").val(res.list);						
		}
	});
}

function html_entity_decode(message) {
  return message.replace(/[<>'"]/g, function(m) {
    return '&' + {
      '\'': 'apos',
      '"': 'quot',
      '&': 'amp',
      '<': 'lt',
      '>': 'gt',
    }[m] + ';';
  });
}

// function openNoteModal(taskId){
// 	jQuery.ajax({				
// 		data: {'task_id':taskId, "_token": "{{ csrf_token() }}"},       
// 		type: 'post',
// 		url:'{{url("/")}}'+'/retail/get-task-note',
// 		success:function(data)
// 		{                        
// 			var res = JSON.parse(data);	  
			
// 			if(res.list === null)
// 			jQuery(".displayNote").html('No record found.');
// 			else{
// 				jQuery(".displayNote").html(res.list);
// 			}									
// 		}
// 	});
// }


function openNoteModal(taskId,title){
	jQuery("#exampleModalLongTitle").text(title);

	loadTaskChat(taskId);
	// jQuery.ajax({				
	// 	data: {'task_id':taskId, "_token": "{{ csrf_token() }}"},       
	// 	type: 'post',
	// 	url:'{{url("/")}}'+'/retail/get-task-note',
	// 	success:function(data)
	// 	{          
	// 		$("#chatTaskId").val(taskId);              
	// 		jQuery(".task-chat").html(data);							
	// 	}
	// });
}
function loadTaskChat(taskId){
	jQuery.ajax({				
		data: {'task_id':taskId, "_token": "{{ csrf_token() }}"},       
		type: 'post',
		url:'{{url("/")}}'+'/retail/get-task-note',
		success:function(data)
		{          
			
			$("#chatTaskId").val(taskId);        
			jQuery(".task-chat").html(data);							
		}
	});
}

$(document).on('click', '#add-task-tab', function() {
	$("#task-tab").removeClass('active');
});
$(document).on('click', '#update-task-tab', function() {
	$("#task-tab").removeClass('active');
});
	
jQuery("form[id='addTime']").validate({
	ignore: '',
		rules: {
			note: {
				required: true,
			}				
		},
	messages: {
		
	},
	submitHandler: function(form) {
		var dis = $("#time-form-submit");
		var taskId = jQuery("#taskTId").val();
		var note = jQuery("#note").val();	
		dis.prop('disabled',true);
		jQuery.ajax({				
				data: {'taskId':taskId,'note':note,"_token": "{{ csrf_token() }}"},       
				type: 'post',
				url:'{{url("/")}}'+'/retail/update-note',					
				success:function(result)
				{   						              
					var res = JSON.parse(result);                          
					if(res.status == 1){
						swal({title: "Success", text: "Note updated successfully", type: "success"}
							);
							$("#task-tab").removeClass('active');
							$("#task-tab").click();
							dis.prop('disabled',false);
							$("#exampleModal").modal('hide');
							jQuery("#note").val("");
					}else{
						swal({
							title: "Error!", text: res.message, type: "error"
						});									
						dis.prop('disabled',false);
					}												
				}					
			});
		}

	});
	
	
	//Add member task
$('#add_member_task').validate({
	ignore: [],
	rules: {
		desription: {
			required: true,
		},
		title: {
			required: true,			
		},
		assigned_to:{
			required: true,	
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
		$('.submit_task_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
		var brick_id = jQuery("#brick_id").val();
		var formData = new FormData(form);	
		formData.append("brick_id", brick_id); 
		$.ajax({
			url:"{{ route('retail.member.task.store-update') }}",
			type: 'POST',
			data: formData,
			contentType: false, 
			processData: false,
			success:function(result){
				console.log(result);
				if( result.status ){
					swal({
						title: "Success!", text: result.message, type: "success"
					});
					$("#task-tab").removeClass('active');
					$("#task-tab").click();
				}else{
					swal({
						title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
					});						
				}
			},
			error: function(){
				swal({
					title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
				});						
			}
		});
	}
});

//Start Delete Tasks
$(document).on('click','.delete_listing',function(){
	$('#list_delete').val($(this).attr('data-id'));
});
$(document).on('click','.delete_listing_confirm',function(){
	// $(this).html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
	var dis = this;
	var listing_id = $('#list_delete').val();
	$.ajax({
		url: '{{ route("retail.member.task.delete") }}/' + listing_id,
		dataType: 'json',
		success: function(result) {
			$("#delete-pop").modal('hide');
			if( result.status ){
				swal({
					title: "Success!", text: result.message, type: "success"
				});
				
				$("#task-tab").removeClass('active');
				$("#task-tab").click();
			}else{
				swal({
					title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
				});
				$("#task-tab").click();
			}
		},
		error: function(){
			swal({
				title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
			});
			$("#task-tab").click();
		}
	});
});

function completeTask(taskId){
	swal({
				title: "Are you sure to complete Task",
				text: "",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: '{{url("/")}}'+'/retail/complete-task',
						type: 'POST',
						data: {'task_id':taskId, "_token": "{{ csrf_token() }}"},
						dataType: 'json',
						success: function(result) {
							if(result.status == '1'){
								swal({title: "Success", text: result.message, type: "success"});
								$("#task-tab").removeClass('active');
								$("#task-tab").click();
							}else{
								swal({ title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error" });
								$("#task-tab").click();
							}
						}
					});
				}else {
					swal.close();
				}
			});
}

		//End Delete tasks
$(document).ready(function(){
	$('[name=due_date]').datepicker( {
		format:"Y-m-d",
		minDate:0
	});
	//Add members
	$(".manage-brick-members").on("click",function( event ){
		event.preventDefault();
		var brick_id = $(this).data("brick-id");
		$("#manage-brick-members-popup .modal-body").html('<center><img src="{{url("/")}}/img/loading.gif" height="100" width="100"></center>');
		$("#manage-brick-members-popup").modal("show");
		$.ajax({
			url:'{{url("/")}}/{{getUrl()}}'+'/brick-group-members',
			data:{
				brick_id: brick_id
			},
			success:function(result){
				$("#manage-brick-members-popup .modal-body").html( result );
				$('.multipleSelects').chosen({
					allow_single_deselect: true,
					width: '100%',
				});
				$("#update-brick-members").validate({
					ignore : '',
					submitHandler: function( form ) { 
						$(form).find(".btn-save-stt").find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
						$(form).find(".btn-save-stt").prop('disabled',true);
						var form_data = $(form).serializeArray();
						$.ajax({
							method:'POST',
							data: form_data,
							url: $(form).attr("action"),
							success:function( response ){
								var res = JSON.parse(response);
								if(res.status == 1)   {         
									$("#manage-brick-members-popup").modal("hide");
									swal({title: "Success!", text: "Memebers updated successfully",type:"success"});
									
								}else{
									$("#manage-brick-members-popup").modal("hide");
									swal({title: "Error!", text: "Something went wrong!",type:"error"});

								}											
							},
							error:function(){
								$("#manage-brick-members-popup").modal("hide");
								swal({title: "Error!", text: "Something went wrong!",type:"error"});
							}
						});
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
						if( element.hasClass("multipleSelects") ){
							error.appendTo( element.closest(".form-group") );
						}else{
							error.insertAfter(element);
						}
					}
				});
			}
		});
	});
		//End add members

		
	
	$('#brick-group-tabs a[data-toggle="tab"]').on('shown.bs.tab', function (event) {
		if( event.target.id == "chat-tab" ){
			$("#main-ac")
			var brick_id = jQuery("#brick_id").val();
			load_chat(brick_id);

			var objDiv = document.getElementById("ScrollStyle");
			objDiv.scrollTop = objDiv.scrollHeight;
		
		}
		if( event.target.id == "calendar-tab" ){
			// $(".fc-today-button").click();				
			calendarView();				
		}
		if( event.target.id == "task-tab" ){
			$("#task-tab").click();
			$("#add-task-tab").removeClass('active');
			var brick_id = jQuery("#brick_id").val();
			jQuery.ajax({				
				data: {'brick_id':brick_id,"_token": "{{ csrf_token() }}"},       
				type: 'post',
				url:'{{url("/")}}'+'/retail/get-member-task',
				beforeSend: function() {
					$(".loader").show();
				},
				success:function(data)
				{                        					
					jQuery("#displayMembers").html(data);
					$(".loader").hide();						
				}
			});
		}					
		if( event.target.id == "add-task-tab" ){
			$("#addTask").click();
		}
		if(event.target.id == "files-tab"){
			var brick_id = jQuery("#brick_id").val();
			jQuery.ajax({				
				data: {'brick_id':brick_id, 'type':2, "_token": "{{ csrf_token() }}"},       
				type: 'post',
				url:'{{url("/")}}'+'/retail/get-files',
				beforeSend: function() {
					$(".loader").show();
				},
				success:function(data)
				{                        
					var res = JSON.parse(data);	                   
					jQuery("#group-files").html(res.list);								
					$(".loader").hide();
				}
			});
		}
		if( event.target.id == "images-tab" ){
			var brick_id = jQuery("#brick_id").val();
			jQuery.ajax({				
				data: {'brick_id':brick_id, 'type':1, "_token": "{{ csrf_token() }}"},       
				type: 'post',
				url:'{{url("/")}}'+'/retail/get-files',
				beforeSend: function() {
					$(".loader").show();
				},
				success:function(data)
				{         
					$(".loader").hide();               
					var res = JSON.parse(data);
					jQuery("#group-file-slider").html(res.list);
					$('#group-file-slider .listing-details-image-slides').owlCarousel({
						loop: true,
						nav: true,
						dots: true,
						autoplayHoverPause: true,
						autoplay: true,
						animateOut: 'fadeOut',
						items: 1,
						navText: [
						"<i class='flaticon-left'></i>",
						"<i class='flaticon-right'></i>"
						],
					});
				}
			});
		}
		if( event.target.id == "update-task-tab" ){
			$("#updateTask").click();
		}		
	});
			//New
			
	@if( request()->input('tab_type') == 'chat' )
		$("#chat-tab").click();
	@endif
});
			//New
	function load_chat(brick_id){
		jQuery.ajax({				
			data: {'brick_id':brick_id,"_token": "{{ csrf_token() }}"},       
			type: 'post',
			url:'{{url("/")}}'+'/retail/get-group-chat',
			beforeSend: function() {
				$(".loader").show();
			},
			success:function(data)
			{                        
				jQuery(".group-chat").html(data);
				$(".loader").hide();
				var objDiv = document.getElementById("ScrollStyle");
				objDiv.scrollTop = objDiv.scrollHeight;			
			}
		});
	}
		var lat = '{{$list_details->lat}}',
		lng = '{{$list_details->lng}}';
		$('.showmap').show();
		var myLatlng = new google.maps.LatLng(lat, lng);
		var myOptions = {
			zoom: 8,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: $("#location").val()
		});
		$(document).on('click','.get_list_details_popup',function(){
			var id = $(this).attr('data-id');
			$('#listing-popup').html('<div class="modal-dialog modal-review modal-lg" role="document">   <div class="modal-content contnt-design-new"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel"></h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>  </button> </div>  <div class="modal-body pt-4 pb-4">   <center><img src="{{url("/")}}/img/loading.gif" height="100" width="100"></center> </div></div></div>');
			$.ajax({
				type:'POST',
				url:'{{url("/")}}/{{getUrl()}}'+'/get_listing_details_associated_ajax',
				data:{id:id,_token:'{{ Session::token() }}'},
				success:function(result)
				{
					var obj = $.parseJSON(result);
					$('#listing-popup').html(obj.listing_details);
					$('.listing-details-image-slides').owlCarousel({
						loop: true,
						nav: true,
						dots: false,
						autoplayHoverPause: true,
						autoplay: true,
						animateOut: 'fadeOut',
						items: 1,
						navText: [
						"<i class='flaticon-left'></i>",
						"<i class='flaticon-right'></i>"
						],
					});
				}
			});
		});
		$(document).on('click','#apply_now',function(){
			swal({
				title: "Are you sure you want send booking request?",
				text: "",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: '{{url("/")}}/apply_listing',
						type: 'POST',
						data: {"_token": '{{ Session::token() }}', listing_id : {{$list_details->id}}},
						dataType: 'json',
						success: function(result) {
							if(result.status == '1'){
								swal({title: "Success", text: "Booking Request Sent Successfully!", type: "success"},
									function(){
										$('.apply_nowspan').html(' <a href="javascript:void(0);" class="apply-bew"> Applied </a>');
									}
									);
							}
						}
					});
				}else {
					swal.close();
				}
			});
		});
        	$(document).on('click','.accept_invite',function(){
        		var data_id = $(this).attr('data-id');
        		swal({
        			title: "Are you sure you want accept invitation?",
        			text: "",
        			type: "warning",
        			showCancelButton: true,
        			confirmButtonClass: "btn-danger",
        			confirmButtonText: "Yes",
        			cancelButtonText: "No",
        			closeOnConfirm: true,
        			closeOnCancel: true
        		},
        		function(isConfirm) {
        			if (isConfirm) {
        				$.ajax({
        					url: '{{url("/")}}/accept_reject_invite',
        					type: 'POST',
        					data: {"_token": '{{ Session::token() }}', id : data_id, status:1},
        					dataType: 'json',
        					success: function(result) {
        						if(result.status == '1'){
        							location.reload();
        						}
        					}
        				});
        			}else {
        				swal.close();
        			}
        		}
        		);
        	});
        	$(document).on('click','.reject_invite',function(){
        		var data_id = $(this).attr('data-id');
        		swal({
        			title: "Are you sure you want reject invitation?",
        			text: "",
        			type: "warning",
        			showCancelButton: true,
        			confirmButtonClass: "btn-danger",
        			confirmButtonText: "Yes",
        			cancelButtonText: "No",
        			closeOnConfirm: true,
        			closeOnCancel: true
        		},
        		function(isConfirm) {
        			if (isConfirm) {
        				$.ajax({
        					url: '{{url("/")}}/accept_reject_invite',
        					type: 'POST',
        					data: {"_token": '{{ Session::token() }}', id : data_id, status:2},
        					dataType: 'json',
        					success: function(result) {
        						if(result.status == '1'){
        							location.reload();
        						}
        					}
        				});
        			}else {
        				swal.close();
        			}
        		}
        		);
        	});
        	$(function($) {
        		$('#send_enquiry_msg_form').validate({
        			ignore: [],
        			rules: {
        				subject:
        				{
        					required:true
        				},
        				message:
        				{
        					required:true,
        					maxlength: 500
        				},
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
        					error.insertAfter(element.next('.nice-select'));
        				} else {
        					error.insertAfter(element);
        				}
        			},
        			submitHandler: function(form)
        			{
        				$('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
        				$.ajax({
        					url: '{{url("/")}}/send_message',
        					type: 'POST',
        					data: new FormData(form),
        					contentType: false,
        					cache: false,
        					processData:false,
        					success: function(result) {
        						var obj = $.parseJSON(result);
        						if(obj.status == '1'){
        							$('#exampleModalsendmsg').modal('hide')
        							swal({title: "Success", text: "Message sent Successfully!", type: "success"}
        								);
        						}
        					}
        				});
        }
    });
        	});
	//new
	$(".image").click(function() {
    	$("input[id='my_file']").click();
    });
	
	$(document).on('click', '.send_text_msg_btn', function() {
		sendMsg();
   	});

	function sendMsg(){
		var form_data = new FormData();
		var message = '';
		message = $('.text_message_for_send').val();
		form_data.append("message", message); 
    	var dis = $(".send_text_msg_btn");
		if(message !== ''){
			dis.find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
			dis.prop('disabled',true);
			var sender = dis.attr('sender-id');			
			var brick_id = jQuery("#brick_id").val();
			
			// form_data.append("content", content); 
			form_data.append("sent_by", sender); 
			form_data.append("brick_id", brick_id); 
			// form_data.append("visibility", visibility); 
			form_data.append('_token', '{{ Session::token() }}');
			$.ajax({
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,       
						type: 'post',
						url:'{{url("/")}}'+'/retail/save-group-msg',
						success:function(result)
						{ 
							$('.text_message_for_send').val('');
							var res = JSON.parse(result);                           
							if(res.status == 1){
								load_chat(brick_id);
								// $(".fa-check-circle").hide();
							}
							else if(res.status == 4){
								swal("Please enter a message");
								$(".fa-check-circle").hide();
							}else{
								swal("Something went wrong!");
								$(".fa-check-circle").hide();
							}
							dis.prop('disabled',false);
							dis.find('span').html('Send');						  
				}
			});
		}else{
			swal({title: "", text: "Please enter a message!", type: ""},
        								);
			// swal("Please enter a message");
		}
	}

	$(document).on('click', '.send_task_msg_btn', function() {
		var form_data = new FormData();
		var message = '';
		message = $('.task_message_for_send').val();
		form_data.append("message", message); 
    	var dis = $(".send_text_msg_btn");
		if(message !== ''){
			dis.find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
			dis.prop('disabled',true);
			var sender = dis.attr('sender-id');			
			var task_id = jQuery("#chatTaskId").val();
			form_data.append("sent_by", sender); 
			form_data.append("task_id", task_id); 
			form_data.append('_token', '{{ Session::token() }}');
			$.ajax({
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,       
						type: 'post',
						url:'{{url("/")}}'+'/retail/save-task-msg',
						success:function(result)
						{ 
							$('.task_message_for_send').val('');
							var res = JSON.parse(result);                           
							if(res.status == 1){
								loadTaskChat(task_id);
							}
							else if(res.status == 4){
								swal("Please enter a message");
								$(".fa-check-circle").hide();
							}else{
								swal("Something went wrong!");
								$(".fa-check-circle").hide();
							}
							dis.prop('disabled',false);
							dis.find('span').html('Send');						  
				}
			});
		}else{
			swal({title: "", text: "Please enter a message!", type: ""},
        								);
			// swal("Please enter a message");
		}
	
   	});

	$('#exampleModalLong').on('hidden.bs.modal', function () {
	swal.close();
	})


	//Edit Task 
	$(document).on('click', '#update-task-tab', function() {

		var taskId = jQuery(this).data('id');
		jQuery.ajax({				
			data: {'task_id':taskId,"_token": "{{ csrf_token() }}"},       
			type: 'post',
			url:'{{url("/")}}'+'/retail/get-task-by-id',
			beforeSend: function() {
				$(".loader").show();
			},
			success:function(result)
			{             
				var res = JSON.parse(result);
				if(res.status){
					jQuery("#update_task_id").val(taskId);
					jQuery('#task-title').val(res.data.title);       
					jQuery('#task-description').val(res.data.description);
				}else{
					location.reload();
				}        		
			}
		});
	});
	$('#update_member_task').validate({
	ignore: [],
	rules: {
		title: {
			required: true,			
		},
		description: {
			required: true,			
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
	
	submitHandler: function(form){
		$('.update_task_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
		var brick_id = jQuery("#brick_id").val();
		var formData = new FormData(form);	
		formData.append("brick_id", brick_id); 
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
					});
					$('.update_task_btn').text('Update');
					$('.update_task_btn').prop('disabled',false);
					$("#task-tab").removeClass('active');
					$("#task-tab").click();
				}else{
					swal({
						title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
					});						
				}
			},
			error: function(){
				swal({
					title: "Error!", text: "Oops! Something went wrong. Please try again later", type: "error"
				});						
			}
		});
	}
});
   //Delete messages
   $(document).on("click", '.deleteMsg', function(event) { 
		var form = this;
		var msgId = $(this).attr("data-id");
		swal({
			title: "Your message will be removed permanentaly.",
        	text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: true,
			closeOnCancel: true
		},function(isConfirm) {
	        if (isConfirm) {           
				jQuery.ajax({
	                data: {'msgId':msgId,"_token": "{{ csrf_token() }}"},       
	                type: 'post',
	                url:'{{url("/")}}'+'/retail/delete-msg',
	                success:function(result)
	                {     
						var brick_id = jQuery("#brick_id").val();                          
	                    var res = JSON.parse(result);
	                    if(res.status == 1)   {         
	                    swal({
	                        title: 'Success',
	                        icon: 'success'
	                        });
							load_chat(brick_id);
	                    }else{
	                        swal("Something went wrong");
	                    }
	                }
				});
	        }
        });
	});

   
        </script>
        @stop