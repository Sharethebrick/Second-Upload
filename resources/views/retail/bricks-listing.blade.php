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
        <section class="listing-area  pb-5 ptb-100 bg-grey pdd-csts">
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
                                            <input type="text" placeholder="Location" class="pl-28" name="location">
                                        </div>

                                    </div>
                                    <input type="hidden" name="type" value="2">
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="looking_for" class="form-control">
                                                <option value="">I'm Looking For  </option>
                                                <option value="1">Share Space</option>
                                                <option value="2">Share Resources</option>
                                                <option value="3">Collaborate</option>
                                                <option value="4">Any </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="space_type" class="form-control">
                                                <option value="">Space Type</option>
                                                 @foreach($space_type as $key)
                                                    <option value="{{$key->id}}">{{$key->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="Sort_by" class="form-control">
                                                <option value="">Sort by</option>
                                                <option value="">Recommended</option>
                                                <option value="">City A Z</option>
                                                <option value="">City Z A</option>
                                                <option value="newest">Newest</option>
                                                <option value="oldest">Oldest</option>
                                                <option value="">Collaboration Type</option>
                                                <option value="space_type">Space Type</option>
                                                <option value="">Retal Category</option>
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
                <div class="row">


                    <div class="col-lg-9 col-md-12 useraferlogin">

                    <div class="listings-alls">
                            <div class="row searched_data">
                            @if(count($bricks)>0)
                            @foreach($bricks as $key)
                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item bricks-borsr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="d-block get_list_details_popup"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image">
                                            </a>
                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" class="d-block"><b> ID: </b>#{{$key->id}}</a>
                                            </div>
                                            <span class="lis-str-cat"> Bricks </span>
                                        </div>
                                        <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="d-inline-block get_list_details_popup">
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
                                    <a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $bricks_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$bricks_count}}">Load More</a>
                                </div>
                            </div>
                        </div>
                           </div>

                 <div class="col-lg-3 col-md-12">
                        <div class="listing-widget-area">
                            <!--div class="listing-widget filter-list-widget widtbgs">
                                <h3 class="listing-widget-title">Current Selection</h3>

                                <div class="selected-filters-wrap-list">
                                    <ul>
                                        <li><a href="#"><i class='bx bx-x'></i> Legal Advice</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Bricks</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Financial Advice</a></li>
                                    </ul>

                                    <a href="#" class="delete-selected-filters"><i class='bx bx-trash'></i> <span>Reset All Filters</span></a>
                                </div>
                            </div-->

                           <!--  <div class="listing-widget facilities-list-widget widtbgs">
                                <h3 class="listing-widget-title">Categories</h3>

                                <ul class="facilities-list-row">
                                    <li class="active"><a href="bricks-listings.html">Bricks</a></li>
                                    <li><a href="#">Brands</a></li>
                                    <li><a href="full-space-listings.html">Full Space</a></li>
                                    <li><a href="partial-space-listings.html">Partial Space</a></li>
                                    <li><a href="popup-store-listings.html">Pop Up Stores</a></li>
                                    <li><a href="events-listings.html">Events Fairs</a></li>
                                </ul>
                            </div>
 -->
                          <!--   <div class="listing-widget price-list-widget  widtbgs">
                                <h3 class="listing-widget-title">Price</h3>

                                <div class="collection-filter-by-price">
                                    <input class=" range_input" type="text" data-min="0" data-max="1055" name="filter_by_price" data-step="10">
                                </div>
                            </div> -->

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
            // $('#people').multiSelect({
            //     'noneText': 'Brand Retail Category',
            // });
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
    // $(".range_input").ionRangeSlider({
    //     type: "double",
    //     drag_interval: true,
    //     min_interval: null,
    //     max_interval: null,
    //     onFinish: function (data) {
    //         var data1 = $('#search_listing').serializeArray();
    //         data1.push({name: 'from_range', value: data.from});
    //         data1.push({name: 'to_range', value: data.to});
    //         if(data.to == '1055'){
    //             $('.irs-to').append('+');
    //         }
    //         $('.search_submit').html('Searching<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
    //         $.ajax({
    //                 type:'POST',
    //                 url:'{{url("/")}}'+'/search_listing',
    //                 data: data1,
    //                 dataType: 'json',
    //                 success:function(result)
    //                 {
    //                      $('.search_submit').html('Search <i class="bx bx-search-alt"></i>').prop('disabled',false);

    //                      $('.searched_data').html(result.html);
    //                      console.log(result.html);
    //                 }
    //          });
    //     },
    // });
</script>

@stop
