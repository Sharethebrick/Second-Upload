@extends('layouts.app')

@section('content')
<style type="text/css">
.fc-event-time, .fc-event-title {
padding: 0 1px;
white-space: nowrap;
}

.fc-title {
white-space: normal;
}</style>
<div class="page-title-area page-title-bg3">
    <div class="container">
        <div class="page-title-content">
            <h2>Reminders</h2>
        </div>
    </div>
</div>
 <!-- Start Checkout Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="bg-box-als">
                    
                        
                        <div class="row">
                          
                            <div class="col-lg-12 col-md-12">
                                <form id="add_reminder">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <div class="billing-details">
                                    <h3 class="title font-strs">Create Reminder </h3>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Date and Time <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="datetimepicker" name="reminder_at" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 ">
                                            <div class="form-group">
                                                <label>Reminder for Members <span class="required">*</span></label>
                                                <select class="form-control multipleSelect1 " data-placeholder="Choose a Member..." name="reminder_to[]" multiple>
                                                    @foreach($users as $key)
                                                        <option value="{{$key->id}}">{{$key->name}}&lt;{{$key->email}}&gt;</option>
                                                    @endforeach
                                                   
                                                </select>
                                                <div class="collab_type_class"></div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-lg-12 col-md-12">
                                            <button class="btn btn-save-stt submit_btn" type="submit"> Save </button>
                                        </div>
                                    </div>
                                </div>
                               </form>
                            </div>
                            <div id="container"></div>
                        </div>
                   </div>
            </div>

        </section>

@endsection
@section('footer_scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
jQuery('#datetimepicker').datetimepicker({
    minDate:0, // disable past date
});
$.validator.setDefaults({ ignore: ":hidden:not(select)" });
$('#add_reminder').validate({
    ignore: [],
    rules: {
        'reminder_to[]':
        {
            required:true
        },
        title:
        {
            required:true
        },
        reminder_at:
        {
            required:true
        },
        
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
                  
               if(element.attr("name") == "reminder_to[]"){
                    error.insertAfter(".collab_type_class");
                }else{
                    error.insertAfter(element);
                }
            },
        submitHandler: function(form)
        {
               var formData = new FormData($("#add_reminder")[0]);
               $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
               $.ajax({
                        url:'{{url("/")}}/{{getUrl()}}'+'/save-reminder',
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: 'json',
                        success:function(result)
                        {                          
                          $('.submit_btn').html('Save').prop('disabled',false);
                             if(result.status == 1){
                                
                                swal({title: "Success!", text: "Reminder created Successfully.", type: "success"},
                                  function(){
                                     location.reload();
                                  }
                               );                         
                          }else{
                            swal({title: "Error", text: "Oops! Something went wrong. Please try again later", type: "error"});
                          }
                          
                    }
                });
        }

    });
</script>



<link rel="stylesheet" href="{{url('/')}}/css/component-chosen.css" />
<script src="{{url('/')}}/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
   $(function(){
        $('.multipleSelect1').chosen({
              allow_single_deselect: true,
              width: '100%',
        });

    });
   
</script>

@stop