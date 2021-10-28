<?php ?>@extends('layouts.app')

@section('content')

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
							<div class="listing-title">
								<h2 class="brs-tra">
									{{$list_details->name}}
									<span class="apply_nowspan">
										@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
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
								<ul>
									<li>
										<i class='bx bx-location-plus'></i>
										<span>Location</span>
										<a href="#">{{$list_details->location_city}}</a>
										<input type="hidden" value="{{$list_details->location_city}}" id="location">
									</li>
									@if($title== 'Brick Details')
									@isset($space_type[0])
									<li>
										<i class='bx bx-area'></i>
										<span>Space Type</span>
										<a href="#">{{$space_type[0]->name}}</a>
									</li>
									@endisset
									<li class="collaboration_class">
										<i class='bx bx-building'></i>
										<span>Collaboration Type</span>
										<a href="#">@if(count($collaboration_cat)>0)
											@foreach($collaboration_cat as $value)
											{{$value->name}}
											@if(!$loop->last)
											,
											@endif
											@endforeach
										@endif</a>
									</li>
									@elseif($title== 'Brand Details')
									<li>
										<i class='bx bx-area'></i>
										<span>Retail Category</span>
										<a href="#">{{$retail_cat->name}}</a>
									</li>
									<li>
										<i class='bx bx-money'></i>
										<span>Price</span>
										<a href="#">${{$list_details->price_from}} - ${{$list_details->price_to}}</a>
									</li>
									@elseif($title== 'Full Space Details')
									<li>
										<i class='bx bx-money'></i>
										<span>Price</span>
										<a href="#"><span class="col-res">@if($list_details->price_from)
											${{$list_details->price_from}}{{$list_details->price_unit}}
											@else Please Contact
											@endif  <span> </a>
											</li>
											<li>
												<i class='bx bx-building'></i>
												<span>Property Type</span>
												<a href="#">{{$propert_type->name}}</a>
											</li>
											@elseif($title== 'Partial Space Details')
											<li>
												<i class='bx bx-money'></i>
												<span>Area</span>
												<a href="#"><span class="col-res"> Please Contact <span> </a>
												</li>
												<li>
													<i class='bx bx-building'></i>
													<span> Type</span>
													<a href="#">{{$list_details->partial_spacetype}}</a>
												</li>
												@elseif($title== 'Popup Store Details')
												<li>
													<i class='bx bx-money'></i>
													<span>Area</span>
													<a href="#">{{$list_details->size}} {{$list_details->size_unit}}</a>
												</li>
												@elseif($title== 'Event Details')
												<li>
													<i class='bx bx-money'></i>
													<span>Space Size</span>
													<a href="#">{{$list_details->size}} {{$list_details->size_unit}}</a>
												</li>
												<li>
													<i class='bx bx-building'></i>
													<span> Fee</span>
													<a href="#">${{$list_details->price_from}} {{$list_details->price_unit}}</a>
												</li>
												@endif
											</ul>
										</div>
									</div>

								</div>
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
								<h3>Description</h3>
								{{$list_details->description}}

								@if($title== 'Event Details')
								@if($list_details->additional_fee)
								<h3>Additonal Fees</h3>
								{{$list_details->additional_fee}}
								@endif
								@endif
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
								@if($title== 'Full Space Details' || $title== 'Partial Space Details' || $title== 'Popup Store Details' || $title== 'Event Details')
								@if(count($amenities_data_cat)>0)
								<h3>Amenities</h3>

								<div class="amenities-list">
									<ul>

										@foreach($amenities_data_cat as $value)
										<li>
											<span>
												<i class='bx bx-check'></i>
												{{$value->name}}
											</span>
										</li>
										@endforeach
									</ul>
								</div>
								@endif
								@endif
								<h3>Location</h3>

								<div class="col-lg-12 col-md-12 showmap" style="display: none;">
									<div id="map_canvas" style="width:100%;height:380px;"></div>
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
										<li> <h4 class="rems-brns"> Brick Members </h4> </li>
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
										<li><span>Collaboration Type :</span> <a>@if(count($collaboration_cat)>0)
											@foreach($collaboration_cat as $value)
											{{$value->name}}
											@if(!$loop->last)
											,
											@endif
											@endforeach
										@endif</a></li>
										@isset($space_type[0])<li><span>Space Type:</span> <a>{{$space_type[0]->name}}</a></li>@endisset
										<li><span>Retail Category:</span> <a>{{$retail_cat->name}}</a></li>
										<li class="conts-sa"> <h4 class="ownr-nsrs"> Owner Details </h4></li>
										<li>
											<a href="{{url('/view-profile')}}/{{$listing_owner->id}}" class="nav-link  desn-slts">
												<img src="{{!empty($listing_owner->image) ? url('/uploads/user/').'/'.$listing_owner->image : url('/').'/img/user.png'}}" class="img-usrea"><h4> {{$listing_owner->name}} {{$listing_owner->last_name}}
												</h4> </a>
												@if($listing_owner->company_icon)
												<a href="{{$listing_owner->website}}" class="nav-link  desn-slts">
													<img src="{{!empty($listing_owner->company_icon) ? url('/uploads/user/').'/'.$listing_owner->company_icon : url('/').'/img/user.png'}}" class="img-usrea"></a>
													@endif
													@if($listing_owner->business_number)
													<a href="tel:{{$listing_owner->business_number}}" class="send-imsy-b">
														<i class="fa fa-phone"></i> {{$listing_owner->business_number}} </a>
														@endif
														<a href="mailto:{{$listing_owner->email}}" class="send-imsy-b">
															<i class="bx bx-envelope"></i> {{$listing_owner->email}} </a>
															<p>{{$listing_owner->company_address}}</p>
															@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
															<a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalsendmsg" class="send-imsy-b"><i class="bx bx-envelope"></i> Contact Us </a>
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
															<div class="listing-contact-info"><ul class="bg-othsr memberslist brde-n">
																<li>
																	<img src="{{$external_link}}" class="rounded-circle"/>
																	<h2>
																		<span class="loca">{{$external_title}}</span>
																	</h2>

																</li></ul></div></div>
															</div>
														</a>
													</div>
												</div>
												<div>
												</div>
												@elseif($title== 'Brand Details')
												<div class="col-lg-4 col-md-12">
													<div class="listing-sidebar-widget">
														<div class="listing-contact-info">
															<h3>Associated Bricks </h3>
															@if(count($bricks_details)>0)
															@foreach($bricks_details as $key)
															<div class="single-listing-item brick-strs">
																<div class="listing-image">
																	<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block get_list_details_popup" data-id="{{$key->id}}"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image">
																	</a>
																	<div class="listing-tag">
																		<a href="#" class="d-block"><b> ID: </b>#{{$key->id}}</a>
																	</div>
																</div>
																<div class="listing-content">
																	<h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block get_list_details_popup" data-id="{{$key->id}}">{{$key->name}}</a></h3>
																	<p class="mt-2">{{Getdesc($key->description,200,1)}}</p>
																</div>
																<div class="listing-box-footer br-st-a ptb-10 tsts-sla">
																	<span class="add-bt"> <b> Listed By: </b> {{$key->fname}} {{$key->lname}}
																		<span>
																			<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" data-id="{{$key->id}}" class="bts-aea get_list_details_popup"> View Details </a>
																		</span>
																	</span>
																</div>
															</div>
															@endforeach
															@else
															<p class="bricks"> <b> No Data Found. </b> </p>
															@endif
														</div>
														<div class="listing-contact-info">
															<h3>Social Media Links</h3>
															<ul class="bg-othsr socialmedia">
																@if($list_details->fblink || $list_details->twitterlink || $list_details->instalink)
																@if($list_details->fblink)
																<li><a class="facebook" href="{{$list_details->fblink}}"><i class='bx bxl-facebook'></i> Facebook</a></li>
																@endif
																@if($list_details->twitterlink)
																<li><a class="twitter" href="{{$list_details->twitterlink}}"><i class='bx bxl-twitter'></i> Twitter</a></li>
																@endif
																@if($list_details->instalink)
																<li><a class="instagram" href="{{$list_details->instalink}}"><i class='bx bxl-instagram'></i>  Instagram</a></li>
																@endif
																@else
																<p class="bricks"> <b> No Data Found. </b> </p>
																@endif

															</ul>
														</div>
														<div class="listing-contact-info">
															<h3>Additional Details</h3>
															<ul class="bg-othsr">
																<li><span>Looking For :</span> <a>@if(count($collaboration_cat)>0)
																	@foreach($collaboration_cat as $value)
																	{{$value->name}}
																	@if(!$loop->last)
																	,
																	@endif
																	@endforeach
																@endif</a></li>
																<li><span>Open To Collaborations:</span> <a>@if($list_details->open_to_collaborations == 1)Yes @else No @endif</a></li>
																<li><span>Retail Category:</span> <a> {{$retail_cat->name}} </a></li>
																<li class="conts-sa"> <h4 class="ownr-nsrs"> Owner Details </h4></li>
																<li>
																	<a href="{{url('/view-profile')}}/{{$listing_owner->id}}" class="nav-link desn-slts">
																		<img src="{{!empty($listing_owner->image) ? url('/uploads/user/').'/'.$listing_owner->image : url('/').'/img/user.png'}}" class="img-usrea"><h4> {{$listing_owner->name}} {{$listing_owner->last_name}}
																		</h4></a>
																		@if($listing_owner->company_icon)
																		<a href="{{$listing_owner->website}}" class="nav-link  desn-slts">
																			<img src="{{!empty($listing_owner->company_icon) ? url('/uploads/user/').'/'.$listing_owner->company_icon : url('/').'/img/user.png'}}" class="img-usrea"></a>
																			@endif
																			@if($listing_owner->business_number)
																			<a href="tel:{{$listing_owner->business_number}}" class="send-imsy-b">
																				<i class="fa fa-phone"></i> {{$listing_owner->business_number}} </a>
																				@endif
																				<a href="mailto:{{$listing_owner->email}}" class="send-imsy-b">
																					<i class="bx bx-envelope"></i> {{$listing_owner->email}} </a>
																					<p>{{$listing_owner->company_address}}</p>
																					@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
																					<a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalsendmsg" class="send-imsy-b"><i class="bx bx-envelope"></i> Contact Us </a>
																					@elseif(!empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
																					<a href="javascript:void(0);" class="apply-bew"> Applied </a>
																					@endif
																				</li>

																			</ul>
																		</div>


																	</div>
																</div>
																@elseif($title== 'Full Space Details')
																<div class="col-lg-4 col-md-12">
																	<div class="listing-sidebar-widget">

																		<div class="listing-widget filter-list-widget widtbgs bg-str">
																			<h3 class="listing-widget-title">Create Brick</h3>
																			<a href="{{ url('/') }}/{{getUrl()}}/add-brick?id={{$list_details->id}}" class="create-br" target="_blank"><i class="bx bx-plus"></i> Create a Brick </a>
																		</div>


                        <div class="listing-contact-info">
                        	<h3>Additional Details</h3>
                        	<ul class="bg-othsr">
                        		@if($list_details->floors)<li><span>Total Floors:</span> <a>{{$list_details->floors}} Floors</a></li> @endif
                        		@if($list_details->floor_no)
                        		<li><span>Floor  Number:</span> <a>{{$list_details->floor_no}}<sup>{{ordinal($list_details->floor_no)}}</sup> Floor</a></li>@endif
                        		<li><span>Size:</span> <a> {{$list_details->size}} {{$list_details->size_unit}} </a></li>
                        		@if($list_details->price_from)
                        		<li><span>Lease Price:</span> <a> ${{$list_details->price_from}}{{$list_details->price_unit}} </a></li>
                        		@endif
                        		<li><span>Lease Term:</span> <a> {{$list_details->lease_term}} Years</a></li>
                        		<li><span>Tenant Share Type:</span> <a> {{$list_details->lease_type}} </a></li>
                        		<li><span>Max Renters:</span> <a> {{$list_details->max_renters}} </a></li>
                        		<li><span>Ideal Uses:</span> <a> @if(count($ideal_uses_cat)>0)
                        			@foreach($ideal_uses_cat as $value)
                        			{{$value->name}}
                        			@if(!$loop->last)
                        			,
                        			@endif
                        			@endforeach
                        		@endif </a></li>
                        		<li><span>Availability Date:</span> <a> {{showDateFormatreturn($list_details->availability_date)}} </a></li>
                        		<li class="conts-sa"> <h4 class="ownr-nsrs"> Owner Details </h4></li>
                        		<li>
                        			<a href="{{url('/view-profile')}}/{{$listing_owner->id}}" class="nav-link desn-slts">
                        				<img src="{{!empty($listing_owner->image) ? url('/uploads/user/').'/'.$listing_owner->image : url('/').'/img/user.png'}}" class="img-usrea"><h4>  {{$listing_owner->name}} {{$listing_owner->last_name}}
                        				</h4> </a>
                        				@if($listing_owner->company_icon)
                        				<a href="{{$listing_owner->website}}" class="nav-link  desn-slts">
                        					<img src="{{!empty($listing_owner->company_icon) ? url('/uploads/user/').'/'.$listing_owner->company_icon : url('/').'/img/user.png'}}" class="img-usrea"></a>
                        					@endif
                        					@if($listing_owner->business_number)
                        					<a href="tel:{{$listing_owner->business_number}}" class="send-imsy-b">
                        						<i class="fa fa-phone"></i> {{$listing_owner->business_number}} </a>
                        						@endif
                        						<a href="mailto:{{$listing_owner->email}}" class="send-imsy-b">
                        							<i class="bx bx-envelope"></i> {{$listing_owner->email}} </a>
                        							<p>{{$listing_owner->company_address}}</p>
                        							@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                        							<a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalsendmsg" class="send-imsy-b"><i class="bx bx-envelope"></i> Contact Us </a>
                        							@elseif(!empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                        							<a href="javascript:void(0);" class="apply-bew"> Applied </a>
                        							@endif
                        						</li>

                        					</ul>
                        				</div>

                            <!-- <div class="listing-contact dtas">
                                <div class="text">
                                    <div class="icon">
                                        <i class='bx bx-phone-call'></i>
                                    </div>
                                    <span>Email Text to Landlord</span>
                                    <a href="#">{{$list_details->email_listing_owner}}</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    @elseif($title== 'Partial Space Details')
                    <div class="col-lg-4 col-md-12">
                    	<div class="listing-sidebar-widget">

                    		<div class="listing-widget filter-list-widget widtbgs bg-str">
                    			<h3 class="listing-widget-title">Create  Brick</h3>
                    			<a href="{{ url('/') }}/{{getUrl()}}/add-brick?id={{$list_details->id}}" target="_blank" class="create-br"><i class="bx bx-plus"></i> Create a Brick </a>
                    		</div>

                    		<div class="listing-contact-info">
                    			<h3>Associated Bricks </h3>
                    			@if(count($bricks_details)>0)
                    			@foreach($bricks_details as $key)
                    			<div class="single-listing-item brick-strs">
                    				<div class="listing-image">
                    					<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block get_list_details_popup" data-id="{{$key->id}}"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image">
                    					</a>
                    					<div class="listing-tag">
                    						<a href="#" class="d-block"><b> ID: </b>#{{$key->id}}</a>
                    					</div>
                    				</div>
                    				<div class="listing-content">
                    					<h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block get_list_details_popup" data-id="{{$key->id}}">{{$key->name}}</a></h3>
                    					<p class="mt-2">{{Getdesc($key->description,200,1)}}</p>
                    				</div>
                    				<div class="listing-box-footer br-st-a ptb-10 tsts-sla">
                    					<span class="add-bt"> <b> Listed By: </b> {{$key->fname}} {{$key->lname}}
                    						<span>
                    							<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" data-id="{{$key->id}}" class="bts-aea get_list_details_popup"> View Details </a>
                    						</span>
                    					</span>
                    				</div>
                    			</div>
                    			@endforeach
                    			@else
                    			<p class="bricks"> <b> No Data Found. </b> </p>
                    			@endif
                    		</div>

                    		<div class="listing-contact-info">
                    			<h3>Additional Details</h3>
                    			<ul class="bg-othsr">
                    				@if($list_details->floors)
                    				<li><span>Total Floors:</span> <a>{{$list_details->floors}} Floors</a></li>
                    				@endif
                    				@if($list_details->floor_no)
                    				<li><span>Floor  Number:</span> <a>{{$list_details->floor_no}}<sup>{{ordinal($list_details->floor_no)}}</sup> Floor</a></li>
                    				@endif
                    				<li><span>Lease Term:</span> <a> {{$list_details->lease_term}}{{$list_details->lease_term_unit}}</a></li>
                    				@if($list_details->lease_type)
                    				<li><span>Tenant Rent Type:</span> <a> {{$list_details->lease_type}} </a></li>
                    				@endif
                    				<li><span>Availability Date:</span> <a> {{showDateFormatreturn($list_details->availability_date)}} </a></li>
                    				<li><span>Current Use:</span> <a> {{$category_data->name}} </a></li>
                    				<li class="conts-sa"> <h4 class="ownr-nsrs"> Owner Details </h4></li>
                    				<li>
                    					<a href="{{url('/view-profile')}}/{{$listing_owner->id}}" class="nav-link desn-slts">
                    						<img src="{{!empty($listing_owner->image) ? url('/uploads/user/').'/'.$listing_owner->image : url('/').'/img/user.png'}}" class="img-usrea"><h4> {{$listing_owner->name}} {{$listing_owner->last_name}}
                    						</h4></a>
                    						@if($listing_owner->company_icon)
                    						<a href="{{$listing_owner->website}}" class="nav-link  desn-slts">
                    							<img src="{{!empty($listing_owner->company_icon) ? url('/uploads/user/').'/'.$listing_owner->company_icon : url('/').'/img/user.png'}}" class="img-usrea"></a>
                    							@endif
                    							@if($listing_owner->business_number)
                    							<a href="tel:{{$listing_owner->business_number}}" class="send-imsy-b">
                    								<i class="fa fa-phone"></i> {{$listing_owner->business_number}} </a>
                    								@endif
                    								<a href="mailto:{{$listing_owner->email}}" class="send-imsy-b">
                    									<i class="bx bx-envelope"></i> {{$listing_owner->email}} </a>
                    									<p>{{$listing_owner->company_address}}</p>
                    									@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                    									<a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalsendmsg" class="send-imsy-b"><i class="bx bx-envelope"></i> Contact Us </a>
                    									@elseif(!empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                    									<a href="javascript:void(0);" class="apply-bew"> Applied </a>
                    									@endif
                    								</li>

                    							</ul>
                    						</div>

                           <!--  <div class="listing-contact dtas">
                                <div class="text">
                                    <div class="icon">
                                        <i class='bx bx-phone-call'></i>
                                    </div>
                                    <span>Email Text to Landlord</span>
                                    <a href="#">{{$list_details->email_listing_owner}}</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    @elseif($title== 'Popup Store Details')
                    <div class="col-lg-4 col-md-12">
                    	<div class="listing-sidebar-widget">

                    		<div class="listing-widget filter-list-widget widtbgs bg-str">
                    			<h3 class="listing-widget-title">Create  Brick</h3>
                    			<a href="{{ url('/') }}/{{getUrl()}}/add-brick?id={{$list_details->id}}" target="_blank" class="create-br"><i class="bx bx-plus"></i> Create a Brick </a>
                    		</div>

                    		<div class="listing-contact-info">
                    			<h3>Associated Bricks </h3>
                    			@if(count($bricks_details)>0)
                    			@foreach($bricks_details as $key)
                    			<div class="single-listing-item brick-strs">
                    				<div class="listing-image">
                    					<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block get_list_details_popup" data-id="{{$key->id}}"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image">
                    					</a>
                    					<div class="listing-tag">
                    						<a href="#" class="d-block"><b> ID: </b>#{{$key->id}}</a>
                    					</div>
                    				</div>
                    				<div class="listing-content">
                    					<h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block get_list_details_popup" data-id="{{$key->id}}">{{$key->name}}</a></h3>
                    					<p class="mt-2">{{Getdesc($key->description,200,1)}}</p>
                    				</div>
                    				<div class="listing-box-footer br-st-a ptb-10 tsts-sla">
                    					<span class="add-bt"> <b> Listed By: </b> {{$key->fname}} {{$key->lname}}
                    						<span>
                    							<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" data-id="{{$key->id}}" class="bts-aea get_list_details_popup"> View Details </a>
                    						</span>
                    					</span>
                    				</div>
                    			</div>
                    			@endforeach
                    			@else
                    			<p class="bricks"> <b> No Data Found. </b> </p>
                    			@endif
                    		</div>

                    		<div class="listing-contact-info">
                    			<h3>Additional Details</h3>
                    			<ul class="bg-othsr">
                    				@if($list_details->floor_no)
                    				<li><span>Floor  Number:</span> <a>{{$list_details->floor_no}}<sup>{{ordinal($list_details->floor_no)}}</sup> Floor</a></li>
                    				@endif
                    				@if($list_details->daily_rate)
                    				<li><span>Daily Rate:</span> <a> ${{$list_details->daily_rate}}</a></li>
                    				@endif
                    				@if($list_details->weekly_rate)
                    				<li><span>Weekly Rate:</span> <a> ${{$list_details->weekly_rate}}</a></li>
                    				@endif
                    				@if($list_details->monthly_rate)
                    				<li><span>Monthly Rate:</span> <a> ${{$list_details->monthly_rate}}</a></li>
                    				@endif
                    				@if($list_details->min_rental)
                    				<li><span>Minimum Rental:</span> <a> {{$list_details->min_rental}} {{$list_details->min_rental_unit}} </a></li>
                    				@endif
                    				@if($list_details->max_rental)
                    				<li><span>Max Rental:</span> <a> {{$list_details->max_rental}} {{$list_details->max_rental_unit}}</a></li>
                    				@endif
                    				<li><span>Ideal Uses:</span> <a> @if(count($ideal_uses_cat)>0)
                    					@foreach($ideal_uses_cat as $value)
                    					{{$value->name}}
                    					@if(!$loop->last)
                    					,
                    					@endif
                    					@endforeach
                    				@endif </a></li>
                    				<li><span>Availability Date:</span> <a> {{showDateFormatreturn($list_details->availability_date)}} </a></li>
                    				<li class="conts-sa"> <h4 class="ownr-nsrs"> Owner Details </h4></li>
                    				<li>
                    					<a href="{{url('/view-profile')}}/{{$listing_owner->id}}" class="nav-link desn-slts">
                    						<img src="{{!empty($listing_owner->image) ? url('/uploads/user/').'/'.$listing_owner->image : url('/').'/img/user.png'}}" class="img-usrea">
                    						<h4> {{$listing_owner->name}} {{$listing_owner->last_name}} </h4>
                    					</a>
                    					@if($listing_owner->company_icon)
                    					<a href="{{$listing_owner->website}}" class="nav-link  desn-slts">
                    						<img src="{{!empty($listing_owner->company_icon) ? url('/uploads/user/').'/'.$listing_owner->company_icon : url('/').'/img/user.png'}}" class="img-usrea"></a>
                    						@endif
                    						@if($listing_owner->business_number)
                    						<a href="tel:{{$listing_owner->business_number}}" class="send-imsy-b">
                    							<i class="fa fa-phone"></i> {{$listing_owner->business_number}} </a>
                    							@endif
                    							<a href="mailto:{{$listing_owner->email}}" class="send-imsy-b">
                    								<i class="bx bx-envelope"></i> {{$listing_owner->email}} </a>
                    								<p>{{$listing_owner->company_address}}</p>
                    								@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                    								<a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalsendmsg" class="send-imsy-b"><i class="bx bx-envelope"></i> Contact Us </a>
                    								@elseif(!empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                    								<a href="javascript:void(0);" class="apply-bew"> Applied </a>
                    								@endif
                    							</li>

                    						</ul>
                    					</div>

                            <!-- <div class="listing-contact dtas">
                                <div class="text">
                                    <div class="icon">
                                        <i class='bx bx-phone-call'></i>
                                    </div>
                                    <span>Email Text to Landlord</span>
                                    <a href="#">{{$list_details->email_listing_owner}}</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    @elseif($title== 'Event Details')
                    <div class="col-lg-4 col-md-12">
                    	<div class="listing-sidebar-widget">

                    		<div class="listing-widget filter-list-widget widtbgs bg-str">
                    			<h3 class="listing-widget-title">Create  Brick</h3>
                    			<a href="{{ url('/') }}/{{getUrl()}}/add-brick?id={{$list_details->id}}" target="_blank" class="create-br"><i class="bx bx-plus"></i> Create a Brick </a>
                    		</div>

                    		<div class="listing-contact-info">
                    			<h3>Associated Bricks </h3>
                    			@if(count($bricks_details)>0)
                    			@foreach($bricks_details as $key)
                    			<div class="single-listing-item brick-strs">
                    				<div class="listing-image">
                    					<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block get_list_details_popup" data-id="{{$key->id}}"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image">
                    					</a>
                    					<div class="listing-tag">
                    						<a href="#" class="d-block"><b> ID: </b>#{{$key->id}}</a>
                    					</div>
                    				</div>
                    				<div class="listing-content">
                    					<h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block get_list_details_popup" data-id="{{$key->id}}">{{$key->name}}</a></h3>
                    					<p class="mt-2">{{Getdesc($key->description,200,1)}}</p>
                    				</div>
                    				<div class="listing-box-footer br-st-a ptb-10 tsts-sla">
                    					<span class="add-bt"> <b> Listed By: </b> {{$key->fname}} {{$key->lname}}
                    						<span>
                    							<a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" data-id="{{$key->id}}" class="bts-aea get_list_details_popup"> View Details </a>
                    						</span>
                    					</span>
                    				</div>
                    			</div>
                    			@endforeach
                    			@else
                    			<p class="bricks"> <b> No Data Found. </b> </p>
                    			@endif
                    		</div>
                    		<div class="listing-contact-info">
                    			<h3>Additional Details</h3>
                    			<ul class="bg-othsr">
                    				<li><span>Start Date & Time :</span> <a>{{showDateFormat($list_details->start_date_time)}}</a></li>
                    				<li><span>End Date & Time  :</span> <a> {{showDateFormat($list_details->end_date_time)}}</a></li>
                    				<li class="conts-sa"> <h4 class="ownr-nsrs"> Owner Details </h4></li>
                    				<li>
                    					<a href="{{url('/view-profile')}}/{{$listing_owner->id}}" class="nav-link desn-slts">
                    						<img src="{{!empty($listing_owner->image) ? url('/uploads/user/').'/'.$listing_owner->image : url('/').'/img/user.png'}}" class="img-usrea"> <h4>  {{$listing_owner->name}} {{$listing_owner->last_name}} </h4>
                    					</a>
                    					@if($listing_owner->company_icon)
                    					<a href="{{$listing_owner->website}}" class="nav-link  desn-slts">
                    						<img src="{{!empty($listing_owner->company_icon) ? url('/uploads/user/').'/'.$listing_owner->company_icon : url('/').'/img/user.png'}}" class="img-usrea"></a>
                    						@endif
                    						@if($listing_owner->business_number)

                    						<a href="tel:{{$listing_owner->business_number}}" class="send-imsy-b">
                    							<i class="fa fa-phone"></i> {{$listing_owner->business_number}} </a>
                    							@endif
                    							<a href="mailto:{{$listing_owner->email}}" class="send-imsy-b">
                    								<i class="bx bx-envelope"></i> {{$listing_owner->email}} </a>
                    								<p>{{$listing_owner->company_address}}</p>
                    								@if(Auth::check() && $list_details->user_id!=Auth::User()->id && empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                    								<a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalsendmsg" class="send-imsy-b"><i class="bx bx-envelope"></i> Contact Us </a>
                    								@elseif(!empty($isapplied) && $list_details->type != 1 && $list_details->type != 2)
                    								<a href="javascript:void(0);" class="apply-bew"> Applied </a>
                    								@endif
                    							</li>

                    						</ul>
                    					</div>

                            <!-- <div class="listing-contact dtas">
                                <div class="text">
                                    <div class="icon">
                                        <i class='bx bx-phone-call'></i>
                                    </div>
                                    <span>Email Text to Landlord</span>
                                    <a href="#">{{$list_details->email_listing_owner}}</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    @endif
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

        @endsection
        @section('footer_scripts')
		
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&libraries=places"></script>

        
        <script type="text/javascript">
		
		
        	
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
        							swal({title: "Success", text: "Message sent Successfully!", type: "success"},
        								);
        						}
        					}
        				});
        }
    });
        	});
	
	
        </script>
        @stop