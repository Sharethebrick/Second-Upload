@extends('layouts.app')

@section('content')

      <!-- Start Main Banner Area -->
        <div class="main-banner banner-bg1 " >
            <div class="container">
                <div class="main-banner-content">
                    <h1>Share, Grow and Succeed Together</h1>

                    <div class="main-search-wrap">
                        <form action="{{url('/searched-listings')}}" method="POST" id="search_listing">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class="row">

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label><i class='bx bxs-keyboard'></i></label>
                                    <input type="text" placeholder="Search here..." name="keyword" value="@if(isset($post)){{$post['keyword']}}@endif">
                                </div>
                            </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label><a href="#"><i class='bx bx-current-location'></i></a></label>
                                        <input type="text" placeholder="Location" class="pl-28" name="location" value="@if(isset($post)){{$post['location']}}@endif">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label><i class='bx bx-slider'></i></label>
                                        <select name="type" class="form-control">
                                            <option value="">All Categories</option>
                                            <option value="2" @if(isset($post) && $post['type'] == '2') selected @endif>Bricks</option>
                                            <option value="1" @if(isset($post) && $post['type'] == '1') selected @endif>Brands</option>                                
                                            <option value="3" @if(isset($post) && $post['type'] == '3') selected @endif>Full Space</option>
                                            <option value="4" @if(isset($post) && $post['type'] == '4') selected @endif>Partial Space</option>
                                            <option value="5" @if(isset($post) && $post['type'] == '5') selected @endif>Pop Up Shops</option>
                                            <option value="6" @if(isset($post) && $post['type'] == '6') selected @endif>Events Fairs</option>                              
                                        </select>
                                    </div>
                                </div>  
                                <input type="hidden" name="is_featured" value="{{$is_featured}}">
                                <input type="hidden" name="search_save" value="1">
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
                                <button type="submit" class="search_submit">Search <i class='bx bx-search-alt'></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

             @include('includes.pagetitle')
        </div>
        <!-- End Main Banner Area -->


        <!-- Start About Area -->
        <section class="listing-area pb-5 ptb-100 bg-grey pdd-csts">
            <div class="container">
                <div class="row align-items-center">
                    

                    <div class="col-lg-12 col-md-12">
                        
                        <div class="listings-alls">
                            <div class="row searched_data">
                            @if(count($listing)>0)
                            @foreach($listing as $key)
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
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <a href="javascript:void(0);" class="default-btn fillclr about-btn-indx load_more" style="float: right; {{ $total_count>items_count()? '' : 'display: none;' }}" data-id="{{items_count()}}" total="{{$total_count}}">Load More</a>  
                                </div>
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

<script type="text/javascript" src="{{url('/')}}/js/jquery.multi-select.js"></script>
<script type="text/javascript">
        $(function(){
            $('#people').multiSelect({
                'noneText': 'Ideal Uses',
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