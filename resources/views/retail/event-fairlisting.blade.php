@extends('layouts.app')

@section('content')

    <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3 pdd-sechr userbanner small-bsn">
            <div class="container">
                <div class="page-title-content">
                    <h2> <span class="icon-ttl"><i class="bx bxs-building-house"></i>  </span>{{$title}}</h2>
                </div>
            </div>
        @include('includes.pagetitle')
        <!-- End Page Title Area -->

 <!-- Start Latest Listing Area -->
        <section class="listing-area pb-5 ptb-100 bg-grey pdd-csts">
            <div class="container-fluid ">
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
                                    <input type="hidden" name="type" value="6">
                                    <div class="col flr-rng pl-0">
                                        <div class="form-group price-list-widget prics price_range_filter">
											<label class="lb-ls">Fee
											</label>

											 <div class="price_range_filter_input">
												<input class="data_of_range_from" type="text" value="0" onkeypress="return isNumber(event)">
												<input class="data_of_range_to" type="text" value="1000" onkeypress="return isNumber(event)">
											   </div>


											<div class="flex-saf">
                                                <div class="collection-filter-by-price">
                                                     <input class="range_input" type="text" data-min="0" data-max="1000">
                                                    <input type="hidden" name="from_range" value="0" id="from_range">
                                                    <input type="hidden" name="to_rangefrom" value="1000" id="to_range">
                                                </div>
                                                <div class="slc-fs">
                                                    <select class="optin-msny form-control" name="price_unit">
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
                                    <!-- <div class="col flr-rng pl-0">
                                        <div class="form-group price-list-widget ">
											<label class="lb-ls">Space Size
											</label>
                                            <div class="flex-saf">
                                                <div class="collection-filter-by-price">
                                                    <input class="size_range_input" type="text" data-min="0" data-max="500" data-step="10">
                                                    <input type="hidden" name="size_from_range" value="0" id="size_from_range">
                                                    <input type="hidden" name="size_to_rangefrom" value="500" id="size_to_range">
                                                </div>
                                                <div class="slc-fs">
                                                    <select class="optin-msny" name="size_unit">
                                                       <option value="sq feet"> /sq feet </option>
                                                       <option value="sq meters"> /sq Meter </option>
                                                    </select>
                                                </div>
                                            </div>
										</div>
                                    </div>  -->
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
                                            <a href="javascript:void(0);" class="flst-sta more_filter_class">More filters </a>
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
                                         <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Start Date and Time
                                                <input type="text" class="form-control" id="datetimepicker" name="start_datetime" readonly="" /></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>End Date and Time
                                                <input type="text" class="form-control" id="datetimepicker2" name="end_datetime" readonly="" /></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group price-list-widget price_range_filter size_range_filter">
                                                <label class="lb-ls">Size
                                                </label>

												 <div class="price_range_filter_input">
												 <input class="size_of_range_from" type="text" value="0" onkeypress="return isNumber(event)">
                                                <input class="size_of_range_to" type="text" value="1000" onkeypress="return isNumber(event)">
											   </div>



                                                <div class="flex-saf">

                                                    <div class="collection-filter-by-price">
                                                        <input class="size_range_input" type="text" data-min="0" data-max="1000">
                                                        <input type="hidden" name="size_from_range" value="0" id="size_from_range">
                                                        <input type="hidden" name="size_to_rangefrom" value="1000" id="size_to_range">
                                                    </div>
                                                    <div class="slc-fs">
                                                        <select class="optin-msny" name="size_unit">
                                                            <option value="">Unit</option>
                                                            <option value="sq feet">/Sq F</option>
                                                            <option value="sq meters">/Sq M</option>
                                                        </select>
                                                    </div>
                                                </div>
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
                <div class="row">



                    <div class="col-lg-9 col-md-12 useraferlogin">


                    <div class="listings-alls">
                            <div class="row searched_data">
                            @if(count($event_fair_listing)>0)
                            @foreach($event_fair_listing as $key)
                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item events-yell">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>
                                            </a>
                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><b> ID: </b>#{{$key->id}}</a>
                                            </div>
											<span class="lis-str-cat"> Event Fairs </span>
                                        </div>
                                        <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-inline-block">
                                        <div class="listing-content">

                                            <h3>{{$key->name}}</h3>
                                            <p class="mt-2">{{Getdesc($key->description,100,1)}}</p>


                                        </div>
                                        </a>

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
                                    <a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $event_fair_listing_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$event_fair_listing_count}}">Load More</a>
                                </div>
                            </div>
                        </div>
                           </div>


                     <div class="col-lg-3 col-md-12">
                        <div class="listing-widget-area">
                            <!--div class="listing-widget filter-list-widget widtbgs">
                                <h3 class="listing-widget-title">Create  Brick</h3>
								<a href="crdt-br" class="create-br"><i class="bx bx-plus"></i> Create a Brick </a>
                            </div-->
							<!--div class="listing-widget filter-list-widget widtbgs">
                                <h3 class="listing-widget-title">Current Selection</h3>

                                <div class="selected-filters-wrap-list">
                                    <ul>
                                        <li><a href="#"><i class='bx bx-x'></i> Legal Advice</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Events Fairs</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Financial Advice</a></li>
                                    </ul>

                                    <a href="#" class="delete-selected-filters"><i class='bx bx-trash'></i> <span>Reset All Filters</span></a>
                                </div>
                            </div-->

                            <!-- <div class="listing-widget facilities-list-widget widtbgs">
                                <h3 class="listing-widget-title">Categories</h3>

                                <ul class="facilities-list-row">
                                    <li><a href="bricks-listings.html">Bricks</a></li>
                                    <li><a href="brands-listings.html">Brands</a></li>
                                    <li><a href="full-space-listings.html">Full Space</a></li>
                                    <li><a href="partial-space-listings.html">Partial Space</a></li>
                                    <li><a href="popup-store-listings.html">Pop Up Stores</a></li>
                                    <li class="active"><a href="events-listings.html">Events Fairs</a></li>
                                </ul>
                            </div>
 -->


                            <div class="listing-widget categories-list-widget widtbgs">
                                <h3 class="listing-widget-title">Resources</h3>
								<ul class="categories-list-row">
                                    <li><a href="#">Legal Advice</a></li>
                                    <li><a href="#">Financial Advice</a></li>
                                    <li><a href="#">Sample Agreements</a></li>
                                    <li><a href="#">Articles</a></li>
                                    <li><a href="#">Links</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


               </div>
            </div>
        </section>
        <!-- End Latest Listing Area -->
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

@endsection
@section('footer_scripts')

<link rel="stylesheet" href="{{url('/')}}/css/component-chosen.css" />
<script src="{{url('/')}}/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
        $(function(){
            $('#people').chosen({
                  allow_single_deselect: true,
                  width: '100%',
            });
            $(document).on('change','#people',function(event, params){
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
            // $(".range_input").ionRangeSlider({
            //     type: "double",
            //     drag_interval: true,
            //     min_interval: null,
            //     max_interval: null,
            //     onFinish: function (data) {
            //         $('#from_range').val(data.from);
            //         $('#to_range').val(data.to);
            //         if(data.to == '500'){
            //             $('.range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
            //         }
            //     },
            // });
            // $(".size_range_input").ionRangeSlider({
            //     type: "double",
            //     drag_interval: true,
            //     min_interval: null,
            //     max_interval: null,
            //     onFinish: function (data) {
            //         $('#size_from_range').val(data.from);
            //         $('#size_to_range').val(data.to);
            //         if(data.to == '500'){
            //             $('.size_range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
            //         }
            //     },
            // });
            $(".range_input").ionRangeSlider({
            type: "double",
            drag_interval: true,
            min_interval: null,
            max_interval: null,
            onFinish: function (data) {
                $('#from_range').val(data.from);
                $('#to_range').val(data.to);
                $('.data_of_range_from').val(data.from);
                $('.data_of_range_to').val(data.to);
                // if(data.to == '1000'){
                //     $('.range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
                // }
            },
        });
        $(".size_range_input").ionRangeSlider({
            type: "double",
            drag_interval: true,
            min_interval: null,
            max_interval: null,
            onFinish: function (data) {
                $('#size_from_range').val(data.from);
                $('#size_to_range').val(data.to);
                $('.size_of_range_from').val(data.from);
                $('.size_of_range_to').val(data.to);
                // if(data.to == '1000'){
                //     $('.size_range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
                // }
            },
        });
        //  setTimeout(function(){
        //     var get_val = $('.irs-to').html();
        //     if(get_val == '1000' || get_val == '1 000'){
        //         $('.irs-to').append('+');
        //     }
        // }, 1000);
        $(document).on('keyup','.data_of_range_from',function(){
            var slider = $(".range_input").data("ionRangeSlider");

            var newval = $(this).val();
            newval = Number(newval).toString();
            $(this).val(newval);
            // Change slider, by calling it's update method
            slider.update({
                from: newval,
            });
            if($('#to_range').val() > 1000){
                   $('.range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
            }
             if(newval){
                $('#from_range').val(newval);
            }else{
                $('#from_range').val(0);
            }

        });
         $(document).on('keyup','.data_of_range_to',function(){
            var slider = $(".range_input").data("ionRangeSlider");
            var newval = $(this).val();
            newval = Number(newval).toString();
            $(this).val(newval);
            // Change slider, by calling it's update method

            slider.update({
                to: newval,
            });
            if(newval > 1000){
                    $('.range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
            }
            if(newval){
                $('#to_range').val(newval);
            }else{
                $('#to_range').val(1000);
            }

        });
        $(document).on('keyup','.size_of_range_from',function(){
            var slider = $(".size_range_input").data("ionRangeSlider");

            var newval = $(this).val();
            newval = Number(newval).toString();
            $(this).val(newval);
            // Change slider, by calling it's update method
            slider.update({
                from: newval,
            });
           // alert($('#size_to_range').val());
            if($('#size_to_range').val() > 1000){
                   $('.size_range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
            }
             if(newval){
                $('#size_from_range').val(newval);
            }else{
                $('#size_from_range').val(0);
            }

        });
         $(document).on('keyup','.size_of_range_to',function(){
            var slider = $(".size_range_input").data("ionRangeSlider");
            var newval = $(this).val();
            newval = Number(newval).toString();
            $(this).val(newval);
            // Change slider, by calling it's update method

            slider.update({
                to: newval,
            });
            if(newval > 1000){
                    $('.size_range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
            }
            if(newval){
                $('#size_to_range').val(newval);
            }else{
                $('#size_to_range').val(1000);
            }

        });
        // $(document).on('click','.more_filter_class',function(){
        //      setTimeout(function(){
        //         var get_val = $('.size_range_input').closest('.collection-filter-by-price').find('.irs-to').html();
        //         if(get_val == '1000' || get_val == '1 000'){
        //             $('.size_range_input').closest('.collection-filter-by-price').find('.irs-to').append('+');
        //         }
        //     }, 1000);
        // });
         function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
        }
            jQuery('#datetimepicker').datetimepicker({
                     // minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
                     // onChangeDateTime:function(dp,$input){
                     //    d = $input.val();
                     //    $('#datetimepicker2').datetimepicker({
                     //        minDate:d.split(' ')[0],
                     //    });
                     //  }
            });
            jQuery('#datetimepicker2').datetimepicker({
                     // minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
                     // onChangeDateTime:function(dp,$input){
                     //    d = $input.val();
                     //    $('#datetimepicker2').datetimepicker({
                     //        minDate:d.split(' ')[0],
                     //    });
                     //  }
            });
        });
</script>
<script type="text/javascript">
$(document).ready(function(){
      $(".flst-sta").click(function(){
        $(".box-fltrts").slideToggle();
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
    });
 </script>

@stop
