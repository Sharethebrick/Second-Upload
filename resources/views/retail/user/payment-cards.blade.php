@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Payment Cards</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <div class="bg-box-als">
                        <div class="billing-details listing-categories-area p-0 list-slla list-altsr">
                            <h3 class="title font-strs font-sma">Payment Cards <a href="javascript:void(0)" data-toggle="modal" data-target="#add-card" class="upgrd uprde"><i class="bx bx-plus"> </i> Add New </a></h3>
                            <div class="row">
                            <input type="hidden" id="delete_id">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-lessons booking_table">
                                            <thead>
                                                <tr>
                                                    <th> Card Type </th>
                                                    <th> Card Number </th>
                                                    <th> Cardholder Name </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($cards)>0)
                                                @foreach($cards as $key)
                                                    <tr class="card_row{{$key->id}}">
                                                        <td> @if($key->card_type == 'mastercard') Mastercard @elseif($key->card_type == 'visa') Visa @elseif($key->card_type == 'discover') Discover @elseif($key->card_type == 'american-express')American Express @endif </td>
                                                        <td>XXXX XXXX XXXX {{$key->card_number}}</td>
                                                        <td> {{$key->card_holder_name}} </td>
                                                        <td>
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-pop" data-id="{{$key->id}}" class="btn-tbl btn-delete delete_card"> <i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="delete-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-delete" role="document">
            <div class="modal-content">

              <div class="modal-body">
                <div class="delte-con-pop">
                    <i class="bx bx-trash"></i>
                    <h5> Are you sure! </h5>
                    <p> Are you sure you want to delete it ? </p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger yes_delete">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              </div>
            </div>
          </div>
        </div>
 <div class="modal fade" id="add-card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-review" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Payment Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form class="form-flds" id="payment_form">
                   <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                  <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Card Type</label>
                                        <select class="form-control" name="cardType" id="cardType">
                                            <option value=""> Select Card Type </option>
                                            <option value="mastercard"> Mastercard </option>
                                            <option value="visa"> Visa </option>
                                            <option value="discover"> Discover </option>
                                            <option value="american-express"> American Express </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Card Holder Name</label>
                                        <input type="text" class="form-control" name="card_holder_name" placeholder="Add Card Holder Name" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Card Number</label>
                                        <input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="Add Card Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <input type="tel" class="form-control" name="cardExpiry" id="cardExpiry" placeholder="MM/YY" autocomplete="cc-exp"required
                                              />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CVV</label>
                                        <input type="tel"
                                              class="form-control"
                                              name="cardCVC"
                                              id="cardCVC"
                                              placeholder="CVC"
                                              autocomplete="cc-csc"
                                              required >
                                    </div>
                                </div>
                            </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="cardCVC submit_btn btn btn-primary">Save Card</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
@endsection
@section('footer_scripts')
<link rel="stylesheet" href="{{url('/')}}/css/datatables.min.css">
<script src="{{url('/')}}/js/datatables.min.js"></script>

<script type="text/javascript">
    $('.booking_table').dataTable( {
      "ordering": false
    } );
</script>
<script type="text/javascript">
$('input[name=cardNumber]').payment('formatCardNumber');
$('input[name=cardCVC]').payment('formatCardCVC');
$('input[name=cardExpiry').payment('formatCardExpiry');
    /* Form validation using Stripe client-side validation helpers */
jQuery.validator.addMethod("cardNumber", function(value, element) {
    return this.optional(element) || Stripe.card.validateCardNumber(value);
}, "Please specify a valid card number.");

jQuery.validator.addMethod("cardExpiry", function(value, element) {
    /* Parsing month/year uses jQuery.payment library */
    value = $.payment.cardExpiryVal(value);
    return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
}, "Invalid expiration date.");

jQuery.validator.addMethod("cardCVC", function(value, element) {
    return this.optional(element) || Stripe.card.validateCVC(value);
}, "Invalid CVC.");

$('#payment_form').validate({
    ignore: [],
    rules: {
        cardType: {
            required: true
        },
        card_holder_name: {
            required: true
        },
        cardNumber: {
            required: true,
            cardNumber: true
        },
        cardExpiry: {
            required: true,
            cardExpiry: true
        },
        cardCVC: {
            required: true,
            cardCVC: true
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
            if (element.is('select:hidden')) {
                error.insertAfter(element.next('.nice-select'));
            } else {
                error.insertAfter(element);
            }
        },
    submitHandler: function(form)
    {
       $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
            $.ajax({
                type:'POST',
                url:'{{url("/")}}/{{getUrl()}}'+'/save_card',
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                dataType: 'json',
                success:function(result)
                {
                  $('.submit_btn').prop('disabled',false).html('Save Card');
                    if(result.status == '1'){
                         swal({title: "Success", text: "Card Added Successfully", type: "success"},
                                       function(){
                                           location.reload();
                                       }
                                     );
                    }else{
                      swal({title: "Error", text: result.msg, type: "error"});
                    }
                }
            });

    }

    });
    $(document).on('click','.delete_card',function(){
        $('#delete_id').val($(this).attr('data-id'));
    });
    $(document).on('click','.yes_delete',function(){
       var id= $('#delete_id').val();
       $.ajax({
              url: '{{url("/")}}/delete_card',
              type: 'POST',
              data: {"_token": '{{ Session::token() }}', id : id},
              dataType: 'json',
              success: function(result) {
                if(result.status == '1'){
                    $('#delete-pop').modal('hide');
                    $('.card_row'+id).remove();

                }
              }
          });
    });
</script>
@Stop
