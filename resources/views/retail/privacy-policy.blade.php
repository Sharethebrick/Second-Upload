@extends('layouts.app')

@section('content')

 
      <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>{!!$page[1]->value!!}</h2>
                </div>
            </div>
        </div>
       
 <!--  
        <section class="blog-details-area ptb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="blog-details-desc">
                           <div class="article-content">
                                <h3 class="double-brdr">Privacy Policy Heading One</h3>

                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>

                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>

                               

                               <h3 class="double-brdr">Privacy Policy Heading Two</h3>

                                <ul class="features-list">
                                    <li><i class='bx bx-badge-check'></i> Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt.</li>
                                    <li><i class='bx bx-badge-check'></i> Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
                                    <li><i class='bx bx-badge-check'></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</li>
                                    <li><i class='bx bx-badge-check'></i> Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet.</li>
                                </ul>

                                 <h3 class="double-brdr">Privacy Policy Heading Three</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>

                                <h3 class="double-brdr">Privacy Policy Heading Four</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>

                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>
                            </div>

                           

                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        {!!$page[0]->value!!}


@endsection