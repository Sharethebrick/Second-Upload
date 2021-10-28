<h3>Hi {{$username}}</h3>
<h4>{{Auth::User()->name}} has @if($status == 2) Rejected @else Accepted @endif your booking request for #{{$list_details->id}} "{{$list_details->name}}" ({{$list_details->location_city}}):</h4>
<p>
{{$link}}
</p>
<p>
Thanks & Regards<br>
Share The Brick Team
</p>