@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Help</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

    <!-- Start FAQ Area -->
        <section class="faq-area ptb-100">
            <div class="container">
            <div class="section-title">
                    <span class="sub-title">faq</span>
                    <h2>Frequently Asked Questions</h2>
                </div>
            @if(count($faq_cat)>0)
                @foreach($faq_cat as $key)
                     <h4 class="subheading">{{$key->name}}</h4>
                        <div class="tab faq-accordion-tab mb-5">
                  
                        <div class="tabs-item">
                            <div class="faq-accordion">
                                <ul class="accordion">
                                    @if(count($key->faq)>0)
                                     @foreach($key->faq as $value)
                                        <li class="accordion-item">
                                            <a class="accordion-title @if($loop->first && $key->active == 1) active @endif" href="javascript:void(0)">
                                                <i class='bx bx-chevron-down'></i>
                                              {{$value->question}}
                                            </a>
            
                                            <div class="accordion-content @if($loop->first && $key->active == 1) show @endif">
                                                <p>{{$value->answer}}</p>
                                            </div>
                                        </li>
                                     @endforeach
                                    @else
                                         <div class="col-lg-12 col-sm-12 col-md-6">
                                            <div class="single-listing-item new-stl-lyt">
                                                  <center><h4>  No Data Found.</h4></center>
                                            </div>
                                        </div> 
                                    @endif                         
                                </ul>
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
        </section>
        <!-- End FAQ Area -->


@endsection