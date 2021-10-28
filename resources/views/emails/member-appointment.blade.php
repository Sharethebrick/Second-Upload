<h3>Hi</h3>

<p> {{ ucfirst($appointment->created_by_user->name) }} {{ $appointment_status }} the appointment.</p>
<p><b>Following are the appointment details:</b></p>


<p>
Appointment title : {{ $appointment->title }}
</p>
<p>
Appointment description : {{ $appointment->description }}
</p>
<p>
Appointment start datetime : {{ $appointment->start_datetime }}
</p>
<p>
Appointment end datetime : {{ $appointment->end_datetime }}
</p>
<p>
Check appointment : {{ route('retail.member.appointment',[ 'group_id' => $appointment->group_id ]) }}
</p>


<br>
Thanks & Regards<br>
Share The Brick Team
</p>