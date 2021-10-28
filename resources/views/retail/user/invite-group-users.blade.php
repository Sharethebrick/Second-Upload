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
                                       <strong><h5> Group Name : @isset($groupData){{$groupData->group_name}}@endisset  
                                       </h5>
                                       </strong>                                                                           
                                    </div>
                                </div>
                            </div>
                            <div class="box-main-stc">	
                                <form>
                                <div class="chat-foots">
                                    <div class="cont-all-set">
                                        <div class="form-group">
                                            <input type="hidden" name="group_id" id="group_id" value="@isset($groupData){{$groupData->id}}@endisset">
                                            <select class="form-control multipleSelects " data-placeholder="Choose a user..." name="invited_to[]" multiple>
                                                    @if(count($users) > 0)
                                                        @foreach($users as $key)
                                                       
                                                            <option value="{{$key['id']}}">{{$key['name']}}&lt;{{$key['email']}}&gt;</option>
                                                        @endforeach    
                                                    @endif                                                                                          
                                            </select> 
                                            <a href="javascript:void(0)" class="sbmt-s invite_btn"> <i class="fa fa-plus"></i> <span>Add</span></a>  
                                        </div>                                  
                                    </div>
                                </div>
                                </form>
                            </div> 
                            <div>
                                <p> Group Users</p>
                                <ul class="list-group">
                                @if(count($groupUsers) > 0)
                                    @foreach($groupUsers as $gUsers)
                                    <li class="list-group-item">{{$gUsers->name." ".$gUsers->last_name}}</li>
                                    @endforeach
                                @else <li>No User added</li>
                                @endif
                                </ul> 
                            </div>                     
                        </div>
                    </div>
                </div>
            </div>
        </section>      
@endsection
@section('footer_scripts')

<link rel="stylesheet" href="{{url('/')}}/css/component-chosen.css" />
<script src="{{url('/')}}/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
   $(function(){
        $('.multipleSelects').chosen({
              allow_single_deselect: true,
              width: '100%',
        });
    });

    //save invite User

    $(document).on('click', '.invite_btn', function() {
    var users = jQuery('.multipleSelects').val();
   
    var dis = $(this);
    if(users !== null){
        $(this).find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
        $(this).prop('disabled',true);
        var  group_id = jQuery('#group_id').val();
        var form_data = new FormData();
        form_data.append("users", users); 
        form_data.append("group_id", group_id); 
        form_data.append('_token', '{{ Session::token() }}');
       
        $.ajax({
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,       
                type: 'post',
                url:'{{url("/")}}'+'/retail/save-group-users',
                success:function(result)
                {
                    var res = JSON.parse(result);	
                    $('.multipleSelects').val('');
                    dis.prop('disabled',false);
                    dis.find('span').html('Add');
                    if(res.status == 1){	          
                        swal({title: "Success!", text: "User added in group Successfully.", type: "success"},
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
      	swal("Please select any one user");
    }
});

    
</script>

@stop
