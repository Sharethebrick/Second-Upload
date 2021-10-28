@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Article Details</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Blog Area -->
        <section class="blog-details-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="blog-details-desc">
                            <div class="article-image">
                                <img src="{{url('/uploads/files')}}/{{$resource_details->file}}" alt="image" style="height: 470px;">
                                 <span class="dte-dtl">{{showOnlyDateFormat2($resource_details->created_at)}}</span>
                                 <!-- <div class="bagt-sa">Article</div> -->
                            </div>

                            <div class="article-content">

                                <h3>{{$resource_details->title}}</h3>
                                {!!$resource_details->description!!}
                            </div>



                            <div class="comments-area">
                            @if(count($comments)>0)
                                <h3 class="comments-title">{{count($comments)}} {{count($comments)==1? 'Comment': 'Comments'}}:</h3>
                                <ol class="comment-list">
                                @foreach($comments as $key)
                                    <li class="comment">
                                        <article class="comment-body">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img src="{{!empty($key->image) ? url('/uploads/user/').'/'.$key->image : url('/').'/img/user.png'}}" class="avatar" alt="image">
                                                    <b class="fn">{{$key->name}}</b>
                                                    <span class="says">says:</span>
                                                </div>

                                                <div class="comment-metadata">
                                                    <a href="#">
                                                        <span>{{showOnlyDateFormat3($key->created_at)}}</span>
                                                    </a>
                                                </div>
                                            </footer>

                                            <div class="comment-content">
                                                <p>{{$key->comment}}</p>
                                            </div>
                                        </article>                                       
                                    </li> 
                                @endforeach                             
                                </ol>
                            @else 
                                <!-- <div class="col-lg-12 col-sm-12 col-md-6">
                                    <div class="single-listing-item new-stl-lyt">
                                          <center><h4>  No Comments Found.</h4></center>
                                    </div>
                                </div>  -->
                            @endif

                                <div class="comment-respond" id="comments">
                                    <h3 class="comment-reply-title">Leave a Reply</h3>

                                    <form class="comment-form" id="resource_comment_form">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <p class="comment-notes">
                                            <span id="email-notes">Your email address will not be published.</span>
                                            Required fields are marked 
                                            <span class="required">*</span>
                                        </p>
                                        @if(Auth::check())
                                             <p class="comment-form-author">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" id="author" placeholder="Your Name*" name="name" required="required">
                                            </p>
                                            <p class="comment-form-email">
                                                <label>Email <span class="required">*</span></label>
                                                <input type="email" id="email" placeholder="Your Email*" name="email" required="required">
                                            </p>
                                            <p class="comment-form-url">
                                                <label>Website</label>
                                                <input type="url" id="url" placeholder="Website" name="website">
                                            </p>
                                            <p class="comment-form-comment">
                                                <label>Comment</label>
                                                <textarea name="comment" id="comment" cols="45" placeholder="Your Comment...*" rows="5" maxlength="65525" required="required"></textarea>
                                            </p>
                                            <input type="hidden" name="resource_id" value="{{$id}}">
                                            <p class="form-submit">
                                                <input type="submit" class="submit submit_btn" value="Post A Comment">
                                            </p>
                                        @else
                                                 <p class="form-submit">
                                                   <a href="{{url('/login')}}/?resource_id={{$id}}"> <input type="button" name="submit" id="submit" class="submit" value="Please Login First"></a>
                                                </p>
                                        @endif
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="col-lg-4 col-md-12">
                        <aside class="widget-area">
                            <section class="widget widget_search">
                                <form class="search-form" action="{{url('/search-resources')}}" method="post">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <label>
                                        <span class="screen-reader-text">Search for:</span>
                                        <input type="text" class="search-field" placeholder="Search..." name="keyword">
                                    </label>
                                    <input type="hidden" name="tag" value="">
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
                                        <a href="{{url('resource')}}?tag={{$key->id}}">{{$key->name}}</a>
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

@section('footer_scripts')
<script type="text/javascript">  
$(function($) {
    $('#resource_comment_form').validate({
    rules: {    
        name:
        {
            required:true,           
        },
        comment:
        {
            required:true,           
        },   
        email:
        {
            required: true,
            email: true 
        }
    },  
    messages: 
        {       
   
          password:
          {
            required:'Please Enter Password', 
          },         
          email: 
          {
            required: "Please Enter  Email",
            email:"Your email address must be in the format of name@domain.com"
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
            $('.submit_btn').val('Please Wait.'); 
            $('.submit_btn').prop('disabled',true);            
            $.ajax({
                    type:'POST',
                    url:'{{url("/")}}'+'/add_resource_comment',
                    data: new FormData(form),
                    contentType: false, 
                    cache: false, 
                    processData:false,
                    success:function(result)
                    { 
                        $('.submit_btn').val('Post A Comment'); 
                        $('.submit_btn').prop('disabled',false); 
                       var obj = $.parseJSON(result); 
                        if(obj.status == 1){
                            swal({title: "Success!", text: "Comment added Successfully.", type: "success"},
                                        function(){ 
                                           location.reload();
                                        }
                                     );
                            
                        }else{
                          swal({title: "Error", text: "Invalid Credentials!", type: "error"});
                        }
                    }
            });
           
        } 
        
    });
});

</script>
@stop