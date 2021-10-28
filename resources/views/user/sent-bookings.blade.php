@extends('layouts.app')

@section('content')

  <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Bookings Made </h2>
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
                            <h3 class="title font-strs font-sma">Bookings Made  </h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-lessons booking_table">
                                            <thead>
                                                <tr>
                                                    <th> ID</th>
                                                    <th> Property</th>
                                                    <th> Requested to</th>
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
                                                        <td>
                                                           @if($key->booking_status == 0) Pending
                                                           @elseif($key->booking_status == 2) Rejected
                                                           @else Accepted
                                                           @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{url('/chat')}}/{{$key->booking_id}}" class="btn-tbl btn-view" data-toggle="tooltip" data-placement="bottom" title="Chat" target="_blank">
                                                            <i class="fa fa-comment"></i></a>
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
        <!-- End Checkout Area -->


@endsection

@section('footer_scripts')
<link rel="stylesheet" href="{{url('/')}}/css/datatables.min.css">
<script src="{{url('/')}}/js/datatables.min.js"></script>

<script type="text/javascript">
$('.booking_table').dataTable( {
      "ordering": false
    } );
</script>
@stop