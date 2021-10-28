@extends('layouts.app')

@section('content')

     <!-- Start Main Banner Area -->
        <div class="main-banner banner-bg1 " >
            <div class="container">
                <div class="main-banner-content">
                    <h1>{!!$page[9]->value!!}</h1>

                    <div class="main-search-wrap">
                        <form action="{{url('')}}/{{getUrl()}}/searched-listings" method="GET">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="row">

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label><i class='bx bxs-keyboard'></i></label>
                                    <input type="text" placeholder="Search here..." name="keyword">
                                </div>
                            </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label><a href="#"><i class='bx bx-current-location'></i></a></label>
                                        <input type="text" placeholder="Location" class="pl-28" name="location">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label><i class='bx bx-slider'></i></label>
                                        <select name="type" class="form-control">
                                            <option value="">All Categories</option>
                                            <option value="2">Bricks</option>
                                            <option value="1">Brands</option>                                
                                            <option value="3">Full Space</option>
                                            <option value="4">Consignment & Partial Space</option>
                                            <option value="5">Pop Up Shops</option>
                                           <!--  <option value="6">Events Fairs</option> -->                              
                                        </select>
                                    </div>
                                </div>  
                                <!--div class="col-lg-3 col-md-6 pl-0">
                                    <div class="form-group">
                                        <label><i class='bx bx-list-ul'></i></label>
                                        <select>
                                            <option>Retail Category</option>
                                            <option value="6">Accessories </option>
                                            <option value="1">Art </option>
                                            <option value="2">Beauty </option>
                                            <option value="9">Education </option>
                                            <option value="3">Fashion </option>
                                            <option value="7">Food and Drink </option>
                                            <option value="8">Footwear </option>
                                            <option value="10">Games and Toys </option>
                                            <option value="4">Home and Living </option>
                                            <option value="5">Jewelry </option>
                                            <option value="11">Jewelry </option>
                                            <option value="12">Service Hair/Body </option>
                                        </select>
                                    </div>
                                </div-->                                    
                            </div>

                            <div class="main-search-btn">
                                <button type="submit">Search <i class='bx bx-search-alt'></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

             @include('includes.pagetitle')
        </div>
        <!-- End Main Banner Area -->


        <!-- Start About Area -->
        <section class="about-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <!-- <div class="about-content">
                            <span class="sub-title">About Us</span>
                            <h2>Sed ut perspiciatis unde</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris </p>

                            <div class="features-text">
                                <p><i class='bx bx-arrow-to-right'></i> Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
                                <p><i class='bx bx-arrow-to-right'></i> Accusantium doloremque laudantium, totam rem aperiam</p>
                                <p><i class='bx bx-arrow-to-right'></i> Eaque ipsa quae ab illo inventore veritatis et</p>
                                <p><i class='bx bx-arrow-to-right'></i> quasi architecto beatae vitae dicta sunt explicabo</p>
                            </div>
                            <a href="{{url('/aboutus')}}" class="default-btn fillclr about-btn-indx">Read More</a>
                        </div> -->
                        {!!$page[5]->value!!}
                        <a href="{{url('')}}/{{getUrl()}}/aboutus" class="default-btn fillclr about-btn-indx">Read More</a>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="about-image">
                            <img src="{{url('/')}}/img/{{$page[6]->value}}" class="shadow" alt="image">
                            <img src="{{url('/')}}/img/{{$page[7]->value}}" class="shadow" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Area -->
        @if(count($featured_listing)>0)
        <!-- Start Listing Area -->
        <section class="listing-area pb-5 ptb-100 bg-grey pdd-csts">
            <div class="container">
                <div class="section-title text-left">
                    <h2>Featured Listing</h2>
                    @if($featured_listing_count>3)
                        <a href="{{url('')}}/{{getUrl()}}/featured-listing" class="section-title-btn">See All <i class='bx bx-chevrons-right'></i></a>
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
        <!-- End Listing Area -->
        @if(!Auth::check())
        <!-- Start Sign Up Area -->
        <section class="video-area  sign-sec-indx ptb-100">
            <div class="container">
                <div class="video-content">
                    <!-- <h2>Sign Up As User And Book Listing</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p> -->
                    {!!$page[10]->value!!}
                     <a href="{{url('/signup')}}?type=2" class="default-btn mr-3"><i class="bx bxs-log-in"></i> Sign Up As User</a>
               </div>
            </div>
        </section>
        <!-- End Sign Up Area -->
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
        @if(!Auth::check())
        <!-- Start Sign Up Area -->
        <section class="video-area  sign-sec-indx ptb-100">
            <div class="container">
                <div class="video-content">
                    {!!$page[11]->value!!}
               <a href="{{url('/signup')}}?type=1" class="default-btn mr-3"><i class="bx bxs-log-in"></i> Sign Up As Landlord</a>
               </div>
            </div>
        </section>
        <!-- End Sign Up Area -->
        @endif
<section class="map-cont-indx">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
               <div class="register-form">
                   <div class="form-title text-center">
                        {!!$page[12]->value!!}
                   </div>
                    <div class="form-group rgstr-inr-sec">
                            <form id="contactform">
                             <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Name <span>*</span></label>
                                            <input type="text" name="name" id="name" class="form-control" required placeholder="Your name">
                                          
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label>Email <span>*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" required  placeholder="Your email address">
                                      
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <label>Phone Number <span>*</span></label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" required placeholder="Your phone number">
                                         
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Your Message <span>*</span></label>
                                            <textarea name="message" id="message" cols="30" rows="5" required  class="form-control" placeholder="Write your message..."></textarea>
                                        
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 text-left">
                                        <button type="submit" class="submit_btn default-btn">Send Message</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
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
        
        <div class="modal fade" id="bricks-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-review modal-lg" role="document">
            <div class="modal-content contnt-design-new">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listing Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-6">
                            <div class="single-listing-item new-stl-lyt bg-syr">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block lists heg-170">
                                                <img src="{{url('/')}}/img/6.png" alt="image">
                                            </a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block">Full Space</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="listing-content pl-0 pb-10">
                                            <h3 class="font-adds"><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Full Space in Central </a> <span class="addc"> | Associated Listing </span></h3>
                                            <p class="mt-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore</p>
                                        </div>
                                        <div class="listing-box-footer br-st-a ptb-10">
                                            <span class="add-bt"> <b> Listed By: </b> demouser123 <span>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="bts-aea"> View Details </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="listing-details-image-slides owl-carousel owl-theme heigt-ctaa">
                                <div class="listing-details-image text-center">
                                    <img src="{{url('/')}}/img/1.jpg" alt="image">
                                </div>

                                <div class="listing-details-image text-center">
                                    <img src="{{url('/')}}/img/2.jpg" alt="image">
                                </div>

                                <div class="listing-details-image text-center">
                                    <img src="{{url('/')}}/img/3.jpg" alt="image">
                                </div>

                                <div class="listing-details-image text-center">
                                    <img src="{{url('/')}}/img/4.jpg" alt="image">
                                </div>

                                <div class="listing-details-image text-center">
                                    <img src="{{url('/')}}/img/5.jpg" alt="image">
                                </div>
                                <div class="listing-details-image text-center">
                                    <img src="{{url('/')}}/img/8.jpg" alt="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-listing-item new-stl-lyt pop-bxs m-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="listing-content pl-0 pt-0">
                                            <h3><a href="{{url('/fullspacedetails')}}" class="d-inline-block">Event Space in Hougang Avenue</a></h3>
                                            <div class="mt-2 mb-2">
                                                <span class="lista-a"><b> Owner: </b> John Smith </span>
                                                <span class="price-a">$1500 /month </span>
                                            </div>
                                            <p class="mt-2 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="location"><i class="bx bx-map"></i> 40 Down Town Street, California, USA</span>
                                            </div>
                                        </div>
                                        <a href="{{url('/brickdetails')}}" class="bts-aea float-left font-14"> View Full Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>

@endsection
@section('footer_scripts')
<script type="text/javascript">  
$(function($) {
    $('#contactform').validate({
    rules: {    
        name:
        {
            required:true,           
        },   
        email:
        {
            required: true,
            email: true 
        },
        message:
        {
            required: true
        },
        phone_number:{
            required: true,
           // digits:true 
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
                if (element.parent('.input-group').length) {
                  error.insertAfter(element.parent());
                } else {
                  error.insertAfter(element);
               }
             },
        submitHandler: function(form) 
        { 
           // alert('validate');
            $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);            
            $.ajax({
                    type:'POST',
                    url:'{{url("/")}}'+'/do_contactus',
                    data: new FormData(form),
                    contentType: false, 
                    cache: false, 
                    processData:false,
                    success:function(result)
                    { 
                      $('.submit_btn').html('Send Message').prop('disabled',false); 
                        if(result == '1'){
                             swal({title: "Success", text: "Thanks, We will be in touch soon.", type: "success"},
                                           function(){ 
                                               location.reload();
                                           }
                                         ); 
                        }else{
                          swal({title: "Error", text: "Error while submitting your query, Please try later.", type: "error"});
                        }
                    }
            });
        } 
        
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