@extends('layouts.app')

@section('content')

  <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Choose Platform</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

  
 <section class="landing-page">
 <div class="container">
   <div class="row">
   	<div class="col-lg-3 margin-auto">
       <div class="landing-box">
         <div class="title">
           <a href="{{route('retail.index')}}"><h2>Retail</h2></a>
         </div>
       </div>
     </div>
     <div class="col-lg-9 margin-auto">
       <div class="landing-box">
         <div class="video-section">
           <iframe class="video"
           src="https://www.youtube.com/embed/tgbNymZ7vqY">
           </iframe>
         </div>
         <div class="title">
           <h2>Retail Information</h2>
           <p>Brick, Brand, Full Space, Partial Space and Pop-Up Landlord</p>
         </div>
       </div>
     </div>
     
   </div>
    <div class="row">
	    <div class="col-lg-3 margin-auto">
	       <div class="landing-box">
	         <div class="title">
	           <h2>Office</h2>
	         </div>
	       </div>
	     </div>
	     <div class="col-lg-9 margin-auto">
	        <div class="landing-box">
	         <div class="video-section">
	           <iframe class="video"
	           src="https://www.youtube.com/embed/tgbNymZ7vqY">
	           </iframe>
	         </div>
	         <div class="title">
	           <h2>Office Information</h2>
	           <p>Brick, Full Space and Partial Space</p>
	         </div>
	       </div>
	     </div>
	 </div>
	<div class="row">
	 <div class="col-lg-3 margin-auto">
	       <div class="landing-box">
	         <div class="title">
	           <h2>Resdential</h2>
	         </div>
	       </div>
	     </div>
     <div class="col-lg-9 margin-auto">
        <div class="landing-box">
         <div class="video-section">
           <iframe class="video"
           src="https://www.youtube.com/embed/tgbNymZ7vqY">
           </iframe>
         </div>
         <div class="title">
           <h2>Resdential Information</h2>
           <p>Brick, Full Space and Partial Space</p>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>

 @if(count($featured_listing)>0)
        <!-- Start Listing Area -->
        <section class="listing-area pb-5 ptb-100 bg-grey pdd-csts">
            <div class="container">
                <div class="section-title text-left">
                    <h2>Featured Listing</h2>
                    @if($featured_listing_count>3)
                        <a href="{{url('/featured-listing')}}" class="section-title-btn">See All <i class='bx bx-chevrons-right'></i></a>
                    @endif
                </div>
                <div class="listings-alls">
                <div class="row">
                    @if(count($featured_listing)>0)
                        @foreach($featured_listing as $key)
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="single-listing-item @if($key->type==2) bricks-borsr 
                                                                   @elseif($key->type==1) brands-brosr
                                                                   @elseif($key->type==3) full-spce-brdr
                                                                   @elseif($key->type==4) partial-brdrs
                                                                   @elseif($key->type==5) popup-list
                                                                   @elseif($key->type==6) events-yell
                                                                   @endif">
                                    <div class="listing-image">
                                        <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image"></a>
                                        </a>

                                        <div class="listing-tag">
                                            <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><b> ID: </b>#{{$key->id}}</a>
                                        </div>
                                        <span class="lis-str-cat"> @if($key->type==2) Bricks 
                                                                   @elseif($key->type==1) Brands
                                                                   @elseif($key->type==3) Full Space
                                                                   @elseif($key->type==4) Partial Space
                                                                   @elseif($key->type==5) Popup Stores
                                                                   @elseif($key->type==6) Event Fairs
                                                                   @endif
                                        </span>
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
            </div>
            </div>
        </section>
        @endif

         @if(count($featured_bricks)>0)
        <!-- Start Latest Listing Area -->
        <section class="listing-area pt-100 pb-100 indx-feturd-brk">
            <div class="container">
                <div class="section-title">
                    <h2>Featured Bricks</h2>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="listing-slides owl-carousel owl-theme">
                    

                    @foreach($featured_bricks as $key)
                    <div class="single-listing-box">
                        <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block listing-image" style="height: 360px;">
                       <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#bricks-popup" class="listing-image" style="height: 350px;"> -->
                            <img src="{{url('/')}}/uploads/files/{{$key->image}}" alt="image">
                        </a>
                        <div class="listing-badge">{{$key->no_of_openings}} Openings</div>

                        <div class="listing-content">
                            <div class="content">
                                <div class="author">
                                    <img src="{{!empty($key->userimage) ? url('/uploads/user/').'/'.$key->userimage : url('/').'/img/user.png'}}" alt="image" style="height: 40px;">
                                    <span>{{$key->fname}} {{$key->lname}}</span>
                                </div>
                                <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block">
                                <h3>
                               {{$key->name}}</h3>
                                <span class="location"><i class='bx bx-map'></i>{{$key->location_city}}</span>
                                </a>

                            </div>

                            <div class="footer-content">
                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="price-level">
                                        <!-- <span data-toggle="tooltip" data-placement="top" title="Pricey">
                                            <strong> $100 - $200 </strong>
                                        </span> -->
                                    </div>
                                    <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block">
                                    <div class="price-level">
                                        <span data-toggle="tooltip" data-placement="top">
                                           <strong> {{$key->lease_term}} {{$key->lease_term_unit}} </strong>
                                        </span>
                                    </div>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{$key->id}}" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup default-btn fillclr apply">
                                    <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#bricks-popup" class="default-btn fillclr apply"> -->Apply Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </section>
        @endif
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
                url:'{{url("/")}}'+'/get_listing_details_associated_ajax',
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