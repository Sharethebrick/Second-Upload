@extends('layouts.app')

@section('content')
    <!-- Start Page Title Area -->
     <div class="page-title-area page-title-bg3">
         <div class="container">
             <div class="page-title-content">
                 <h2>{{$user->name}}'s Profile</h2>
             </div>
         </div>
     </div>
     <!-- End Page Title Area -->
	<section class="dlts-prb">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="box-str-pro">
						<div class="row">
							<div class="col-md-4">
								<div class="igd-s">
									 <img src="{{!empty($user->image) ? url('/uploads/user/').'/'.$user->image : url('/').'/img/user.png'}}" class="img-usrea">
								</div>
							</div>
							<div class="col-md-8">
								<div class="box-rigrs">
									<h4 class="ttl-dri"> Basic Information </h4>
									<ul class="list-lsy">
										<li>  <b> Name:  </b>	 {{$user->name}} {{$user->last_name}}  </li>
										<li>  <b> Campany name: </b> {{$user->company_name}}  </li>
										<li>  <b> Campany address:</b>  {{$user->company_address}}  </li>
										<li>  <b> Business Number:</b>  {{$user->business_number}}  </li>
										<li>  <b> Business Type:</b>  {{$user->type_of_busines}}  </li>
										<li>  <b> Business Email address:</b>  {{$user->email}}  </li>
										<!-- <li>  <b> Email Address: </b> {{$user->email}}  </li> -->
										@if($user->website)
											<li>  <b> Website: </b> {{$user->website}}  </li>
										@endif										
										<li>  <b> Business Description: </b>  {{$user->business_desc}}  </li>
									</ul>
									@if($user->facebook_lnk || $user->twitter_lnk || $user->instagram_lnk)
									<h4 class="ttl-dri mt-4"> Social Media Accounts </h4>
									<ul class="list-lsy">
									@if($user->facebook_lnk)
										<li>  <b> Facebook: </b> {{$user->facebook_lnk}}  </li>
									@endif
									@if($user->twitter_lnk)
										<li>  <b> Twitter: </b> {{$user->twitter_lnk}} </li>
									@endif
									@if($user->instagram_lnk)
										<li>  <b> Instagram:</b> {{$user->instagram_lnk}}   </li>
									@endif
									</ul>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  
   
   
   
@endsection
@section('footer_scripts')

@stop