@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Chat</h2>
                </div>
            </div>
        </div>
        <section class="login-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-box-als">
                            <div class="messages-cont">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="msgs-all">
                                            <div class="chat-foots">
                                                <div class="cont-all-set">
                                                    <input type="text" class="fld-sa group_name" name='group_name' placeholder="Group Name ">
                                                    <a href="javascript:void(0)" admin-id=""  class="sbmt-s add_group_btn"> <i class="fa fa-plus"></i> <span>Add</span></a>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-main-stc">	
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Group Name</th>                                
                                        <th>Created At</th>
                                        <th>Add Members</th>
                                        <th>Chat</th>
                                        <th>Action</th>
                                        <th>Appointments</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($groups)>0)
                                         <!-- Unread group msg -->
                                            @foreach($groups as $group)
                                            @if(in_array($group->id, $unseenMsg))
                                            <tr  style="background-color:#e6e3e3">
                                                <td>{{$group->group_name}}</td>
                                                <td>{{date('d-M-Y', strtotime($group->created_at))}}</td>
                                                <td><a class= "badge badge-success" href="{{ url(getUrl().'/invite-group-users/'.$group->id) }}">Add</a>
                                           
</td>
                                                <td><a class= "badge badge-primary" href="{{ url(getUrl().'/group-chat/'.$group->id) }}">Send Mesaage</a></td>
                                                <td><a class="badge badge-success markasread" id="markasread" data-id="{{$group->id}}" href="">Mark as Read</a></td>
                                                <td>
                                                        <a class="badge badge-success" href="{{ route('retail.member.appointment',[ 'group_id' => $group->id ]) }}"> Appointment </a>
</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                                <!-- Read group msg -->
                                            @foreach($groups as $group)
                                                @if(!in_array($group->id, $unseenMsg))
                                                <tr>
                                                    <td>{{$group->group_name}}</td>
                                                    <td>{{date('d-M-Y', strtotime($group->created_at))}}</td>
                                                    <td><a class= "badge badge-success" href="{{ url(getUrl().'/invite-group-users/'.$group->id) }}">Add Members</a>
                                            
    </td>
                                                    <td><a class= "badge badge-primary" href="{{ url(getUrl().'/group-chat/'.$group->id) }}">Send Mesaage</a></td>
                                                    <td><a class="badge badge-success markasread" id="markasread" data-id="{{$group->id}}" href="">Mark as Read</a></td>
                                                    <td>
                                                            <a class="badge badge-success {{ get_group_members( $group->id )->count() ? '' : 'no-member-added' }}" href="{{ get_group_members( $group->id )->count() ? route('retail.member.appointment',[ 'group_id' => $group->id ]) : '#' }}"> Appointment </a>
    </td>
                                                </tr>
                                                @endif
                                            @endforeach


                                            @else<tr ><td style="text-align:center" colspan="6">No record Found</td></tr>
                                        @endif
                                        <!-- <tr><th></th><th></th><th>Other Groups</th><th></th><th></th></tr>   -->
                                   
                                        @if(count($getOtherGroups)>0)
                                             <!-- Unread group msg -->
                                            @foreach($getOtherGroups as $oGroup)

                                            <tr  style="background-color:#e6e3e3">
                                                <td>{{$oGroup->group_name}}</td>
                                                <td>{{date('d-M-Y', strtotime($oGroup->created_at))}}</td>
                                                <td></td>
                                                <!-- <td><a class= "badge badge-success" href="{{ url(getUrl().'/invite-group-users/'.$oGroup->id) }}">Invite</a></td> -->
                                                <td><a class= "badge badge-primary" href="{{ url(getUrl().'/group-chat/'.$oGroup->id) }}">Send Mesaage</a></td>
                                                <td><a class="badge badge-success markasread"  data-id="{{$oGroup->id}}" href="">Mark as Read</a></td>
                                            </tr>
                                            @endforeach 

                                             <!-- Read other group msg -->
                                            @foreach($getOtherGroups as $oGroup)
                                                @if(!in_array($oGroup->id, $unseenMsg))
                                                <tr  >
                                                    <td>{{$oGroup->group_name}}</td>
                                                    <td>{{date('d-M-Y', strtotime($oGroup->created_at))}}</td>
                                                    <td></td>
                                                    <!-- <td><a class= "badge badge-success" href="{{ url(getUrl().'/invite-group-users/'.$oGroup->id) }}">Invite</a></td> -->
                                                    <td><a class= "badge badge-primary" href="{{ url(getUrl().'/group-chat/'.$oGroup->id) }}">Send Mesaage</a></td>
                                                    <td><a class="badge badge-success markasread"  data-id="{{$oGroup->id}}" href="">Mark as Read</a></td>
                                                </tr>
                                                @endif
                                            @endforeach                                       
                                        @endif                            
                                    </tbody>
                                </table>                              
                            </div>                       
                        </div>
                    </div>
                </div>
            </div>
        </section>  
        
@endsection

@section('footer_scripts')

<script type="text/javascript">
$(document).on('click', '.add_group_btn', function() {
    var groupName = jQuery('.group_name').val();
    var dis = $(this);
    if(groupName != ''){
        $(this).find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
        $(this).prop('disabled',true);
        // var admin_id = $(this).attr('admin-id');
        var form_data = new FormData();
        form_data.append("groupName", groupName); 
        // form_data.append("admin_id", admin_id); 
        form_data.append('_token', '{{ Session::token() }}');
       
        $.ajax({
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,       
                type: 'post',
                url:'{{url("/")}}'+'/retail/save-group',
                success:function(result)
                { 				
                    var res = JSON.parse(result);
                    						
                    $('.group_name').val('');
                    dis.prop('disabled',false);
                    dis.find('span').html('Add');
                    if(res.status == 1){	
                        swal({title: "Success!", text: "Group added Successfully.", type: "success"},
                                        function(){
                                           location.reload();
                                        }
                                     );
                    }else{
                        swal({title: "Error", text: "Oops! Something went wrong.", type: "error"});
                    }	                     
                }
			});
    }else{
      	swal("Please type any group name!");
    }
});

$(".no-member-added").on("click",function(){
    swal({title: "Error", text: "No member added to group yet.", type: "error"});
});

//Mark as read
jQuery(".markasread").click(function(event) {
    event.preventDefault();
   
    var group_id = $(this).data("id") ;
   
    $.ajax({
                
                data: {'group_id':group_id,"_token": "{{ csrf_token() }}"},       
                type: 'post',
                url:'{{url("/")}}'+'/retail/mark-as-read',
                success:function(result)
                { 	

                    swal({title: "Success!", text: "", type: "success"},
                                        function(){
                                           location.reload();
                                        }
                                     );			
                                   
                }
			});       
});
   
</script>
@stop

