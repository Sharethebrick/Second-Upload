@extends('layouts.app')

@section('content')
<style type="text/css">
.fontsizepara{
	font-size: 14px;
}
</style>
<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3">
	<div class="container">
		<div class="page-title-content">
			<h2>{{$title}}</h2>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Checkout Area -->
<section class="login-area ptb-100">
	<div class="container">
		<div class="row">
			@if($title == 'User Bricks')
			<div class="col-md-12">
				<div class="listings-alls">
					<div class="billing-details">
						<h3 class="title font-strs font-sma">User Bricks    <a href="{{url('/')}}/{{getUrl()}}/add-brick" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> </h3>
					</div>
					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
					<div class="row searched_data">
						@if(count($bricks)>0)
						@foreach($bricks as $key)
						
						<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item{{$key->id}}">
							<div class="single-listing-item new-stl-lyt">
								<div class="row">
									<div class="col-md-4">
										<div class="listing-image">
											<a href="{{url('/')}}/{{getUrl()}}/brickdetails/{{$key->id}}" class="d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>

											<div class="listing-tag">
												<a href="{{url('/')}}/{{getUrl()}}/brickdetails/{{$key->id}}" class="d-block">{{$key->no_of_openings}} Openings</a>
											</div>
										</div>
									</div>
									<div class="col-md-8">
										<div class="listing-content pl-0">
											<div class="left-content"><strong>#{{$key->id}}</strong></br><h3><a href="{{url('/')}}/{{getUrl()}}/brickdetails/{{$key->id}}" class="d-inline-block">{{$key->name}}</a></h3>
											<p class="mt-2 mb-2 fontsizepara">{{Getdesc($key->description,200,1)}}</p></div>

                                    <div class="right-content">
											<span>Relationship:{{$key->user_id == Auth::user()->id ? 'Owner' : 'Member' }}</span>
											<span>Published To:Retail Edition</span></div>
											
											<div class="d-flex align-items-center justify-content-between">
												<div class="price">
                                                        <!-- <b data-toggle="tooltip" data-placement="top">
                                                            ${{$key->price_from}} - ${{$key->price_to}}
                                                        </b> -->
                                                    </div>
                                                    <!-- <span class="location"><i class="bx bx-map"></i> {{$key->location_city}}</span> -->
                                                </div>
                                            </div>
                                            <div class="listing-box-footer br-st-a">
												<a href="{{url('/')}}/{{getUrl()}}/brickdetails/{{$key->id}}" class="view-ayr"> <i class="fa fa-eye" title="View Brick Detail"></i> </a>
												@if($key->user_id == Auth::user()->id)
                                            		<a href="{{url('/')}}/{{getUrl()}}/edit-brick/{{$key->id}}" class="edit-ayr"> 	<i class="bx bx-pencil" title="Edit Brick"></i> </a>
                                            		<a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash" title="Delete Brick"></i> </a>
													@if(in_array(Auth::user()->id, get_brick_members($key->id)) || $key->user_id == Auth::user()->id) 
													<a target="_blank" href="{{url('/')}}/{{getUrl()}}/messages/{{$key->id}}" class="msg-ayr"> <i class="bx bx-chat" title="Messages"></i> </a>
													@endif
                                            		<!-- Manage members -->
													@if( $key->user_id == Auth::user()->id )
													<a href="#"  class="view-ayr manage-brick-members" data-brick-id="{{ $key->id }}"> <i class="fa fa-users" title="Add/Remove Brick Members" aria-hidden="true"></i> </a>
													
													@endif
												@endif
												<a href="{{url('/')}}/{{getUrl()}}/brickdetails/{{$key->id}}?tab_type=chat"  class=" btn btn-warning btn-m" data-brick-id="{{ $key->id }}"> Group Chat<br> &<br> Work Area </a>

                                            	<!-- @if($key->lease_term)
                                            	<span class="tcts-yt"> <i class="bx bx-calendar"></i> {{$key->lease_term}} {{$key->lease_term_unit}} </span>
                                            	@endif -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-lg-12 col-sm-12 col-md-6">
                            	<div class="single-listing-item new-stl-lyt">
                            		<center><h4>  No Data Found.</h4></center>
                            	</div>
                            </div>
                            @endif


                        </div>
                        <div class="row">
                        	<div class="col-lg-12 col-md-12">
                        		<a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $bricks_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$bricks_count}}">Load More</a>
                        	</div>
                        </div>

                    </div>
                </div>
                @elseif($title == 'User Brands')
                <div class="col-md-12">
                	<div class="listings-alls">
                		<div class="billing-details">
                			<h3 class="title font-strs font-sma">User Brands    <a href="{{url('/')}}/{{getUrl()}}/add-brand" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> </h3>
                		</div>
                		<div class="row">
                			<div class="col-md-12">
                				<div class="main-search-wrap fll-s-st">
                					<form id="search_listing">
                						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                						<div class="row">
                							<div class="col">
                								<div class="form-group">
                									<input type="text" placeholder="Keyword..." name="keyword">
                								</div>
                							</div>
                							<div class="col">

                								<div class="form-group">
                									<label><a href="#"><i class="bx bx-current-location"></i></a></label>
                									<input type="text" name="location" placeholder="Location" class="pl-28">
                								</div>
                							</div>
                							<input type="hidden" name="type" value="1">
                							<div class="col">
                								<div class="form-group name-dlauc mn-sht">
                									<select id="collaboration_type" name="collaboration_type[]" multiple data-placeholder="Collaboration Type">
                										<option value="-1">All</option>
                										@foreach($collaboration_types as $key)
                										<option value="{{$key->id}}">{{$key->name}} </option>
                										@endforeach
                									</select>
                								</div>
                							</div>
                							<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                							<div class="col">
                								<div class="form-group name-dlauc mn-sht">
                									<select id="people" name="retail_category[]" multiple data-placeholder="Brand Retail Category">
                										<option value="-1">All</option>
                										@foreach($retail_categories as $key)
                										<option value="{{$key->id}}">{{$key->name}} </option>
                										@endforeach
                									</select>
                								</div>
                							</div>
                							<div class="col flr-rng pl-0">
                								<div class="form-group price-list-widget prics ">
                									<label class="lb-ls">Price Range</label>
                									<div class="collection-filter-by-price">
                										<input class="range_input" type="text" data-min="50" data-max="1000">
                										<input type="hidden" name="from_range" value="50" id="from_range">
                										<input type="hidden" name="to_range" value="1000" id="to_range">
                									</div>
                								</div>
                							</div>
                							<div class="col">
                								<div class="form-group">
                									<select name="Sort_by" class="form-control">
                										<option value="">Sort by</option>
                										<option value="">Recommended</option>
                										<option value="">City A Z</option>
                										<option value="">City Z A</option>
                										<option value="newest">Newest</option>
                										<option value="oldest">Oldest</option>
                										<option value="price_lowtohigh">Price Low to High</option>
                										<option value="price_hightolow">Price High to Low</option>
                									</select>
                								</div>
                							</div>
                						</div>

                						<div class="main-search-btn">
                							<button type="submit" class="search_submit">Search <i class='bx bx-search-alt'></i></button>
                						</div>
                					</form>
                				</div>
                			</div>
                		</div>
                		<div class="row searched_data">
                			@if(count($brands)>0)
                			@foreach($brands as $key)
                			<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item{{$key->id}}">
                				<div class="single-listing-item new-stl-lyt">
                					<div class="row">
                						<div class="col-md-4">
                							<div class="listing-image">
                								<a href="{{url('/')}}/{{getUrl()}}/branddetails/{{$key->id}}" class="d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>
                								@if($key->open_to_collaborations == 1)
                								<div class="listing-tag">
                									<a href="{{url('/')}}/{{getUrl()}}/branddetails/{{$key->id}}" class="d-block">
                										@if(count($key->collaboration_cat)>0)
                										@foreach($key->collaboration_cat as $value)
                										{{$value->name}}
                										@if(!$loop->last)
                										,
                										@endif
                										@endforeach
                										@endif
                									</a>
                								</div>
                								@endif
                							</div>
                						</div>
                						<div class="col-md-8">
                							<div class="listing-content pl-0">
                								<h3><a href="{{url('/')}}/{{getUrl()}}/branddetails/{{$key->id}}" class="d-inline-block">{{$key->name}}</a></h3>
                								<p class="mt-2 mb-2 fontsizepara">{{Getdesc($key->description,200,1)}}</p>
                								<div class="d-flex align-items-center justify-content-between">
                									<div class="price">
                										<b data-toggle="tooltip" data-placement="top">
                											${{$key->price_from}} - ${{$key->price_to}}
                										</b>
                									</div>
                									<span class="location"><i class="bx bx-map"></i> {{$key->location_city}}</span>
                								</div>
                							</div>
                							<div class="listing-box-footer br-st-a">
                								<a href="{{url('/')}}/{{getUrl()}}/branddetails/{{$key->id}}" class="view-ayr"> <i class="fa fa-eye"></i> </a>
                								<a href="{{url('/')}}/{{getUrl()}}/edit-brand/{{$key->id}}" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
                								<a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a>
                								<span class="tcts-yt"> <i class="bx bx-tags"></i> Category: {{$key->category_name}} </span>
                							</div>
                						</div>
                					</div>

                				</div>
                				@if($loop->last)
                                        <!--  <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="pagination-area text-center bg-grs">
                                                    <a href="#" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                                                    <span class="page-numbers current" aria-current="page">1</span>
                                                    <a href="#" class="page-numbers">2</a>
                                                    <a href="#" class="page-numbers">3</a>
                                                    <a href="#" class="page-numbers">4</a>
                                                    <a href="#" class="page-numbers">5</a>
                                                    <a href="#" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div> -->
                                        @endif
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                    	<div class="single-listing-item new-stl-lyt">
                                    		<center><h4>  No Data Found.</h4></center>
                                    	</div>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                	<div class="col-lg-12 col-md-12">
                                		<a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $brands_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$brands_count}}">Load More</a>
                                	</div>
                                </div>

                            </div>
                        </div>
                        @elseif($title == 'User Full Space Listings')
                        <div class="col-md-12">
                        	<div class="listings-alls">
                        		<div class="billing-details">
                        			<h3 class="title font-strs font-sma">Full Space Listings    <a href="{{url('/')}}/{{getUrl()}}/add-full-space-landlord" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> </h3>
                        		</div>
                        		<div class="row">
                        			<div class="col-md-12">
                        				<div class="main-search-wrap fll-s-st">
                        					<form id="search_listing">
                        						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        						<div class="row">
                        							<div class="col">
                        								<div class="form-group">
                        									<input type="text" placeholder="Keyword..." name="keyword">
                        								</div>
                        							</div>
                        							<div class="col">

                        								<div class="form-group">
                        									<label><a href="#"><i class="bx bx-current-location"></i></a></label>
                        									<input type="text" placeholder="Location" name="location" class="pl-28">
                        								</div>
                        							</div>

                        							<div class="col">
                        								<div class="form-group name-dlauc">
                        									<select id="people" name="ideal_uses[]" data-placeholder="Ideal Uses" multiple>
                        										<option value="-1">All</option>
                        										@foreach($ideal_uses as $key)
                        										<option value="{{$key->id}}">{{$key->name}} </option>
                        										@endforeach
                        									</select>
                        								</div>
                        							</div>
                        							<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                                    <!--div class="col">
                                        <div class="form-group">
                                            <select>
                                                <option>Price </option>
                                                <option>Min-Max /Month  </option>
                                                <option>Min-Max /Year</option>
                                            </select>
                                        </div>
                                    </div-->
                                    <div class="col flr-rng pl-0">
                                    	<div class="form-group price-list-widget prics ">
                                    		<label class="lb-ls">Lease Price
                                    		</label>
                                    		<div class="flex-saf">
                                    			<div class="collection-filter-by-price">
                                    				<input class="range_input" type="text" data-min="0" data-max="1000" data-step="10">
                                    				<input type="hidden" name="from_range" value="0" id="from_range">
                                    				<input type="hidden" name="to_rangefrom" value="1000" id="to_range">
                                    			</div>
                                    			<div class="slc-fs">
                                    				<select class="optin-msny form-control" name="price_unit">
                                    					<option value="">Price Unit</option>
                                    					<option>/month</option>
                                    					<option>/year</option>
                                    				</select>
                                    			</div>
                                    		</div>
                                    	</div>
                                    </div>
                                    <div class="col">
                                    	<div class="form-group">
                                    		<select name="sort_bysize" class="form-control">
                                    			<option value="">Size </option>
                                    			<option value="min_max_sqf">Min-Max /sqF</option>
                                    			<option value="min_max_sqm">Min-Max /sqM</option>
                                    		</select>
                                    	</div>
                                    </div>
                                    <div class="col">
                                    	<div class="form-group">
                                    		<select name="Sort_by" class="form-control">
                                    			<option value="">Sort by</option>
                                    			<option value="">Recommended</option>
                                    			<option value="">City A Z</option>
                                    			<option value="">City Z A</option>
                                    			<option value="newest">Newest</option>
                                    			<option value="oldest">Oldest</option>
                                    			<option value="price_lowtohigh">Price Low to High</option>
                                    			<option value="price_hightolow">Price High to Low</option>
                                    		</select>
                                    	</div>
                                    </div>
                                    <input type="hidden" name="type" value="3">
                                    <div class="col">
                                    	<div class="form-group">
                                    		<a href="javascript:void(0);" class="flst-sta">More filters </a>
                                    	</div>
                                    </div>
                                </div>
                                <div class="box-fltrts billing-details" style="display:none">
                                	<div class="row">
                                		<div class="col-lg-12 col-md-12">
                                			<div class="form-group">
                                				<label class="ttls">Amenities  </label>
                                				<ul class="list-chkes row list-nw">
                                					@foreach($amenities as $key)
                                					<li class="col-md-2 col-sm-4">
                                						<label class="costm-check">{{$key->name}}
                                							<input type="checkbox" value="{{$key->id}}" name="amenities[]">
                                							<span class="checkmark"></span>
                                						</label>
                                					</li>
                                					@endforeach
                                				</ul>
                                			</div>
                                		</div>
                                		<div class="col-lg-4 col-md-4">
                                			<div class="form-group">
                                				<label>Floors</label>
                                				<select class="form-control" name="floors">
                                					<option value="">Select One</option>
                                					<option>1 </option>
                                					<option>2</option>
                                					<option>3</option>
                                				</select>
                                			</div>
                                		</div>
                                		<div class="col-lg-4 col-md-4">
                                			<div class="form-group">
                                				<label>Lease Type</label>
                                				<select class="form-control" name="lease_type">
                                					<option value="">Select One</option>
                                					<option>Sublease </option>
                                					<option>Individual Leases</option>
                                				</select>
                                			</div>
                                		</div>
                                	</div>
                                </div>
                                <div class="main-search-btn">
                                	<button type="submit" class="search_submit">Search <i class='bx bx-search-alt'></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row searched_data">
                	@if(count($fullspace)>0)
                	@foreach($fullspace as $key)
                	<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item{{$key->id}}">
                		<div class="single-listing-item new-stl-lyt">
                			<div class="row">
                				<div class="col-md-4">
                					<div class="listing-image">
                						<a href="{{url('/')}}/{{getUrl()}}/fullspacedetails/{{$key->id}}" class="d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>

                						<div class="listing-tag">
                							<a href="{{url('/')}}/{{getUrl()}}/fullspacedetails/{{$key->id}}" class="d-block">{{$key->space_category}}</a>
                						</div>
                					</div>
                				</div>
                				<div class="col-md-8">
                					<div class="listing-content pl-0">
                						<h3><a href="{{url('/')}}/{{getUrl()}}/fullspacedetails/{{$key->id}}" class="d-inline-block">{{$key->name}}</a></h3>
                						<p class="mt-2 mb-2 fontsizepara">{{Getdesc($key->description,200,1)}}</p>
                						<div class="d-flex align-items-center justify-content-between">
                							<div class="price">
                								<b data-toggle="tooltip" data-placement="top">
                									@if($key->price_from)
                									${{$key->price_from}}{{$key->price_unit}}
                									@endif
                								</b>
                							</div>
                							<span class="location"><i class="bx bx-map"></i> {{$key->location_city}}</span>
                						</div>
                					</div>
                					<div class="listing-box-footer br-st-a">
                						<a href="{{url('/')}}/{{getUrl()}}/fullspacedetails/{{$key->id}}" class="view-ayr"> <i class="fa fa-eye" ></i> </a>
                						<a href="{{url('/')}}/{{getUrl()}}/edit-full-space-landlord/{{$key->id}}" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
                						<a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a>
                						<span class="tcts-yt"> Lease Term: {{$key->lease_term}} Years </span>
                					</div>
                				</div>
                			</div>

                		</div>
                		@if($loop->last)
                                        <!--  <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="pagination-area text-center bg-grs">
                                                    <a href="#" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                                                    <span class="page-numbers current" aria-current="page">1</span>
                                                    <a href="#" class="page-numbers">2</a>
                                                    <a href="#" class="page-numbers">3</a>
                                                    <a href="#" class="page-numbers">4</a>
                                                    <a href="#" class="page-numbers">5</a>
                                                    <a href="#" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div> -->
                                        @endif
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                    	<div class="single-listing-item new-stl-lyt">
                                    		<center><h4>  No Data Found.</h4></center>
                                    	</div>
                                    </div>
                                    @endif


                                </div>
                                <div class="row">
                                	<div class="col-lg-12 col-md-12">
                                		<a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $fullspacelisting_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$fullspacelisting_count}}">Load More</a>
                                	</div>
                                </div>

                            </div>
                        </div>
                        @elseif($title == 'User Partial Space Listings')
                        <div class="col-md-12">
                        	<div class="listings-alls">
                        		<div class="billing-details">
                        			<h3 class="title font-strs font-sma">User Partial Space Listings    <a href="{{url('/')}}/{{getUrl()}}/add-partial-space-landlord" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> </h3>
                        		</div>
                        		<div class="row">
                        			<div class="col-md-12">
                        				<div class="main-search-wrap fll-s-st">
                        					<form id="search_listing">
                        						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        						<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                        						<div class="row">
                        							<div class="col">
                        								<div class="form-group">
                        									<input type="text" placeholder="Keyword..." name="keyword">
                        								</div>
                        							</div>
                        							<div class="col">
                        								<div class="form-group">
                        									<label><a href="#"><i class="bx bx-current-location"></i></a></label>
                        									<input type="text" placeholder="Location" name="location" class="pl-28">
                        								</div>
                        							</div>
                        							<input type="hidden" name="type" value="4">
                        							<div class="col">
                        								<div class="form-group name-dlauc">
                        									<select name="rental_type[]" id="people1" data-placeholder="Type" multiple>
                        										<option>Rent</option>
                        										<option>Consignment</option>
                        										<option value="-1">All</option>
                        									</select>
                        								</div>
                        							</div>
                                   <!--  <div class="col">
                                        <div class="form-group name-dlauc">
                                             <select id="people" name="ideal_uses[]" data-placeholder="Ideal Uses" multiple>
                                                <option value="-1">All</option>
                                                @foreach($ideal_uses as $key)
                                                    <option value="{{$key->id}}">{{$key->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col flr-rng pl-0">
                                    	<div class="form-group price-list-widget prics ">
                                    		<label class="lb-ls">Lease Price
                                    		</label>
                                    		<div class="flex-saf">
                                    			<div class="collection-filter-by-price">
                                    				<input class="range_input" type="text" data-min="0" data-max="1000" data-step="10">
                                    				<input type="hidden" name="from_range" value="0" id="from_range">
                                    				<input type="hidden" name="to_rangefrom" value="1000" id="to_range">
                                    			</div>
                                    			<div class="slc-fs">
                                    				<select class="optin-msny" name="price_unit">
                                    					<option value="">Price Term</option>
                                    					<option>/month</option>
                                    					<option>/year</option>
                                    				</select>
                                    			</div>
                                    		</div>
                                    	</div>
                                    </div>
                                    <div class="col">
                                    	<div class="form-group">
                                    		<select name="sort_bysize" class="form-control">
                                    			<option value="">Size </option>
                                    			<option value="min_max_sqf">Min-Max /sqF</option>
                                    			<option value="min_max_sqm">Min-Max /sqM</option>
                                    		</select>
                                    	</div>
                                    </div>
                                    <div class="col">
                                    	<div class="form-group">
                                    		<select name="Sort_by" class="form-control">
                                    			<option value="">Sort by</option>
                                    			<option value="">Recommended</option>
                                    			<option value="">City A Z</option>
                                    			<option value="">City Z A</option>
                                    			<option value="newest">Newest</option>
                                    			<option value="oldest">Oldest</option>
                                    			<option value="price_lowtohigh">Price Low to High</option>
                                    			<option value="price_hightolow">Price High to Low</option>
                                    		</select>
                                    	</div>
                                    </div>
                                    <div class="col">
                                    	<div class="form-group">
                                    		<a href="javascript:void(0);" class="flst-sta">More filters </a>
                                    	</div>
                                    </div>
                                </div>
                                <div class="box-fltrts billing-details" style="display:none">
                                	<div class="row">
                                		<div class="col-lg-12 col-md-12">
                                			<div class="form-group">
                                				<label class="ttls">Amenities  </label>
                                				<ul class="list-chkes row list-nw">
                                					@foreach($amenities as $key)
                                					<li class="col-md-2 col-sm-4">
                                						<label class="costm-check">{{$key->name}}
                                							<input type="checkbox" value="{{$key->id}}" name="amenities[]">
                                							<span class="checkmark"></span>
                                						</label>
                                					</li>
                                					@endforeach
                                				</ul>
                                			</div>
                                		</div>
                                		<div class="col-lg-4 col-md-4">
                                			<div class="form-group">
                                				<label>Floors</label>
                                				<select class="form-control" name="floors">
                                					<option value="">Select One</option>
                                					<option>1 </option>
                                					<option>2</option>
                                					<option>3</option>
                                				</select>
                                			</div>
                                		</div>
                                		<div class="col-lg-4 col-md-4">
                                			<div class="form-group">
                                				<label>Lease Type</label>
                                				<select class="form-control" name="lease_type">
                                					<option value="">Select One</option>
                                					<option>Sublease </option>
                                					<option>Individual Leases</option>
                                				</select>
                                			</div>
                                		</div>
                                	</div>
                                </div>

                                <div class="main-search-btn">
                                	<button type="submit" class="search_submit">Search <i class='bx bx-search-alt'></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row searched_data">

                	@if(count($partialspace)>0)
                	@foreach($partialspace as $key)
                	<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item{{$key->id}}">
                		<div class="single-listing-item new-stl-lyt">
                			<div class="row">
                				<div class="col-md-4">
                					<div class="listing-image">
                						<a href="{{url('/')}}/{{getUrl()}}/partialspacedetails/{{$key->id}}" class="d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>

                						<div class="listing-tag">
                							<a href="{{url('/')}}/{{getUrl()}}/partialspacedetails/{{$key->id}}" class="d-block">{{$key->lease_type}} </a>
                						</div>
                					</div>
                				</div>
                				<div class="col-md-8">
                					<div class="listing-content pl-0">
                						<h3><a href="{{url('/')}}/{{getUrl()}}/partialspacedetails/{{$key->id}}" class="d-inline-block">{{$key->name}}</a></h3>
                						<p class="mt-2 mb-2 fontsizepara">{{Getdesc($key->description,200,1)}}</p>
                						<div class="d-flex align-items-center justify-content-between">
                							<div class="price">
                								<b data-toggle="tooltip" data-placement="top">
                									@if($key->price_from)
                									${{$key->price_from}}{{$key->price_unit}}
                									@endif
                								</b>
                							</div>
                							<span class="location"><i class="bx bx-map"></i> {{$key->location_city}}</span>
                						</div>
                					</div>
                					<div class="listing-box-footer br-st-a">
                						<a href="{{url('/')}}/{{getUrl()}}/partialspacedetails/{{$key->id}}" class="view-ayr"> <i class="fa fa-eye"></i> </a>
                						<a href="{{url('/')}}/{{getUrl()}}/edit-partial-space-landlord/{{$key->id}}" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
                						<a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a>
                						<span class="tcts-yt"> <i class="bx bx-tags"></i> Current Use: @if($key->current_use == '-1') All @elseif($key->current_use == '-2') Not in use @else {{$key->current_use_name}} @endif</span>
                					</div>
                				</div>
                			</div>

                		</div>
                		@if($loop->last)
                                         <!-- <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="pagination-area text-center bg-grs">
                                                    <a href="#" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                                                    <span class="page-numbers current" aria-current="page">1</span>
                                                    <a href="#" class="page-numbers">2</a>
                                                    <a href="#" class="page-numbers">3</a>
                                                    <a href="#" class="page-numbers">4</a>
                                                    <a href="#" class="page-numbers">5</a>
                                                    <a href="#" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div> -->
                                        @endif
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                    	<div class="single-listing-item new-stl-lyt">
                                    		<center><h4>  No Data Found.</h4></center>
                                    	</div>
                                    </div>
                                    @endif


                                </div>
                                <div class="row">
                                	<div class="col-lg-12 col-md-12">
                                		<a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $partialspacelisting_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$partialspacelisting_count}}">Load More</a>
                                	</div>
                                </div>

                            </div>
                        </div>
                        @elseif($title == 'User Pop Up Landloard Listings')
                        <div class="col-md-12">
                        	<div class="listings-alls">
                        		<div class="billing-details">
                        			<h3 class="title font-strs font-sma">User Pop Up Landloard Listings <a href="{{url('/')}}/{{getUrl()}}/add-popup-landlord" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> </h3>
                        		</div>
                        		<div class="row">
                        			<div class="col-md-12">
                        				<div class="main-search-wrap fll-s-st">
                        					<form id="search_listing">
                        						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        						<div class="row">
                        							<div class="col">
                        								<div class="form-group">
                        									<input type="text" placeholder="Keyword..." name="keyword">
                        								</div>
                        							</div>
                        							<div class="col">
                        								<div class="form-group">
                        									<label><a href="#"><i class="bx bx-current-location"></i></a></label>
                        									<input type="text" placeholder="Location" name="location" class="pl-28">
                        								</div>
                        							</div>
                        							<div class="col">
                        								<div class="form-group">
                        									<select name="space_type" class="form-control">
                        										<option value="">Property Type </option>
                        										@foreach($space_type as $key)
                        										<option value="{{$key->id}}">{{$key->name}} </option>
                        										@endforeach
                        									</select>
                        								</div>
                        							</div>
                        							<input type="hidden" name="type" value="5">
                        							<div class="col flr-rng pl-0">
                        								<div class="form-group price-list-widget prics ">
                        									<label class="lb-ls">Lease Price
                        									</label>
                        									<div class="flex-saf">
                        										<div class="collection-filter-by-price">
                        											<input class="range_input" type="text" data-min="0" data-max="1000" data-step="10">
                        											<input type="hidden" name="from_range_popup" value="0" id="from_range">
                        											<input type="hidden" name="to_range_popup" value="1000" id="to_range">
                        										</div>
                        										<div class="slc-fs">                                                   <select class="optin-msny form-control" name="price_unit_popup">
                        											<option>/day</option>
                        											<option>/week</option>
                        											<option>/month</option>
                        										</select>
                        									</div>
                        								</div>
                        							</div>
                        						</div>

                        						<div class="col">
                        							<div class="form-group">
                        								<select name="sort_bysize" class="form-control">
                        									<option value="">Size </option>
                        									<option value="min_max_sqf">Min-Max /sqF</option>
                        									<option value="min_max_sqm">Min-Max /sqM</option>
                        								</select>
                        							</div>
                        						</div>
                        						<div class="col">
                        							<div class="form-group">
                        								<select name="Sort_by" class="form-control">
                        									<option value="">Sort by</option>
                        									<option value="">Recommended</option>
                        									<option value="">City A Z</option>
                        									<option value="">City Z A</option>
                        									<option value="newest">Newest</option>
                        									<option value="oldest">Oldest</option>
                        									<option value="price_lowtohigh">Price Low to High</option>
                        									<option value="price_hightolow">Price High to Low</option>
                        								</select>
                        							</div>
                        						</div>
                        						<div class="col">
                        							<div class="form-group">
                        								<a href="javascript:void(0);" class="flst-sta">More filters </a>
                        							</div>
                        						</div>
                        					</div>
                        					<div class="box-fltrts billing-details" style="display:none">
                        						<div class="row">
                        							<div class="col-lg-12 col-md-12">
                        								<div class="form-group">
                        									<label class="ttls">Amenities  </label>
                        									<ul class="list-chkes row list-nw">
                        										@foreach($amenities as $key)
                        										<li class="col-md-2 col-sm-4">
                        											<label class="costm-check">{{$key->name}}
                        												<input type="checkbox" value="{{$key->id}}" name="amenities[]">
                        												<span class="checkmark"></span>
                        											</label>
                        										</li>
                        										@endforeach
                        									</ul>
                        								</div>
                        							</div>
                        							<div class="col-lg-12 col-md-12">
                        								<div class="form-group">
                        									<label>Ideal Uses <span class="required">*</span> </label>
                        									<ul class="list-chkes row list-nw">
                        										@foreach($ideal_uses as $key)
                        										<li class="col-md-2 col-sm-4">
                        											<label class="costm-check">{{$key->name}}
                        												<input type="checkbox" value="{{$key->id}}" name="ideal_uses[]">
                        												<span class="checkmark"></span>
                        											</label>
                        										</li>
                        										@endforeach


                        									</ul>
                        								</div>
                        							</div>
                        							<div class="col-lg-4 col-md-4">
                        								<div class="form-group">
                        									<label>Floors</label>
                        									<select class="form-control" name="floors">
                        										<option value="">Select One</option>
                        										<option>1 </option>
                        										<option>2</option>
                        										<option>3</option>
                        									</select>
                        								</div>
                        							</div>
                        						</div>
                        					</div>
                        					<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                        					<div class="main-search-btn">
                        						<button type="submit" class="search_submit">Search <i class='bx bx-search-alt'></i></button>
                        					</div>
                        				</form>

                        			</div>
                        		</div>
                        	</div>
                        	<div class="row searched_data">
                        		@if(count($popuplandlord)>0)
                        		@foreach($popuplandlord as $key)
                        		<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item{{$key->id}}">
                        			<div class="single-listing-item new-stl-lyt">
                        				<div class="row">
                        					<div class="col-md-4">
                        						<div class="listing-image">
                        							<a href="{{url('/')}}/{{getUrl()}}/popupstoredetails/{{$key->id}}" class="d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>

                        							<div class="listing-tag">
                        								<a href="{{url('/')}}/{{getUrl()}}/popupstoredetails/{{$key->id}}" class="d-block">

                        									@foreach($key->ideal_uses_cat as $value)
                        									{{$value->name}}
                        									@if(!$loop->last)
                        									,
                        									@endif
                        									@endforeach
                        								</a>
                        							</div>
                        						</div>
                        					</div>
                        					<div class="col-md-8">
                        						<div class="listing-content pl-0">
                        							<h3><a href="{{url('/')}}/{{getUrl()}}/popupstoredetails/{{$key->id}}" class="d-inline-block">{{$key->name}}</a></h3>
                        							<p class="mt-2 mb-2 fontsizepara">{{Getdesc($key->description,200,1)}}</p>
                        							<div class="d-flex align-items-center justify-content-between">
                        								<div class="price">
                        									<b data-toggle="tooltip" data-placement="top">
                        										Account ID: #{{$key->id}}
                        									</b>
                        								</div>
                        								<span class="location"><i class="bx bx-map"></i> {{$key->location_city}}</span>
                        							</div>
                        						</div>
                        						<div class="listing-box-footer br-st-a">
                        							<a href="{{url('/')}}/{{getUrl()}}/popupstoredetails/{{$key->id}}" class="view-ayr"> <i class="fa fa-eye"></i> </a>
                        							<a href="{{url('/')}}/{{getUrl()}}/edit-popup-landlord/{{$key->id}}" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
                        							<a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a>
                        							<ul class="list-stra-al">
                        								<li class="main-prc"> Price: </li>
                        								@if($key->daily_rate)
                        								<li> ${{$key->daily_rate}}/day </li>
                        								@endif
                        								@if($key->weekly_rate)
                        								<li> ${{$key->weekly_rate}}/week </li>
                        								@endif
                        								@if($key->monthly_rate)
                        								<li> ${{$key->monthly_rate}}/month </li>
                        								@endif
                        							</ul>
                        						</div>
                        					</div>
                        				</div>

                        			</div>
                        			@if($loop->last)
                                         <!-- <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="pagination-area text-center bg-grs">
                                                    <a href="#" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                                                    <span class="page-numbers current" aria-current="page">1</span>
                                                    <a href="#" class="page-numbers">2</a>
                                                    <a href="#" class="page-numbers">3</a>
                                                    <a href="#" class="page-numbers">4</a>
                                                    <a href="#" class="page-numbers">5</a>
                                                    <a href="#" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div> -->
                                        @endif
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                    	<div class="single-listing-item new-stl-lyt">
                                    		<center><h4>  No Data Found.</h4></center>
                                    	</div>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                	<div class="col-lg-12 col-md-12">
                                		<a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $popupstorelisting_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$popupstorelisting_count}}">Load More</a>
                                	</div>
                                </div>

                            </div>
                        </div>
                        @elseif($title == 'User Services Listings')
                        <div class="col-md-12">
                        	<div class="listings-alls">
                        		<div class="billing-details">
                        			<h3 class="title font-strs font-sma">User Services Listings <a href="{{url('/')}}/{{getUrl()}}/add-services" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> </h3>
                        		</div>
                        		<div class="row">
                        			<div class="col-md-12">
                        				<div class="main-search-wrap fll-s-st">
                        					<form id="search_listing">
                        						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        						<div class="row">
                        							<div class="col">
                        								<div class="form-group">
                        									<input type="text" placeholder="Keyword..." name="keyword">
                        								</div>
                        							</div>
                        							<div class="col">
                        								<div class="form-group">
                        									<label><a href="#"><i class="bx bx-current-location"></i></a></label>
                        									<input type="text" placeholder="Location" name="location" class="pl-28">
                        								</div>
                        							</div>
                        							<input type="hidden" name="type" value="7">
                        							<div class="col">
                        								<div class="form-group">
                        									<select name="Sort_by" class="form-control">
                        										<option value="">Sort by</option>
                        										<option value="">Recommended</option>
                        										<option value="">City A Z</option>
                        										<option value="">City Z A</option>
                        										<option value="newest">Newest</option>
                        										<option value="oldest">Oldest</option>
                        									</select>
                        								</div>
                        							</div>

                        						</div>

                        						<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                        						<div class="main-search-btn">
                        							<button type="submit" class="search_submit">Search <i class='bx bx-search-alt'></i></button>
                        						</div>
                        					</form>

                        				</div>
                        			</div>
                        		</div>
                        		<div class="row searched_data">
                        			@if(count($popuplandlord)>0)
                        			@foreach($popuplandlord as $key)
                        			<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item{{$key->id}}">
                        				<div class="single-listing-item new-stl-lyt">
                        					<div class="row">
                        						<div class="col-md-4">
                        							<div class="listing-image">
                        								<a href="{{url('/')}}/{{getUrl()}}/servicedetails/{{$key->id}}" class="d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>

                        								<div class="listing-tag">
                        									<a href="{{url('/')}}/{{getUrl()}}/popupstoredetails/{{$key->id}}" class="d-block">

                        										{{$key->business_category}}  
                        									</a>
                        								</div>
                        							</div>
                        						</div>
                        						<div class="col-md-8">
                        							<div class="listing-content pl-0">
                        								<h3><a href="{{url('/')}}/{{getUrl()}}/servicedetails/{{$key->id}}" class="d-inline-block">{{$key->name}}</a></h3>
                        								<p class="mt-2 mb-2 fontsizepara">{{Getdesc($key->description,200,1)}}</p>
                        								<div class="d-flex align-items-center justify-content-between">
                        									<div class="price">
                        										<b data-toggle="tooltip" data-placement="top">
                        											Account ID: #{{$key->id}}
                        										</b>
                        									</div>
                        									<span class="location"><i class="bx bx-map"></i> {{$key->location_city}}</span>
                        								</div>
                        							</div>
                        							<div class="listing-box-footer br-st-a">
                        								<a href="{{url('/')}}/{{getUrl()}}/servicedetails/{{$key->id}}" class="view-ayr"> <i class="fa fa-eye"></i> </a>
                        								<a href="{{url('/')}}/{{getUrl()}}/edit-service/{{$key->id}}" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
                        								<a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a>

                        							</div>
                        						</div>
                        					</div>

                        				</div>
                        				@if($loop->last)
                                         <!-- <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="pagination-area text-center bg-grs">
                                                    <a href="#" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                                                    <span class="page-numbers current" aria-current="page">1</span>
                                                    <a href="#" class="page-numbers">2</a>
                                                    <a href="#" class="page-numbers">3</a>
                                                    <a href="#" class="page-numbers">4</a>
                                                    <a href="#" class="page-numbers">5</a>
                                                    <a href="#" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div> -->
                                        @endif
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                    	<div class="single-listing-item new-stl-lyt">
                                    		<center><h4>  No Data Found.</h4></center>
                                    	</div>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                	<div class="col-lg-12 col-md-12">
                                		<a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $popupstorelisting_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$popupstorelisting_count}}">Load More</a>
                                	</div>
                                </div>

                            </div>
                        </div>
                        @elseif($title == 'User Events Fairs Markets')
                        <div class="col-md-12">
                        	<div class="billing-details">
                        		<h3 class="title font-strs font-sma">User Events Fairs Markets
                        			<!-- <a href="{{url('/add-events-fairs-markets')}}" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a> </h3> -->
                        		</div>
                        		<div class="row">
                        			<div class="col-md-12">
                        				<div class="main-search-wrap fll-s-st">
                        					<form id="search_listing">
                        						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        						<div class="row">
                        							<div class="col">
                        								<div class="form-group">
                        									<input type="text" placeholder="Keyword..." name="keyword">
                        								</div>
                        							</div>
                        							<div class="col">

                        								<div class="form-group">
                        									<label><a href="#"><i class="bx bx-current-location"></i></a></label>
                        									<input type="text" placeholder="Location" name="location" class="pl-28">
                        								</div>
                        							</div>
                        							<input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                        							<input type="hidden" name="type" value="6">
                        							<div class="col flr-rng pl-0">
                        								<div class="form-group price-list-widget prics ">
                        									<label class="lb-ls">Fee
                        									</label>
                        									<div class="flex-saf">
                        										<div class="collection-filter-by-price">
                        											<input class="range_input" type="text" data-min="0" data-max="1000" data-step="10">
                        											<input type="hidden" name="from_range" value="0" id="from_range">
                        											<input type="hidden" name="to_rangefrom" value="1000" id="to_range">
                        										</div>
                        										<div class="slc-fs">                                                   <select class="optin-msny" name="price_unit">
                        											<option value="">Price Term</option>
                        											<option>Onetime</option>
                        											<option>Daily</option>
                        											<option>Weekly</option>
                        											<option>Monthly</option>
                        										</select>
                        									</div>
                        								</div>
                        							</div>
                        						</div>
                        						<div class="col">
                        							<div class="form-group name-dlauc">
                        								<select id="people" name="retail_category[]" data-placeholder="Retail Category" multiple>
                        									<option value="-1">All</option>
                        									@foreach($retail_categories as $key)
                        									<option value="{{$key->id}}">{{$key->name}} </option>
                        									@endforeach
                        								</select>
                        							</div>
                        						</div>
                        						<div class="col flr-rng pl-0">
                        							<div class="form-group price-list-widget">
                        								<label class="lb-ls">Space Size
                        								</label>
                        								<div class="flex-saf">
                        									<div class="collection-filter-by-price">
                        										<input class="size_range_input" type="text" data-min="0" data-max="1000" data-step="10">
                        										<input type="hidden" name="size_from_range" value="0" id="size_from_range">
                        										<input type="hidden" name="size_to_rangefrom" value="1000" id="size_to_range">
                        									</div>
                        									<div class="slc-fs">
                        										<select class="optin-msny" name="size_unit">
                        											<option value="sq feet"> /sq feet </option>
                        											<option value="sq meters"> /sq Meter </option>
                        										</select>
                        									</div>
                        								</div>
                        							</div>
                        						</div>
                        						<div class="col">
                        							<div class="form-group">
                        								<select name="Sort_by" class="form-control">
                        									<option value="">Sort by</option>
                        									<option value="">Recommended</option>
                        									<option value="">City A Z</option>
                        									<option value="">City Z A</option>
                        									<option value="newest">Newest</option>
                        									<option value="oldest">Oldest</option>
                        									<option value="price_lowtohigh">Price Low to High</option>
                        									<option value="price_hightolow">Price High to Low</option>
                        								</select>
                        							</div>
                        						</div>
                        						<div class="col">
                        							<div class="form-group">
                        								<a href="javascript:void(0);" class="flst-sta">More filters </a>
                        							</div>
                        						</div>
                        					</div>
                        					<div class="box-fltrts billing-details" style="display:none">
                        						<div class="row">
                        							<div class="col-lg-12 col-md-12">
                        								<div class="form-group">
                        									<label class="ttls">Amenities  </label>
                        									<ul class="list-chkes row list-nw">
                        										@foreach($amenities as $key)
                        										<li class="col-md-2 col-sm-4">
                        											<label class="costm-check">{{$key->name}}
                        												<input type="checkbox" value="{{$key->id}}" name="amenities[]">
                        												<span class="checkmark"></span>
                        											</label>
                        										</li>
                        										@endforeach
                        									</ul>
                        								</div>
                        							</div>
                        							<div class="col-lg-4 col-md-4">
                        								<div class="form-group">
                        									<label>Start Date and Time
                        										<input type="text" class="form-control" id="datetimepicker" name="start_datetime" readonly="" /></label>
                        									</div>
                        								</div>
                        								<div class="col-lg-4 col-md-4">
                        									<div class="form-group">
                        										<label>End Date and Time
                        											<input type="text" class="form-control" id="datetimepicker2" name="end_datetime" readonly="" /></label>
                        										</div>
                        									</div>
                        								</div>
                        							</div>

                        							<div class="main-search-btn">
                        								<button type="submit" class="search_submit">Search <i class='bx bx-search-alt'></i></button>
                        							</div>
                        						</form>

                        					</div>
                        				</div>
                        			</div>
                        			<div class="listings-alls">
                        				<div class="row searched_data">
                        					@if(count($eventsfairs)>0)
                        					@foreach($eventsfairs as $key)
                        					<div class="col-lg-12 col-sm-12 col-md-6 single_listing_item{{$key->id}}">
                        						<div class="single-listing-item new-stl-lyt">
                        							<div class="row">
                        								<div class="col-md-4">
                        									<div class="listing-image">
                        										<a href="{{url('/')}}/{{getUrl()}}/eventdetails/{{$key->id}}" class="d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>
                        									</div>
                        								</div>
                        								<div class="col-md-8">
                        									<div class="listing-content pl-0">
                        										<h3><a href="{{url('/')}}/{{getUrl()}}/eventdetails/{{$key->id}}" class="d-inline-block">{{$key->name}}</a></h3>
                        										<p class="mt-2 mb-2 fontsizepara">{{Getdesc($key->description,200,1)}}</p>
                        										<div class="d-flex align-items-center justify-content-between">
                        											<div class="price">
                        												<b data-toggle="tooltip" data-placement="top">
                        													@if($key->price_from)
                        													${{$key->price_from}} {{$key->price_unit}}
                        													@endif
                        												</b>
                        											</div>
                        											<span class="location"><i class="bx bx-map"></i> {{$key->location_city}}</span>
                        										</div>
                        									</div>
                        									<div class="listing-box-footer br-st-a">
                        										<a href="{{url('/')}}/{{getUrl()}}/eventdetails/{{$key->id}}" class="view-ayr"> <i class="fa fa-eye"></i> </a>
                        										<!-- <a href="{{url('/')}}/{{getUrl()}}/edit-events-fairs-markets/{{$key->id}}" class="edit-ayr"> <i class="bx bx-pencil"></i> </a> -->
                        										<!-- <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a> -->
                        										<ul class="list-stra-al">
                        											<li class="main-prc"> Fee: </li>
                        											<li> ${{$key->price_from}}/{{$key->price_unit}} </li>
                        										</ul>
                        									</div>
                        								</div>
                        							</div>

                        						</div>
                        						@if($loop->last)
                                         <!-- <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="pagination-area text-center bg-grs">
                                                    <a href="#" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                                                    <span class="page-numbers current" aria-current="page">1</span>
                                                    <a href="#" class="page-numbers">2</a>
                                                    <a href="#" class="page-numbers">3</a>
                                                    <a href="#" class="page-numbers">4</a>
                                                    <a href="#" class="page-numbers">5</a>
                                                    <a href="#" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div> -->
                                        @endif
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                    	<div class="single-listing-item new-stl-lyt">
                                    		<center><h4>  No Data Found.</h4></center>
                                    	</div>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                	<div class="col-lg-12 col-md-12">
                                		<a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $event_fair_listing_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$event_fair_listing_count}}">Load More</a>
                                	</div>
                                </div>
                            </div>
                        </div>
                        @endif

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
                					<p> you want to delete this listing?  It will no longer be visible in the 	Brick Listing Page </p>
                					<input type="hidden" id="list_delete">
                				</div>
                			</div>
                			<div class="modal-footer">
                				<button type="button" class="btn btn-secondary delete_listing_confirm">Yes</button>
                				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                			</div>
                		</div>
                	</div>
                </div>

                <!-- Manage brick members popup -->
                <div class="modal fade" id="manage-brick-members-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                @endsection
                @section('footer_scripts')
                <link rel="stylesheet" href="{{url('/')}}/css/component-chosen.css" />
                <script src="{{url('/')}}/js/chosen.jquery.min.js"></script>
                <script type="text/javascript">
                	$(document).ready(function(){
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
                	});
                	$(document).on('click','.delete_listing',function(){
                		$('#list_delete').val($(this).attr('data-id'));
                	});
                	$(document).on('click','.delete_listing_confirm',function(){
                		$(this).html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
                		var dis = this;
                		var listing_id = $('#list_delete').val();
                		$.ajax({
                			url: '{{url("/")}}/delete_listing',
                			type: 'POST',
                			data: {"_token": '{{ Session::token() }}', id : listing_id},
                			dataType: 'json',
                			success: function(result) {
                				$(dis).html('Yes').prop('disabled',false);
                				$('.single_listing_item'+listing_id).remove();
                				$('#delete-pop').modal('hide');
                			}
                		});
                	});
                	$('#people').chosen({
                		allow_single_deselect: true,
                		width: '100%',
                	});
                	$('#people1').chosen({
                		allow_single_deselect: true,
                		width: '100%',
                	});
                	$('#collaboration_type').chosen({
                		allow_single_deselect: true,
                		width: '100%',
                	});
                	$(document).on('change','#people',function(event, params){
       // console.log(params);
       var val = $(this).val();
       if(val && val.indexOf("-1") != -1){

       	$('#people option').prop('selected',true);
       	$("#people option[value='-1']").remove();
       	$('#people').trigger("chosen:updated");
       }else{
       	if(params.deselected){
       		$("#people option[value='-1']").remove();
       		$('#people').prepend('<option value="-1">All</option>');
       		$('#people').trigger("chosen:updated");
       	}
       }

   });
                	$(document).on('change','#people1',function(event, params){
       // console.log(params);
       var val = $(this).val();
       if(val && val.indexOf("-1") != -1){

       	$('#people1 option').prop('selected',true);
       	$("#people1 option[value='-1']").remove();
       	$('#people1').trigger("chosen:updated");
       }else{
       	if(params.deselected){
       		$("#people1 option[value='-1']").remove();
       		$('#people1').append('<option value="-1">All</option>');
       		$('#people1').trigger("chosen:updated");
       	}
       }

   });
                	$(document).on('change','#collaboration_type',function(event, params){
       // console.log(params);
       var val = $(this).val();
       if(val && val.indexOf("-1") != -1){

       	$('#collaboration_type option').prop('selected',true);
       	$("#collaboration_type option[value='-1']").remove();
       	$('#collaboration_type').trigger("chosen:updated");
       }else{
       	if(params.deselected){
       		$("#collaboration_type option[value='-1']").remove();
       		$('#collaboration_type').prepend('<option value="-1">All</option>');
       		$('#collaboration_type').trigger("chosen:updated");
       	}
       }

   });
                	$(".range_input").ionRangeSlider({
                		type: "double",
                		drag_interval: true,
                		min_interval: null,
                		max_interval: null,
                		onFinish: function (data) {
                			$('#from_range').val(data.from);
                			$('#to_range').val(data.to);
                			if(data.to == '1000'){
                				$('.range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
                			}
                		},
                	});
                	$(document).ready(function(){
                		$(".flst-sta").click(function(){
                			$(".box-fltrts").slideToggle();
                		});
                	});
                	$(".size_range_input").ionRangeSlider({
                		type: "double",
                		drag_interval: true,
                		min_interval: null,
                		max_interval: null,
                		onFinish: function (data) {
                			$('#size_from_range').val(data.from);
                			$('#size_to_range').val(data.to);
                			if(data.to == '1000'){
                				$('.size_range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
                			}
                		},
                	});
                	setTimeout(function(){
                		var get_val = $('.irs-to').html();
                		if(get_val == '1000' || get_val == '1 000'){
                			$('.irs-to').append('+');
                		}
                	}, 1000);
                	jQuery('#datetimepicker').datetimepicker({
                	});
                	jQuery('#datetimepicker2').datetimepicker({
                	});
                </script>
                @stop
