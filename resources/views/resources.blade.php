@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Resources</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Blog Area -->
        <section class="blog-area ptb-100 blgsa">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row blogs-all-stra">
                        @if(count($allresources)>0)
                        @foreach($allresources as $key)
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-post box-postra">
                                    <div class="post-image">
                                        <a href="{{url('/resource_details')}}/{{$key->id}}">
                                            <img src="{{url('/uploads/files')}}/{{$key->file}}" alt="image">
                                        </a>
                                        <div class="date">
                                            <span>{{showOnlyDateFormat2($key->created_at)}}</span>
                                        </div>
                                        <!-- <div class="bagt-sa">Article</div> -->
                                        @if(count($key->tags_used)>0)
										<div class="scr-scts"> 
                                            @foreach($key->tags_used as $value)
    											<a href="#"> {{$value->name}}</a>
                                            @endforeach
										</div>
                                        @endif
                                    </div>
        
                                    <div class="post-content">
                                        <h3><a href="{{url('/resource_details')}}/{{$key->id}}">{{$key->title}}</a></h3>
                                        <p class="mb-0 mt-2">{!!Getdesc($key->description,100,1)!!}</p>
                                        <a href="{{url('/resource_details')}}/{{$key->id}}" class="details-btn">Read More</a>
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
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <aside class="widget-area">
                            <section class="widget widget_search">
                                <form class="search-form" action="{{url('/search-resources')}}" method="post">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <label>
                                        <span class="screen-reader-text">Search for:</span>
                                        <input type="text" class="search-field" placeholder="Search..." name="keyword" value="{{$keyword}}">
                                    </label>
                                    <input type="hidden" name="tag" value="{{$tag_searched}}">
                                    <button type="submit"><i class="bx bx-search-alt"></i></button>
                                </form>
                            </section>

                            <section class="widget widget_bricks_posts_thumb">
                                <h3 class="widget-title">Popular Articles</h3>
                                @if(count($popular)>0)
                                 @foreach($popular as $key)

                                <article class="item">
                                    <a href="{{url('/resource_details')}}/{{$key->id}}" class="thumb">
                                        <span class="fullimage cover" role="img" style="background-image: url({{url('/uploads/files')}}/{{$key->file}})"></span>
                                    </a>
                                    <div class="info">
                                        <span>{{showOnlyDateFormat2($key->created_at)}}</span>
                                        <h4 class="title usmall"><a href="{{url('/resource_details')}}/{{$key->id}}">{{$key->title}}</a></h4>
                                        {!!Getdesc($key->description,35,1)!!}
                                    </div>

                                    <div class="clear"></div>
                                </article>
                                @endforeach
                                 @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-listing-item new-stl-lyt">
                                              <center><h4>  No Data Found.</h4></center>
                                        </div>
                                    </div> 
                                @endif
                            </section>

                            <section class="widget widget_tag_cloud">
                                <h3 class="widget-title">Tags</h3>
                                 @if(count($tags)>0)                                
                                    <div class="tagcloud">
                                     @foreach($tags as $key)
                                        <a href="@if($keyword){{url('resource')}}?tag={{$key->id}}&keyword={{$keyword}}@else{{url('resource')}}?tag={{$key->id}} @endif" @if($tag_searched == $key->id) style="color: #fff; background: #088dd3;" @endif>{{$key->name}}</a>
                                     @endforeach
                                    </div>
                                 @else
                                    <div class="col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-listing-item new-stl-lyt">
                                              <center><h4>  No Data Found.</h4></center>
                                        </div>
                                    </div> 
                                @endif
                            </section>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Blog Area -->

@endsection