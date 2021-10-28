var errors = ['',null,undefined];
var BASE_URL = $("#BASE_URL").val();

$(function() {
  $("#admin-login-form").validate({
    // Specify validation rules
    rules: {
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      }
    },
    // Specify validation error messages
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
      email: {
        required: "Please enter email address",
        email: "Please enter a valid email address"
      }
    },
    submitHandler: function(form) {
      $(".login-errors").hide().html('');
      $(".login-default-btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/admin_do_login',
            type: 'POST',
            dataType: 'json',
            data: $('form#admin-login-form').serialize(),
            success: function(result) {
              $(".login-default-btn").html('Sign in').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){                  
                  window.location.href = BASE_URL+'/admin/dashboard';
                }
                else{
                  $(".login-errors").show().html('Invalid credentials.');
                }
            }            
        });
    }
  });
});

$(document).on('show.bs.modal','#act_deact_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  var modal_title = user_status == '1' ? 'User Activation' : (user_status == '2' ? 'Delete User' : 'User Deactivation');
  var modal_body = user_status == '1' ? 'Do you want to activate this user?' : (user_status == '2' ? 'Do you want to delete this user?' : 'Do you want to deactivate this user?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});
$(document).on('show.bs.modal','#act_deact_cat_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  var modal_title = user_status == '1' ? 'Category Activation' : (user_status == '2' ? 'Delete Category' : 'Category Deactivation');
  var modal_body = user_status == '1' ? 'Do you want to activate this category?' : (user_status == '2' ? 'Do you want to delete this category?' : 'Do you want to deactivate this category?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});
$(document).on('show.bs.modal','#act_deact_tag_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  var modal_title = user_status == '1' ? 'Tag Activation' : (user_status == '2' ? 'Delete Tag' : 'Tag Deactivation');
  var modal_body = user_status == '1' ? 'Do you want to activate this Tag?' : (user_status == '2' ? 'Do you want to delete this Tag?' : 'Do you want to deactivate this Tag?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});
$(document).on('show.bs.modal','#act_deact_resource_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  var modal_title = user_status == '1' ? 'Resource Activation' : (user_status == '2' ? 'Delete Resource' : 'Resource Deactivation');
  var modal_body = user_status == '1' ? 'Do you want to activate this Resource?' : (user_status == '2' ? 'Do you want to delete this Resource?' : 'Do you want to deactivate this Resource?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});
$(document).on('show.bs.modal','#act_deact_resource_comment_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  var modal_title = user_status == '1' ? 'Comment Activation' : (user_status == '2' ? 'Delete Comment' : 'Comment Deactivation');
  var modal_body = user_status == '1' ? 'Do you want to activate this Comment?' : (user_status == '2' ? 'Do you want to delete this Comment?' : 'Do you want to deactivate this Comment?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});
$(document).on('show.bs.modal','#act_deact_partial_cat_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  var modal_title = user_status == '1' ? 'Category Activation' : (user_status == '2' ? 'Delete Category' : 'Category Deactivation');
  var modal_body = user_status == '1' ? 'Do you want to activate this category?' : (user_status == '2' ? 'Do you want to delete this category?' : 'Do you want to deactivate this category?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});
$(document).on('show.bs.modal','#act_deact_space_cat_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  var field = button.data('field');
  // alert(field);
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  $("#a_user_field").val(field);
  var modal_title = user_status == '1' ? 'Category Activation' : (user_status == '2' ? 'Delete Category' : 'Category Deactivation');
  if(field != 'delete'){
    var modal_body = user_status == '1' ? 'Do you want to activate this category for '+field+'?' : (user_status == '2' ? 'Do you want to delete this category?' : 'Do you want to deactivate this category for '+field+'?');
  }else{
    var modal_body = user_status == '1' ? 'Do you want to activate this category?' : (user_status == '2' ? 'Do you want to delete this category?' : 'Do you want to deactivate this category?');
  }
  
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});
$(document).on('show.bs.modal','#act_deact_ques_modal', function (event) {
  var button = $(event.relatedTarget);
  var user_id = button.data('id');
  var user_status = button.data('value');
  $("#a_user_id").val(user_id);
  $("#a_user_status").val(user_status);
  var modal_title = user_status == '1' ? 'Question Activation' : (user_status == '2' ? 'Delete Question' : 'Question Deactivation');
  var modal_body = user_status == '1' ? 'Do you want to activate this question?' : (user_status == '2' ? 'Do you want to delete this question?' : 'Do you want to deactivate this question?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});

$(document).on('show.bs.modal','#change_status_list_modal', function (event) {
  var button = $(event.relatedTarget);
  var listing_id = button.data('id');
  var listing_status = button.data('value');
  $("#a_listing_id").val(listing_id);
  $("#a_listing_status").val(listing_status);
  var modal_title = listing_status == '1' ? 'Approve Listing' : (listing_status == '0' ? 'Dis-approve Listing' : 'Delete Listing');
  var modal_body = listing_status == '1' ? 'Do you want to approve this listing?' : (listing_status == '0' ? 'Do you want to dis-approve this listing?' : 'Do you want to delete this listing?');
  $(".act_modal_title").html(modal_title);
  $(".act_modal_body").html(modal_body);
});

$(document).on('show.bs.modal','#edit_featured_prop', function (event) {
  var button = $(event.relatedTarget);
  var listing_id = button.data('id');
  var listing_status = button.data('value');
  $("#f_listing_id").val(listing_id);
  $("#f_listing_status").val(listing_status);
  var modal_body = listing_status == '1' ? 'Do you want to add this listing to featured listings?' : 'Do you want to remove this listing to featured listings?';
  $(".feat_modal_body").html(modal_body);
});

$(document).on('show.bs.modal','#app_dis_booking_modal', function (event) {
  var button = $(event.relatedTarget);
  var booking_id = button.data('id');
  var booking_status = button.data('value');
  $("#a_booking_id").val(booking_id);
  $("#a_booking_status").val(booking_status);
  var modal_title = booking_status == '1' ? 'Approve Booking' : 'Reject Booking';
  var modal_body = booking_status == '1' ? 'Do you want to approve this booking?' : 'Do you want to reject this booking?';
  $(".ap_modal_title").html(modal_title);
  $(".ap_modal_body").html(modal_body);
});

$(document).on('show.bs.modal','#del_enquiry_modal', function (event) {
  var button = $(event.relatedTarget);
  var enq_id = button.data('id');
  $("#enq_id").val(enq_id);
});

$(document).on('show.bs.modal','#delete_loc_modal', function (event) {
  var button = $(event.relatedTarget);
  var loc_id = button.data('id');
  $("#d_location_id").val(loc_id);
});

$(document).on('show.bs.modal','#reject_verif_modal', function (event) {
  var button = $(event.relatedTarget);
  var ver_id = button.data('id');
  var ver_status = button.data('value');
  $("#d_verify_id").val(ver_id);
  $("#d_verify_status").val(ver_status);
  if(ver_status == '2'){
    $(".act_modal_body").html('Do you want to reject this verification?<br>After this, user has to upload another verification.');
    $(".act_modal_title").html('Reject Verification');
  }
  else{
    $(".act_modal_body").html('Do you want to accept this verification?');
    $(".act_modal_title").html('Accept Verification');
  }
});

$(document).on('show.bs.modal','#del_flag_modal', function (event) {
  var button = $(event.relatedTarget);
  var del_id = button.data('id');
  $("#del_flag_id").val(del_id);
});

$(document).on('click','#confirm_reject_verification',function(){
  $("#confirm_reject_verification").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var ver_id = $("#d_verify_id").val();
  var ver_status = $("#d_verify_status").val();
  $.ajax({
        url: BASE_URL+'/admin/update_verification',
        type: 'POST',
        dataType: 'json',
        data: {ver_id : ver_id, status : ver_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_reject_verification").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});

$(document).on('click','#confirm_apr_booking_action',function(){
  $("#confirm_apr_booking_action").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var booking_id = $("#a_booking_id").val();
  var booking_status = $("#a_booking_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_booking_status',
        type: 'POST',
        dataType: 'json',
        data: {booking_id : booking_id,booking_status : booking_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_apr_booking_action").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert(result.msg);
            }
        }            
    });
});

$(document).on('click','#confirm_location_delete',function(){
  $("#confirm_location_delete").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var location_id = $("#d_location_id").val();
  $.ajax({
        url: BASE_URL+'/admin/delete_location',
        type: 'POST',
        dataType: 'json',
        data: {location_id : location_id, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_location_delete").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});

$(document).on('click','#confirm_enq_delete',function(){
  $("#confirm_enq_delete").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var enq_id = $("#enq_id").val();
  $.ajax({
        url: BASE_URL+'/admin/delete_enquiry',
        type: 'POST',
        dataType: 'json',
        data: {enq_id : enq_id, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_enq_delete").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});

$(document).on('click','#confirm_flag_delete',function(){
  $("#confirm_flag_delete").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var flag_id = $("#del_flag_id").val();
  $.ajax({
        url: BASE_URL+'/admin/delete_flag',
        type: 'POST',
        dataType: 'json',
        data: {flag_id : flag_id, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_flag_delete").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});

$(document).on('click','#confirm_listing_action',function(){
  $("#confirm_listing_action").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var listing_id = $("#a_listing_id").val();
  var listing_status = $("#a_listing_status").val();
  var api_endpoint = listing_status == '3' ? 'remove_listing' : 'change_listing_status';
  $.ajax({
        url: BASE_URL+'/admin/'+api_endpoint,
        type: 'POST',
        dataType: 'json',
        data: {listing_id : listing_id, listing_status : listing_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_listing_action").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});

$(document).on('click','#confirm_featured_listing_action',function(){
  $("#confirm_featured_listing_action").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var listing_id = $("#f_listing_id").val();
  var listing_status = $("#f_listing_status").val();
  $.ajax({
        url: BASE_URL+'/admin/set_featured_listing',
        type: 'POST',
        dataType: 'json',
        data: {listing_id : listing_id, listing_status : listing_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_featured_listing_action").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});

$(document).on('click','#confirm_user_act_deact',function(){
  $("#confirm_user_act_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_user_status',
        type: 'POST',
        dataType: 'json',
        data: {user_id : user_id, user_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_user_act_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_user_cat_deact',function(){
  $("#confirm_user_cat_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_cat_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_user_cat_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_user_tag_deact',function(){
  $("#confirm_user_tag_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_tag_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_user_tag_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_user_resource_deact',function(){
  $("#confirm_user_resource_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_resource_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_user_resource_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_partial_space_cat_deact',function(){
  $("#confirm_partial_space_cat_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_partial_space_cat_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_partial_space_cat_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_retail_cat_deact',function(){
  $("#confirm_retail_cat_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_retail_cat_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_retail_cat_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_ideal_cat_deact',function(){
  $("#confirm_ideal_cat_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_ideal_cat_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_ideal_cat_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_amenties_cat_deact',function(){
  $("#confirm_amenties_cat_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_amenities_cat_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_amenties_cat_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_space_cat_deact',function(){
  $("#confirm_space_cat_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  var field = $("#a_user_field").val();
  $.ajax({
        url: BASE_URL+'/admin/change_space_cat_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, field : field, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_space_cat_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_user_resource_comment_deact',function(){
  $("#confirm_user_resource_comment_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_comment_status',
        type: 'POST',
        dataType: 'json',
        data: {cat_id : user_id, cat_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_user_resource_comment_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});
$(document).on('click','#confirm_user_ques_deact',function(){
  $("#confirm_user_ques_deact").html('<i class="fa fa-spinner fa-pulse"></i>').attr('disabled','disabled');
  var user_id = $("#a_user_id").val();
  var user_status = $("#a_user_status").val();
  $.ajax({
        url: BASE_URL+'/admin/change_ques_status',
        type: 'POST',
        dataType: 'json',
        data: {ques_id : user_id, ques_status : user_status, "_token": $('#token').val()},
        success: function(result) {
          $("#confirm_user_ques_deact").html('Yes').removeAttr('disabled','disabled');
          console.log(result)
            if(result.status == 1){   
              location.reload();
            }
            else{
              alert("Error while performing action, Please try later.");
            }
        }            
    });
});

$(function() {
  $("#add_users_form").validate({
  // Specify validation rules
  rules: {
    name: "required",
    type_of_busines: "required",
    last_name: "required",
    business_number: "required",
    company_name: "required",
    email: {
      required: true,
      email: true
    },
    password: {
      required: true,
      minlength: 6
    },
    confirm_password: {
      required: true,
      equalTo: '#pass'
    }
  },
  // Specify validation error messages
  messages: {
    name: "Please enter first name",
    last_name: "Please enter last name",
    business_number: "Please enter phone number",
    company_name: "Please enter company name",
    password: {
    required: "Please provide a password",
    minlength: "Password must be at least 6 characters long"
    },
    email: {
    required: "Please enter email address",
    email: "Please enter valid email address"
    },
    confirm_password: {
    required: "Please provide confirm password",
    equalTo: "Passwords doesn't match"
    }
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    $(".signup-errors").hide().html('');
      $(".add_user_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/add_new_user',
            type: 'POST',
            dataType: 'json',
            data: $('form#add_users_form').serialize(),
            success: function(result) {
              $(".add_user_btn").html('Submit').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  var url_send = $('#user_type').val();
                  window.location.href = BASE_URL+'/admin/users';             
                }
                else if(result.status == 2){                  
                  $(".signup-errors").show().html('Email already exists.');
                }
                else{
                  $(".signup-errors").show().html('Error while adding new user, please try later.');
                }
            }            
        });
  }
  });
});
$(function() {
  $("#add_cat_form").validate({
  // Specify validation rules
  rules: {
    name: "required"
  },
  // Specify validation error messages
  messages: {
    name: "Please enter category name"
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    $(".signup-errors").hide().html('');
      $(".add_user_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/add_faq_cat',
            type: 'POST',
            dataType: 'json',
            data: $('form#add_cat_form').serialize(),
            success: function(result) {
              $(".add_user_btn").html('Submit').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  window.location.href = BASE_URL+'/admin/faq-categories';             
                }
                else{
                  $(".signup-errors").show().html('Error, please try later.');
                }
            }            
        });
  }
  });
});

$(function() {
  $("#add_faq_form").validate({
  // Specify validation rules
  rules: {
    question: "required",
    answer: "required"
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    $(".signup-errors").hide().html('');
      $(".add_user_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/add_edit_faq',
            type: 'POST',
            dataType: 'json',
            data: $('form#add_faq_form').serialize(),
            success: function(result) {
              $(".add_user_btn").html('Submit').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  var url_send = $('#cat_id').val();
                  window.location.href = BASE_URL+'/admin/faq/'+url_send;           
                }
                else{
                  $(".signup-errors").show().html('Error, please try later.');
                }
            }            
        });
  }
  });
});

$(function() {
  $("#edit_loc_form").validate({
  // Specify validation rules
  rules: {
    flat_number: "required",
    address: "required",
    city: "required",
    postcode: "required"
  },
  // Specify validation error messages
  messages: {
    flat_number: "Please enter flat number",
    address: "Please enter valid address",
    city: "Please enter valid city",
    postcode: "Please enter valid postcode"
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    $(".signup-errors").hide().html('');
      $(".edit_loc_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/update_location',
            type: 'POST',
            dataType: 'json',
            data: $('form#edit_loc_form').serialize(),
            success: function(result) {
              $(".edit_loc_btn").html('Update').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  window.location.href = BASE_URL+'/admin/locations';           
                }
                else{
                  $(".signup-errors").show().html('Error while updating location, please try later.');
                }
            }            
        });
  }
  });
});

$(function() {
  $("#edit_admin_form").validate({
  // Specify validation rules
  rules: {
    name: "required",
    phone_number: "required",
    email: {
      required: true,
      email: true
    }
  },
  // Specify validation error messages
  messages: {
    name: "Please enter your name",
    phone_number: "Please enter your phone number",
    email: {
    required: "Please enter your email address",
    email: "Please enter valid email address"
    }
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    $(".signup-errors").hide().html('');
      $(".edit_admin_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/edit_profile',
            type: 'POST',
            dataType: 'json',
            data: $('form#edit_admin_form').serialize(),
            success: function(result) {
              $(".edit_admin_btn").html('Update').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  location.reload()            
                }
                else{
                  $(".signup-errors").show().html('Error while updating profile, please try later.');
                }
            }            
        });
  }
  });
});

$(function() {
  $("#admin_settings_form").validate({
  // Specify validation rules
  rules: {
    location: "required",
    phone: "required",
    location: "required",
    fb_link: "required",
    twitter_link: "required",
    insta_link: "required",
    linkedin_link: "required",
    pinterest_link: "required",
    email: {
      required: true,
      email: true
    }
  },
  // Specify validation error messages
  messages: {
    email: {
    required: "Please enter valid email address",
    email: "Please enter valid email address"
    }
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    $(".signup-errors").hide().html('');
      $(".update_setting_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/update_settings',
            type: 'POST',
            dataType: 'json',
            data: $('form#admin_settings_form').serialize(),
            success: function(result) {
              $(".update_setting_btn").html('Update').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  location.reload();            
                }
                else{
                  $(".signup-errors").show().html('Error while updating settings, please try later.');
                }
            }            
        });
  }
  });
});

$(function() {
  $("#change_pass_admin_form").validate({
  // Specify validation rules
  rules: {
    old_password: "required",
    new_password: {
      required: true,
      minlength: 6
    },
    confirm_password: {
      required: true,
      equalTo: '#pass'
    }
  },
  // Specify validation error messages
  messages: {
    old_password: "Please enter your old password",
    new_password: {
    required: "Please provide a new password",
    minlength: "Password must be at least 6 characters long"
    },
    confirm_password: {
    required: "Please provide confirm password",
    equalTo: "Passwords doesn't match"
    }
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    $(".signup-errors-p").hide().html('');
      $(".change_pass_admin_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/update_password',
            type: 'POST',
            dataType: 'json',
            data: $('form#change_pass_admin_form').serialize(),
            success: function(result) {
              $(".change_pass_admin_btn").html('Update').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  location.reload()            
                }
                else if(result.status == 2){
                  $(".signup-errors-p").show().html('Incorrect Old Password.');
                }
                else{
                  $(".signup-errors-p").show().html('Error while updating password, please try later.');
                }
            }            
        });
  }
  });
});

$(document).on('click','#go_to_service_users',function(){
  window.location.href = BASE_URL+'/admin/users';
});
$(document).on('click','#go_to_retail_users',function(){
  window.location.href = BASE_URL+'/admin/retail-users';
});

$(document).on('click','#go_to_listings',function(){
  window.location.href = BASE_URL+'/admin/brick-listings';
});

$(document).on('click','#go_to_bookings',function(){
  window.location.href = BASE_URL+'/admin/bookings';
});

$(document).on('click','#go_to_earnings',function(){
  window.location.href = BASE_URL+'/admin/transactions';
});


$(document).ready(function() {
    $('.users_tbl').DataTable( {
        "ordering": false
    } );
});


$(document).ready(function() {
    $('#summernote').summernote({
        height: 300
    });$('#summernote1').summernote({
        height: 300
    });$('#summernote2').summernote({
        height: 300
    });$('#summernote3').summernote({
        height: 300
    });$('#summernote4').summernote({
        height: 300
    });$('#summernote5').summernote({
        height: 300
    });$('#summernote6').summernote({
        height: 300
    });$('#summernote7').summernote({
        height: 300
    });$('#summernote8').summernote({
        height: 300
    });
});

$(function() {
  $("#update_page_form").validate({
  // Specify validation rules
  ignore: ":hidden:not(#summernote),.note-editable.panel-body",
  rules: {
    privacy: "required"
  },
  // Specify validation error messages
  messages: {
    privacy: "This field is required",
  },
  submitHandler: function(form) {
      $(".update_page_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
          url: BASE_URL+'/admin/update_page_info',
          type: 'POST',
          processData: false,
          contentType: false,
          data: new FormData(form),
          dataType: 'json',
            success: function(result) {
              $(".update_page_btn").html('Update').removeAttr('disabled','disabled');
              console.log(result)
                if(result.status == 1){  
                  location.reload()            
                }
                else{
                  alert('Error while updating content, please try later.');
                }
            }            
        });
  },
	errorPlacement: function (error, element) {
	    error.insertAfter($('.err_place'));
	}
  });
});