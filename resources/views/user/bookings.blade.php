@extends('layouts.app')

@section('content')

  <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Booking Requests </h2>
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
                            <h3 class="title font-strs font-sma">Booking Requests  </h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table booking_table table-striped table-lessons">
                                            <thead>
                                                <tr>
                                                    <th> ID</th>
                                                    <th> Property</th>
                                                    <th> Client</th>
                                                    <th> Date/Time </th>
                                                    <th> Area </th>
                                                    <th> Status </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @if(count($bookings)>0)
                                               @foreach($bookings as $key)
                                                <tr>
                                                    <td> #{{$key->id}} </td>
                                                    <td> {{$key->name}} </td>
                                                    <td> {{$key->fname}} {{$key->lname}}</td>
                                                    <td> {{showDateFormatam($key->booking_created)}}</td>
                                                    <td> @if($key->type == 3 || $key->type == 4 || $key->type == 5  || $key->type == 6){{$key->size}} {{$key->size_unit}} @else --- @endif</td>
                                                     <td class="booking_status">
                                                       @if($key->booking_status == 0) Pending
                                                       @elseif($key->booking_status == 2) Rejected
                                                       @else Accepted
                                                       @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{url('/chat')}}/{{$key->booking_id}}" class="btn-tbl btn-view" data-toggle="tooltip" data-placement="bottom" title="Chat" target="_blank">
                                                            <i class="fa fa-comment"></i></a>
                                                        @if($key->booking_status == 0)
                                                        <a href="javascript:void(0)" class="btn-tbl btn-view" data-toggle="tooltip" data-placement="bottom" title="Accept" data-id="{{$key->booking_id}}">
                                                            <i class="bx bx-check"></i></a>
                                                        <a href="javascript:void(0);" class="btn-tbl btn-delete reject_booking_req" data-toggle="tooltip" data-placement="bottom" title="Reject" data-id="{{$key->booking_id}}"> <i class="bx bx-x"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach                                                 
                                                @else

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
        <!-- End Checkout Area -->


@endsection
@section('footer_scripts')
<link rel="stylesheet" href="{{url('/')}}/css/datatables.min.css">
<script src="{{url('/')}}/js/datatables.min.js"></script>

<script type="text/javascript">
    $('.booking_table').dataTable( {
      "ordering": false
    } );
    $(document).on('click','.reject_booking_req',function(){
        var booking_id = $(this).attr('data-id');
        var dis = this;
                    swal({
                        title: "Are you sure you want to reject booking request?",
                                text: "",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Yes",
                                cancelButtonText: "No",
                                closeOnConfirm: true,
                                closeOnCancel: true
                        },
                         function(isConfirm) {
                             if (isConfirm) {
                                    $.ajax({
                                          url: '{{url("/")}}/update_booking_status',
                                          type: 'POST',
                                          data: {"_token": '{{ Session::token() }}', booking_id : booking_id,status:2},
                                          dataType: 'json',
                                          success: function(result) {
                                            if(result.status == '1'){
                                                swal({title: "Success", text: "Booking Request Rejected Successfully!", type: "success"},
                                                   function(){ 
                                                      $(dis).closest('tr').find('.booking_status').html('Rejected');
                                                   }
                                                 ); 
                                                
                                            }
                                          }            
                                      });
                            }else {
                                swal.close();
                            }
                        }
                    );
            });

</script>
@stop