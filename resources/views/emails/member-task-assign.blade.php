<h3>Hi</h3>

<p> {{ ucfirst($task->assigned_by_user->name) }},</p>
<p>You have assigned a new Task</p>
<p><b>Following are the task details:</b></p>


<p>
Task description:{{ $task->description }}
</p>
@if(!empty($task->note))
<p>
Task Note:
    {{ $task->note }}
</p>
@endif
<p>
Due Date:{{ $task->start_datetime }}
</p>
<p>
Check task: {{ route('retail.member.task') }}
</p>


<br>
Thanks & Regards<br>
Share The Brick Team
</p>