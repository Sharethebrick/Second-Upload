@extends('layouts.app')

@section('content')

  <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Saved Searches </h2>
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
                            <h3 class="title font-strs font-sma">Saved Searches  </h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-lessons booking_table">
                                            <thead>
                                                <tr>
                                                    <th> Sr. No </th>
                                                    <th> Search Type</th>
                                                    <th> Location</th>
                                                    <th> Category</th>
                                                    <th> Date/Time </th>
                                                    <th> Results Found  </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php 
                                                $count = 1;
                                            @endphp
                                             @if(count($search_history)>0)
                                               @foreach($search_history as $key)
                                                <tr>
                                                    <td> {{$count}} </td>
                                                    <td> {{$key->type}} </td>
                                                    <td> {{$key->location}} </td>
                                                    <td> @if($key->category==2) Bricks 
                                                       @elseif($key->category==1) Brands
                                                       @elseif($key->category==3) Full Space
                                                       @elseif($key->category==4) Partial Space
                                                       @elseif($key->category==5) Popup Stores
                                                       @elseif($key->category==6) Event Fairs
                                                       @endif </td>
                                                    <td> {{showDateFormatam($key->created_at)}}</td>
                                                    <td> <a href="#"> {{$key->results}} {{$key->results == 1 ? 'Result':'Results'}} </a> </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="delete_search_history btn-tbl btn-delete" data-toggle="tooltip" data-placement="bottom" data-id="{{$key->id}}" title="Delete"> <i class="bx bx-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @php 
                                                $count++;
                                                @endphp                                                
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
        <!-- End Checkout Area -->


@endsection

@section('footer_scripts')
<link rel="stylesheet" href="{{url('/')}}/css/datatables.min.css">
<script src="{{url('/')}}/js/datatables.min.js"></script>

<script type="text/javascript">
$('.booking_table').dataTable( {
      "ordering": false
    } );
$(document).on('click','.delete_search_history',function(){
    var history_id = $(this).attr('data-id');
    var dis = this;
                swal({
                    title: "Are you sure you want to delete this?",
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
                                      url: '{{url("/")}}/delete_search_history',
                                      type: 'POST',
                                      data: {"_token": '{{ Session::token() }}', id : history_id},
                                      dataType: 'json',
                                      success: function(result) {
                                        if(result.status == '1'){
                                           dis.closest('tr').remove();
                                            
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