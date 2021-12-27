@extends('layouts.admin')
@push('stylesheet')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <style>
       .height-40{
          height : 100px;
       }

       .prgreen{
          padding : 10px;
          padding-left : 13px;
          padding-right : 13px;
          background-color : white;
          color : #28A745;
          border-radius : 25px;
       }

       .prinfo{
          padding : 10px;
          padding-left : 10px;
          padding-right : 10px;
          background-color : white;
          color :#17A2B8;
          border-radius : 25px;
       }

       .prindanger{
          padding : 10px;
          padding-left : 12px;
          padding-right : 12px;
          background-color : white;
          color :#DC3545;
          border-radius : 30px;
       }

       .prwarning{
          padding : 10px;
          padding-left : 10px;
          padding-right : 10px;
          background-color : white;
          color :#FFC107;
          border-radius : 25px;
       }

       .prvoilet{
          padding : 13px;
          padding-top : 16px;
          padding-bottom : 16px;
          background-color : white;
          color :#9146ff;
          border-radius : 25px;
       }

       .prpicock{
          padding : 10px;
          padding-left : 14px;
          padding-right : 14px;
          background-color : white;
          color :#173d4f;
          border-radius : 25px;
       }

       .bg-voilet{
          background-color :#9146ff;
       }

       .bg-picock{
          background-color : #173d4f;
       }


     </style>
@endpush
@section('content')

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                     <div class="row">
            <a class="col-md-4 grid-margin stretch-card" href="{{url('backoffice/users')}}">
              <div class="card border-0 border-radius-2 bg-success">
                <div class="card-body">
                  <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-success icon-rounded-lg prgreen">
                      <i class="fa fa-user fa-2x mdi-arrow-top-right"></i>
                    </div>
                    <div class="text-white">
                      <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Users</p>
                      <div class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                        <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">{{$users ? $users->count() : 0}}</h3>
                        <!-- <small class="mb-0">This month</small> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>

            <a class="col-md-4 grid-margin stretch-card" href="{{url('backoffice/products')}}">
              <div class="card border-0 border-radius-2 bg-info">
                <div class="card-body">
                  <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-success icon-rounded-lg prinfo">
                      <i class="fa fa-archive fa-2x mdi-arrow-top-right"></i>
                    </div>
                    <div class="text-white">
                      <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Products</p>
                      <div class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                        <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">{{$products ? $products->count() : 0}}</h3>
                        <!-- <small class="mb-0">This month</small> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>

            <a class="col-md-4 grid-margin stretch-card" href="{{url('backoffice/categories')}}">
              <div class="card border-0 border-radius-2 bg-danger">
                <div class="card-body">
                  <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-danger icon-rounded-lg prindanger">
                      <i class="fa fa-dropbox fa-2x mdi-chart-donut-variant"></i>
                    </div>
                    <div class="text-white">
                      <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Categories</p>
                      <div class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                        <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">{{$categories ? $categories->count() : 0}}</h3>
                        <!-- <small class="mb-0">This month</small> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <a class="col-md-4 grid-margin stretch-card" href="{{url('backoffice/orders')}}">
              <div class="card border-0 border-radius-2 bg-warning">
                <div class="card-body">
                  <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-warning icon-rounded-lg prwarning">
                      <i class="fa fa-briefcase fa-2x mdi-chart-multiline"></i>
                    </div>
                    <div class="text-white">
                      <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Orders</p>
                      <div class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                        <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">{{$orders ? $orders->count() : 0}}</h3>
                         <!-- <small class="mb-0">This month</small> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <a class="col-md-4 grid-margin stretch-card" href="{{url('backoffice/refunds')}}">
              <div class="card border-0 border-radius-2 bg-voilet">
                <div class="card-body">
                  <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-warning icon-rounded-lg prvoilet">
                      <i class="fa fa-credit-card-alt fa-lg mdi-chart-multiline"></i>
                    </div>
                    <div class="text-white">
                      <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Refunds</p>
                      <div class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                        <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">{{$refunds ? $refunds->count() : 0}}</h3>
                         <!-- <small class="mb-0">This month</small> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <a class="col-md-4 grid-margin stretch-card" href="{{url('backoffice/orders')}}">
              <div class="card border-0 border-radius-2 bg-picock">
                <div class="card-body">
                  <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-warning icon-rounded-lg prpicock">
                      <i class="fa fa-times fa-2x mdi-chart-multiline"></i>
                    </div>
                    <div class="text-white">
                      <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Cancel</p>
                      <div class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                        <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">{{$cancels ? $cancels->count() : 0}}</h3>
                         <!-- <small class="mb-0">This month</small> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <div class="row">
            <div class="col-xl-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Total Sales</p>
                  {{-- <p class="text-muted">Audience to which the users belonged while on the current date Audience to which the users belonged while on the current date Audience to which the users belonged while on the current date </p> --}}
                  <div class="d-flex flex-wrap mb-4 mt-4 pb-4">
                    <div class="mr-4 mr-md-5">
                      <p class="mb-0">Revenue</p>
                      <h4>{{$revenues ? $revenues : 0}}</h4>
                    </div>
                    {{-- <div class="mr-4 mr-md-5">
                      <p class="mb-0">Returns</p>
                      <h4>27,219</h4>
                    </div> --}}
                    <div class="mr-4 mr-md-5">
                      <p class="mb-0">Queries</p>
                      <h4>{{$refunds ? $refunds->count() : 0}}</h4>
                    </div>
                    <div class="mr-4 mr-md-5">
                      <p class="mb-0">Invoices</p>
                      <h4>{{$orders ? $orders->count() : 0}}</h4>
                    </div>
                  </div>
                  <canvas id="total-sales-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-xl-6 grid-margin">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Users</p>
                      <div class="d-flex flex-wrap align-items-baseline">
                          <h2 class="mr-3">{{$users ? $users->count() : 0}}</h2>
                          <i class="mdi mdi-arrow-up mr-1 text-danger"></i><span><p class="mb-0 text-danger font-weight-medium">+{{$final_ratio}}%</p></span>
                      </div>
                      <p class="mb-0 text-muted">Total users world wide</p>
                    </div>
                    <canvas id="users-chart"></canvas>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Status</p>
                      <p class="text-muted mb-2">All over worlds user status</p>
                      <div class="row mt-4">
                        <div class="col-md-6 stretch-card">
                          <div class="row d-flex align-items-center">
                            <div class="col-6">
                              <div id="offlineProgress"></div>
                            </div>
                            <div class="col-6 pl-0">
                              <p class="mb-0">Offline</p>
                              <h2>{{$offline ? $offline->count() : 0}}</h2>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 stretch-card mt-4 mt-md-0">
                          <div class="row d-flex align-items-center">
                            <div class="col-6">
                              <div id="onlineProgress"></div>
                            </div>
                            <div class="col-6 pl-0">
                              <p class="mb-0">Online</p>
                              <h2>{{$online ? $online->count() : 0}}</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-md-end flex-wrap">
                    <p class="card-title">Recent Users</p>

                  </div>
                  <div class="table-responsive">
                    <table class="table tickets-table mb-2">
                      <thead>
                        <th class="text-muted pl-0">
                          Name
                        </th>
                        <th class="text-muted">
                          Email
                        </th>
                        <th>
                          Mobile
                        </th>
                        <th class="text-muted">
                          Date
                        </th>
                      </thead>
                      <tbody>
                        @foreach($rusers as $user)
                          <tr>
                             <td>
                               <span class="badge badge-primary p-2">{{$user->name}}</span>
                             </td>
                             <td>
                               <span class="badge badge-secondary p-2">{{$user->email}}</span>

                             </td>
                             <td>
                               {{$user->mobile}}
                             </td>
                             <td>
                               {{date('d M Y H:i A', strtotime($user->created_at))}}
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Updates</p>
                                    <ul class="bullet-line-list mt-4">
                                        <li>
                                            <h6>User confirmation</h6>
                                            <p class="mt-2">Tonight's the night. And it's going to happen again and again. It has to happen. I'm thinking two circus clowns dancing. </p>
                                            <p class="text-muted mb-4">
                                                <i class="mdi mdi-clock-outline"></i>
                                                7 months ago.
                                            </p>
                                        </li>
                                        <li>
                                            <h6>Continuous evaluation</h6>
                                            <p class="mt-2">And it's going to happen again and again. It has to happen. I'm thinking two circus clowns dancing. Tonight's the night.  </p>
                                            <p class="text-muted mb-4">
                                                <i class="mdi mdi-clock-outline"></i>
                                                7 months ago.
                                            </p>
                                        </li>

                                    </ul>
                                </div>
                            </div>
            </div>
          </div>
          {{-- <div class="row">
            <div class="col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body pb-0">
                  <p class="card-title mb-xl-0">Distribution</p>
                </div>
                <canvas id="distribution-chart"></canvas>
                <div class="card-body">
                  <div id="distribution-legend" class="distribution-chart-legend pt-4 pb-3"></div>
                  <button class="btn btn-outline-light text-dark d-block mx-auto mt-2">View More</button>
                </div>
              </div>
            </div>
            <div class="col-xl-9 grid-margin stretch-card">
              <div class="card">
                <div class="row">
                  <div class="col-md-7 col-lg-6 col-xl-7">
                    <div class="card-body h-100 d-flex flex-column">
                      <p class="card-title">Sale report</p>
                      <p class="text-muted mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia id beatae sint dolorum quod ducimus quisquam ut minima atque quaerat.</p>
                      <canvas id="sale-report-chart"></canvas>
                    </div>
                  </div>
                  <div class="col-md-5 col-lg-6 col-xl-5">
                    <div class="card-body">
                      <p class="card-title">Sales report overview</p>
                      <p class="pb-2 text-muted">Sale information on advertising, exhibitions, market research, online media, customer desires, PR and much more</p>
                      <div class="d-flex flex-wrap justify-content-start mt-3">
                        <div class="mr-3">
                          <p class="mb-0">Downloads</p>
                          <h4>13,956</h4>
                        </div>
                        <div class="mr-3">
                          <p class="mb-0">Purchases</p>
                          <h4>55,123</h4>
                        </div>
                        <div class="mr-3">
                          <p class="mb-0">Users</p>
                          <h4>29829</h4>
                        </div>
                      </div>
                      <div class="d-flex mb-3">
                        <i class="mdi mdi-arrow-expand-up mb-0 text-success mr-2 mt-1"></i>
                        <p class="mb-0 text-dark">15% more than last week</p>
                      </div>
                      <div class="d-flex flex-wrap mb-5">
                        <button class="btn btn-info mt-3 mr-2">Update</button>
                        <button class="btn btn-outline-light mt-3 text-dark">More</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Products</p>

                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr class="border-top-0">
                          <th class="text-muted">Name</th>
                          <th class="text-muted">Category</th>
                          <th class="text-muted">Sub Category</th>
                          <th class="text-muted">Child Category</th>
                          <th class="text-muted">SKU Code</th>
                          <th class="text-muted">MRP Price</th>
                          <th class="text-muted">Sales Price</th>
                          <th class="text-muted">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rproducts as $product)
                          <tr>
                            <td>
                              <span class="badge badge-warning p-2">{{$product->name}}</span>
                            </td>
                            <td>
                              <span class="badge badge-secondary p-2">{{$product->category->name}}</span>
                            </td>
                            <td>
                              <span class="badge badge-secondary p-2">{{$product->sub_category->name}}</span>
                            </td>
                            <td>
                              <span class="badge badge-secondary p-2">{{$product->sub_category_child_id ? $product->child_category->name : ''}}</span>
                            </td>
                            <td>
                              <span class="badge badge-success p-2">{{$product->sku_code}}</span>
                            </td>
                              <?php $count = 0; ?>
                            @foreach($product->productProductVariations as $variation)

                              @if($variation->primary_variation == 1)
                                <?php $count++; ?>

                                  @if($count == 1)
                                    <td>
                                      <span class="badge badge-dark p-2">{{$variation->single_price}}</span>
                                    </td>
                                    <td>
                                      <span class="badge badge-dark p-2">{{$variation->single_sales_price}}</span>
                                    </td>
                                  @endif

                              @endif

                            @endforeach
                            <td>
                              <span class="badge badge-secondary p-2">{{date('d M Y H:i A', strtotime($product->created_at))}}</span>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Sales</p>

                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr class="border-top-0">
                          <th class="text-muted">Product Name</th>
                          <th class="text-muted">User</th>
                          <th class="text-muted" >Order ID</th>
                          <th class="text-muted">Amount</th>
                          <th class="text-muted">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rsales as $sale)
                          <tr>
                            <td>
                              <span class="badge badge-warning p-2">
                                <?php $count = 0; ?>
                                @foreach($sale->orders as $order)
                                   @if($count === 0)
                                     {{$order->name}}
                                   @endif
                                   <?php $count++; ?>
                                @endforeach
                              </span>
                            </td>
                            <td>
                              <span class="badge badge-success p-2">
                                {{$sale->users->name}}
                              </span>
                            </td>
                            <td>
                             <span class="badge badge-danger p-2">{{$sale->order_id}}</span>
                            </td>
                            <td>
                              <span class="badge badge-secondary p-2">{{$sale->amount}}</span>
                            </td>
                            <td>
                              <span class="badge badge-secondary p-2">{{date('d M Y ', strtotime($sale->created_at))}}</span>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Cancel</p>

                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr class="border-top-0">
                          <th class="text-muted">User</th>
                          <th class="text-muted">Product Name</th>
                          <th class="text-muted">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rcancels as $cancel)
                          <tr>
                            <td>
                              <span class="badge badge-warning p-2">{{$cancel->users->name}}</span>
                            </td>
                            <?php $count = 0; ?>
                            @foreach($cancel->orders as $order)
                              @if($count === 0)
                                <td>
                                  <span class="badge badge-secondary p-2">{{$order->name}}</span>
                                </td>
                              @endif
                             <?php $count++; ?>
                            @endforeach

                            <td>
                              <span class="badge badge-secondary p-2">{{date('d M Y H:i A', strtotime($cancel->created_at))}}</span>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-7">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Categories</p>

                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr class="border-top-0">
                          <th class="text-muted">Name</th>
                          <th class="text-muted">Slug</th>
                          <th class="text-muted">Image</th>
                          <th class="text-muted">Is Home</th>
                          <th class="text-muted">Is Menu</th>
                          <th class="text-muted">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rcategories as $category)
                            <td>
                              <span class="badge badge-primary p-2">{{$category->name}}</span>
                            </td>
                            <td>
                              <span class="badge badge-success p-2">{{$category->slug}}</span>
                            </td>
                            <td>
                              <img src="{{asset('file/')}}/{{$category->image}}" style="width : 120px;"/>
                            </td>
                            <td>
                             {{$category->is_home === 1 ? '✔️': '❌'}}
                            </td>
                            <td>
                             {{$category->is_menu === 1 ? '✔️': '❌'}}
                            </td>
                            <td>
                              <span class="badge badge-secondary p-2">{{date('d M Y H:i A', strtotime($category->created_at))}}</span>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Refund</p>

                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr class="border-top-0">
                          <th class="text-muted">User</th>
                          <th class="text-muted">Reason</th>
                          <th class="text-muted">Amount</th>
                          <th class="text-muted">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($refunds as $refund)
                          <?php
                             $payment = \App\Models\Payment::where('transaction_id', $refund->payment_id)->first();
                             $user = \App\Models\User::find($payment->user_id);

                          ?>
                          <tr>
                            <td>
                              <span class="badge badge-warning p-2">{{$user->name}}</span>
                            </td>
                            <td>
                              <?php
                                $reason = \App\Models\RefundReason::find($refund->refund_reason_id);

                                echo $reason->description;
                                ?>
                            </td>
                            <td>
                              <span class="badge badge-success p-2">{{$payment->amount}}</span>
                            </td>
                            <td>
                              <span class="badge badge-secondary p-2">{{date('d M Y H:i A', strtotime($refund->created_at))}}</span>
                            </td>
                          </tr>
                        @endforeach
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
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/js/Chart.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/0.5.5/progressbar.min.js" integrity="sha512-JaUjp2hxkyyMrn9Y1FkHL/n7tLcnZyaENwwj5YvlCvYuiTItndwhbOhEGWUlqBINF+WZm7Adh64PYb/nwnj40w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
(function($) {
  'use strict';
  $(function() {
    var weekdays = new Array(7);
    weekdays[0] = "Sun";
    weekdays[1] = "Mon";
    weekdays[2] = "Tue";
    weekdays[3] = "Wed";
    weekdays[4] = "Thu";
    weekdays[5] = "Fri";
    weekdays[6] = "Sat";

    if ($("#total-sales-chart").length) {
      var sales_day = [];
      var sales_count = [];
      @foreach ($sales as $sale)
          var dt = new Date("{{$sale->created_at}}");
          sales_day.push(weekdays[dt.getDay()]);
          sales_count.push("{{$sale->total}}");
      @endforeach

      var areaData = {
        labels: sales_day,
        datasets: [
          {
            data: sales_count,
            backgroundColor: [
              'rgba(61, 165, 244, .0)'
            ],
            borderColor: [
              'rgb(61, 165, 244)'
            ],
            borderWidth: 2,
            fill: 'origin',
            label: "services"
          }
          // ,
          // {
          //   data: [160000, 120000, 175000, 290000, 380000, 210000, 320000, 150000, 310000, 180000, 160000],
          //   backgroundColor: [
          //     'rgba(241, 83, 110, .0)'
          //   ],
          //   borderColor: [
          //     'rgb(241, 83, 110)'
          //   ],
          //   borderWidth: 2,
          //   fill: 'origin',
          //   label: "services"
          // }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: true,
            ticks: {
              display: true,
              padding: 20,
              fontColor:"#000",
              fontSize: 14
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              fontColor: "#000",
              fontSize: 14,
              padding: 18,
              stepSize: 100000,
              callback: function(value) {
                var ranges = [
                    { divider: 1e6, suffix: 'M' },
                    { divider: 1e3, suffix: 'k' }
                ];
                function formatNumber(n) {
                    for (var i = 0; i < ranges.length; i++) {
                      if (n >= ranges[i].divider) {
                          return (n / ranges[i].divider).toString() + ranges[i].suffix;
                      }
                    }
                    return n;
                }
                return formatNumber(value);
              }
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .37
          },
          point: {
            radius: 0
          }
        }
      }
      var revenueChartCanvas = $("#total-sales-chart").get(0).getContext("2d");
      var revenueChart = new Chart(revenueChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    if ($("#total-sales-chart-dark").length) {
      var areaData = {
        labels: ["Mon","","Tue","", "Wed","", "Thu","", "Fri","", "Sat"],
        datasets: [
          {
            data: [260000, 200000, 290000, 230000, 200000, 180000, 180000, 360000, 240000, 280000, 180000],
            backgroundColor: [
              'rgba(61, 165, 244, .0)'
            ],
            borderColor: [
              'rgb(61, 165, 244)'
            ],
            borderWidth: 2,
            fill: 'origin',
            label: "services"
          },
          {
            data: [160000, 120000, 175000, 290000, 380000, 210000, 320000, 150000, 310000, 180000, 160000],
            backgroundColor: [
              'rgba(241, 83, 110, .0)'
            ],
            borderColor: [
              'rgb(241, 83, 110)'
            ],
            borderWidth: 2,
            fill: 'origin',
            label: "services"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: true,
            ticks: {
              display: true,
              padding: 20,
              fontColor:"#b1b1b5",
              fontSize: 14
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              fontColor: "#b1b1b5",
              fontSize: 14,
              padding: 18,
              stepSize: 100000,
              callback: function(value) {
                var ranges = [
                    { divider: 1e6, suffix: 'M' },
                    { divider: 1e3, suffix: 'k' }
                ];
                function formatNumber(n) {
                    for (var i = 0; i < ranges.length; i++) {
                      if (n >= ranges[i].divider) {
                          return (n / ranges[i].divider).toString() + ranges[i].suffix;
                      }
                    }
                    return n;
                }
                return formatNumber(value);
              }
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .37
          },
          point: {
            radius: 0
          }
        }
      }
      var revenueChartCanvas = $("#total-sales-chart-dark").get(0).getContext("2d");
      var revenueChart = new Chart(revenueChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    if ($("#users-chart").length) {
      var users_day = [];
      var user_count = [];
      @foreach ($users_chart as $users)
          var dt = new Date("{{$users->created_at}}");
          users_day.push(weekdays[dt.getDay()]);
          user_count.push("{{$users->total}}");
      @endforeach



      var areaData = {
        labels: users_day,
        datasets: [{
            data: user_count,
            backgroundColor: [
              '#e0fff4'
            ],
            borderWidth: 2,
            borderColor: "#00c689",
            fill: 'origin',
            label: "purchases"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: false,
            ticks: {
              display: true
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: false,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 1,
              min: 0,
              max: 3
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .35
          },
          point: {
            radius: 0
          }
        }
      }
      var salesChartCanvas = $("#users-chart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    // if ($("#users-chart-dark").length) {
    //   var areaData = {
    //     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
    //     datasets: [{
    //         data: [160, 105, 225, 140, 180, 61, 120, 60, 90],
    //         backgroundColor: [
    //           'rgba(0, 198, 137, .1)'
    //         ],
    //         borderWidth: 2,
    //         borderColor: "#00c689",
    //         fill: 'origin',
    //         label: "purchases"
    //       }
    //     ]
    //   };
    //   var areaOptions = {
    //     responsive: true,
    //     maintainAspectRatio: true,
    //     plugins: {
    //       filler: {
    //         propagate: false
    //       }
    //     },
    //     scales: {
    //       xAxes: [{
    //         display: false,
    //         ticks: {
    //           display: true
    //         },
    //         gridLines: {
    //           display: false,
    //           drawBorder: false,
    //           color: 'transparent',
    //           zeroLineColor: '#eeeeee'
    //         }
    //       }],
    //       yAxes: [{
    //         display: false,
    //         ticks: {
    //           display: true,
    //           autoSkip: false,
    //           maxRotation: 0,
    //           stepSize: 100,
    //           min: 0,
    //           max: 300
    //         },
    //         gridLines: {
    //           drawBorder: false
    //         }
    //       }]
    //     },
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       enabled: true
    //     },
    //     elements: {
    //       line: {
    //         tension: .35
    //       },
    //       point: {
    //         radius: 0
    //       }
    //     }
    //   }
    //   var salesChartCanvas = $("#users-chart-dark").get(0).getContext("2d");
    //   var salesChart = new Chart(salesChartCanvas, {
    //     type: 'line',
    //     data: areaData,
    //     options: areaOptions
    //   });
    // }
    //
    // if ($("#projects-chart").length) {
    //   var areaData = {
    //     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr","May"],
    //     datasets: [{
    //         data: [220, 120, 140, 135, 160, 65, 160, 135, 190,165, 120, 160, 140, 140, 130, 120,  150],
    //         backgroundColor: [
    //           '#e5f2ff'
    //         ],
    //         borderWidth: 2,
    //         borderColor: "#3da5f4",
    //         fill: 'origin',
    //         label: "purchases"
    //       }
    //     ]
    //   };
    //   var areaOptions = {
    //     responsive: true,
    //     maintainAspectRatio: true,
    //     plugins: {
    //       filler: {
    //         propagate: false
    //       }
    //     },
    //     scales: {
    //       xAxes: [{
    //         display: false,
    //         ticks: {
    //           display: true
    //         },
    //         gridLines: {
    //           display: false,
    //           drawBorder: false,
    //           color: 'transparent',
    //           zeroLineColor: '#eeeeee'
    //         }
    //       }],
    //       yAxes: [{
    //         display: false,
    //         ticks: {
    //           display: true,
    //           autoSkip: false,
    //           maxRotation: 0,
    //           stepSize: 100,
    //           min: 0,
    //           max: 300
    //         },
    //         gridLines: {
    //           drawBorder: false
    //         }
    //       }]
    //     },
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       enabled: true
    //     },
    //     elements: {
    //       line: {
    //         tension: .05
    //       },
    //       point: {
    //         radius: 0
    //       }
    //     }
    //   }
    //   var salesChartCanvas = $("#projects-chart").get(0).getContext("2d");
    //   var salesChart = new Chart(salesChartCanvas, {
    //     type: 'line',
    //     data: areaData,
    //     options: areaOptions
    //   });
    // }
    //
    // if ($('#offlineProgress').length) {
    //   var bar = new ProgressBar.Circle(offlineProgress, {
    //     color: '#000',
    //     // This has to be the same size as the maximum width to
    //     // prevent clipping
    //     strokeWidth: 6,
    //     trailWidth: 6,
    //     easing: 'easeInOut',
    //     duration: 1400,
    //     text: {
    //       autoStyleContainer: true,
    //       style : {
    //         color : "#fff",
    //         position: 'absolute',
    //         left: '40%',
    //         top: '50%'
    //       }
    //     },
    //     svgStyle: {
    //       width: '90%'
    //     },
    //     from: {
    //       color: '#f1536e',
    //       width: 6
    //     },
    //     to: {
    //       color: '#f1536e',
    //       width: 6
    //     },
    //     // Set default step function for all animate calls
    //     step: function(state, circle) {
    //       circle.path.setAttribute('stroke', state.color);
    //       circle.path.setAttribute('stroke-width', state.width);
    //
    //       var value = Math.round(circle.value() * 100);
    //       if (value === 0) {
    //         circle.setText('');
    //       } else {
    //         circle.setText(value);
    //       }
    //
    //     }
    //   });
    //
    //   bar.text.style.fontSize = '1rem';
    //   bar.animate(.64); // Number from 0.0 to 1.0
    // }
    //
    // if ($('#onlineProgress').length) {
    //   var bar = new ProgressBar.Circle(onlineProgress, {
    //     color: '#000',
    //     // This has to be the same size as the maximum width to
    //     // prevent clipping
    //     strokeWidth: 6,
    //     trailWidth: 6,
    //     easing: 'easeInOut',
    //     duration: 1400,
    //     text: {
    //       autoStyleContainer: true,
    //       style : {
    //         color : "#fff",
    //         position: 'absolute',
    //         left: '40%',
    //         top: '50%'
    //       }
    //     },
    //     svgStyle: {
    //       width: '90%'
    //     },
    //     from: {
    //       color: '#fda006',
    //       width: 6
    //     },
    //     to: {
    //       color: '#fda006',
    //       width: 6
    //     },
    //     // Set default step function for all animate calls
    //     step: function(state, circle) {
    //       circle.path.setAttribute('stroke', state.color);
    //       circle.path.setAttribute('stroke-width', state.width);
    //
    //       var value = Math.round(circle.value() * 100);
    //       if (value === 0) {
    //         circle.setText('');
    //       } else {
    //         circle.setText(value);
    //       }
    //
    //     }
    //   });
    //
    //   bar.text.style.fontSize = '1rem';
    //   bar.animate(.84); // Number from 0.0 to 1.0
    // }
    //
    // if ($('#offlineProgressDark').length) {
    //   var bar = new ProgressBar.Circle(offlineProgressDark, {
    //     color: '#000',
    //     // This has to be the same size as the maximum width to
    //     // prevent clipping
    //     strokeWidth: 6,
    //     trailWidth: 6,
    //     easing: 'easeInOut',
    //     duration: 1400,
    //     text: {
    //       autoStyleContainer: true,
    //       style : {
    //         color : "#131633",
    //         position: 'absolute',
    //         left: '40%',
    //         top: '50%'
    //       }
    //     },
    //     svgStyle: {
    //       width: '90%'
    //     },
    //     from: {
    //       color: '#f1536e',
    //       width: 6
    //     },
    //     to: {
    //       color: '#f1536e',
    //       width: 6
    //     },
    //     // Set default step function for all animate calls
    //     step: function(state, circle) {
    //       circle.path.setAttribute('stroke', state.color);
    //       circle.path.setAttribute('stroke-width', state.width);
    //
    //       var value = Math.round(circle.value() * 100);
    //       if (value === 0) {
    //         circle.setText('');
    //       } else {
    //         circle.setText(value);
    //       }
    //
    //     }
    //   });
    //
    //   bar.text.style.fontSize = '1rem';
    //   bar.animate(.64); // Number from 0.0 to 1.0
    // }
    //
    // if ($('#onlineProgressDark').length) {
    //   var bar = new ProgressBar.Circle(onlineProgressDark, {
    //     color: '#000',
    //     // This has to be the same size as the maximum width to
    //     // prevent clipping
    //     strokeWidth: 6,
    //     trailWidth: 6,
    //     easing: 'easeInOut',
    //     duration: 1400,
    //     text: {
    //       autoStyleContainer: true,
    //       style : {
    //         color : "#131633",
    //         position: 'absolute',
    //         left: '40%',
    //         top: '50%'
    //       }
    //     },
    //     svgStyle: {
    //       width: '90%'
    //     },
    //     from: {
    //       color: '#fda006',
    //       width: 6
    //     },
    //     to: {
    //       color: '#fda006',
    //       width: 6
    //     },
    //     // Set default step function for all animate calls
    //     step: function(state, circle) {
    //       circle.path.setAttribute('stroke', state.color);
    //       circle.path.setAttribute('stroke-width', state.width);
    //
    //       var value = Math.round(circle.value() * 100);
    //       if (value === 0) {
    //         circle.setText('');
    //       } else {
    //         circle.setText(value);
    //       }
    //
    //     }
    //   });
    //
    //   bar.text.style.fontSize = '1rem';
    //   bar.animate(.84); // Number from 0.0 to 1.0
    // }
    //
    // if ($("#projects-chart-dark").length) {
    //   var areaData = {
    //     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr","May"],
    //     datasets: [{
    //         data: [220, 120, 140, 135, 160, 65, 160, 135, 190,165, 120, 160, 140, 140, 130, 120,  150],
    //         backgroundColor: [
    //           'rgba(61, 165, 244, .1)'
    //         ],
    //         borderWidth: 2,
    //         borderColor: "#3da5f4",
    //         fill: 'origin',
    //         label: "purchases"
    //       }
    //     ]
    //   };
    //   var areaOptions = {
    //     responsive: true,
    //     maintainAspectRatio: true,
    //     plugins: {
    //       filler: {
    //         propagate: false
    //       }
    //     },
    //     scales: {
    //       xAxes: [{
    //         display: false,
    //         ticks: {
    //           display: true
    //         },
    //         gridLines: {
    //           display: false,
    //           drawBorder: false,
    //           color: 'transparent',
    //           zeroLineColor: '#eeeeee'
    //         }
    //       }],
    //       yAxes: [{
    //         display: false,
    //         ticks: {
    //           display: true,
    //           autoSkip: false,
    //           maxRotation: 0,
    //           stepSize: 100,
    //           min: 0,
    //           max: 300
    //         },
    //         gridLines: {
    //           drawBorder: false
    //         }
    //       }]
    //     },
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       enabled: true
    //     },
    //     elements: {
    //       line: {
    //         tension: .05
    //       },
    //       point: {
    //         radius: 0
    //       }
    //     }
    //   }
    //   var salesChartCanvas = $("#projects-chart-dark").get(0).getContext("2d");
    //   var salesChart = new Chart(salesChartCanvas, {
    //     type: 'line',
    //     data: areaData,
    //     options: areaOptions
    //   });
    // }
    //
    // if ($("#orders-chart-dark").length) {
    //   var CurrentChartCanvas = $("#orders-chart-dark").get(0).getContext("2d");
    //   var CurrentChart = new Chart(CurrentChartCanvas, {
    //     type: 'bar',
    //     data: {
    //       labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //       datasets: [{
    //           label: 'Profit',
    //           data: [40, 100, 120, 80, 140, 120, 170, 100, 200, 150, 120, 100, 55],
    //           backgroundColor: '#3da5f4'
    //         },
    //         {
    //           label: 'Profit',
    //           data: [90, 80, 180, 60, 100, 60, 120, 150, 100, 110, 150, 150, 100],
    //           backgroundColor: '#23284f'
    //         }
    //       ]
    //     },
    //     options: {
    //       responsive: true,
    //       maintainAspectRatio: true,
    //       layout: {
    //         padding: {
    //           left: 0,
    //           right: 0,
    //           top: 30,
    //           bottom: -10
    //         }
    //       },
    //       scales: {
    //         yAxes: [{
    //           display: false,
    //           gridLines: {
    //             drawBorder: false
    //           },
    //           ticks: {
    //             display: false
    //           }
    //         }],
    //         xAxes: [{
    //           stacked: false,
    //           categoryPercentage: 3,
    //           barPercentage: .3,
    //           ticks: {
    //             beginAtZero: true,
    //             fontColor: "#9fa0a2",
    //             display: false
    //           },
    //           gridLines: {
    //             color: "rgba(0, 0, 0, 0)",
    //             display: true
    //           },
    //         }]
    //       },
    //       legend: {
    //         display: false
    //       },
    //       elements: {
    //         point: {
    //           radius: 0
    //         }
    //       }
    //     }
    //   });
    // }
    //
    // if ($("#revenue-chart").length) {
    //   var CurrentChartCanvas = $("#revenue-chart").get(0).getContext("2d");
    //   var CurrentChart = new Chart(CurrentChartCanvas, {
    //     type: 'bar',
    //     data: {
    //       labels: ["1982","","1993", "", "2003", "", "2013"],
    //       datasets: [{
    //           label: 'Europe',
    //           data: [280000, 90000, 150000, 200000, 50000, 150000, 260000, 150000, 260000],
    //           backgroundColor: '#405189'
    //         },
    //         {
    //           label: 'Africa',
    //           data: [250000, 230000, 130000, 160000, 110000, 230000, 50000, 230000, 50000],
    //           backgroundColor: '#3da5f4'
    //         }
    //       ]
    //     },
    //     options: {
    //       responsive: true,
    //       maintainAspectRatio: true,
    //       layout: {
    //         padding: {
    //           left: 0,
    //           right: 0,
    //           top: 0,
    //           bottom: 0
    //         }
    //       },
    //       scales: {
    //         yAxes: [{
    //           display: true,
    //           gridLines: {
    //             drawBorder: false
    //           },
    //           ticks: {
    //             fontColor: "#000",
    //             display: true,
    //             fontStyle: 400,
    //             fontSize: 14,
    //             stepSize: 100000,
    //             callback: function(value) {
    //               var ranges = [
    //                   { divider: 1e6, suffix: 'M' },
    //                   { divider: 1e3, suffix: 'k' }
    //               ];
    //               function formatNumber(n) {
    //                   for (var i = 0; i < ranges.length; i++) {
    //                     if (n >= ranges[i].divider) {
    //                         return (n / ranges[i].divider).toString() + ranges[i].suffix;
    //                     }
    //                   }
    //                   return n;
    //               }
    //               return formatNumber(value);
    //             }
    //           }
    //         }],
    //         xAxes: [{
    //           stacked: false,
    //           categoryPercentage: .5,
    //           barPercentage: 1,
    //           ticks: {
    //             beginAtZero: true,
    //             fontColor: "#000",
    //             display: true,
    //             fontSize: 14
    //           },
    //           gridLines: {
    //             color: "rgba(0, 0, 0, 0)",
    //             display: true
    //           },
    //         }]
    //       },
    //       legend: {
    //         display: false
    //       },
    //       elements: {
    //         point: {
    //           radius: 0
    //         }
    //       }
    //     }
    //   });
    // }
    //
    // if ($("#distribution-chart").length) {
    //   var areaData = {
    //     labels: ["Jan", "Feb", "Mar"],
    //     datasets: [{
    //         data: [100, 30, 70],
    //         backgroundColor: [
    //           "#3da5f4", "#f1536e", "#fda006"
    //         ],
    //         borderColor: "rgba(0,0,0,0)"
    //       }
    //     ]
    //   };
    //   var areaOptions = {
    //     responsive: true,
    //     maintainAspectRatio: true,
    //     segmentShowStroke: false,
    //     cutoutPercentage: 72,
    //     elements: {
    //       arc: {
    //           borderWidth: 4
    //       }
    //     },
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       enabled: true
    //     },
    //     legendCallback: function(chart) {
    //       var text = [];
    //       text.push('<div class="distribution-chart">');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[0] + '"></div>');
    //         text.push('<p>Texas</p>');
    //         text.push('</div>');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[1] + '"></div>');
    //         text.push('<p>Utah</p>');
    //         text.push('</div>');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[2] + '"></div>');
    //         text.push('<p>Georgia</p>');
    //         text.push('</div>');
    //       text.push('</div>');
    //       return text.join("");
    //     },
    //   }
    //   var distributionChartPlugins = {
    //     beforeDraw: function(chart) {
    //       var width = chart.chart.width,
    //           height = chart.chart.height,
    //           ctx = chart.chart.ctx;
    //
    //       ctx.restore();
    //       var fontSize = .96;
    //       ctx.font = "600 " + fontSize + "em sans-serif";
    //       ctx.textBaseline = "middle";
    //       ctx.fillStyle = "#000";
    //
    //       var text = "70%",
    //           textX = Math.round((width - ctx.measureText(text).width) / 2),
    //           textY = height / 2;
    //
    //       ctx.fillText(text, textX, textY);
    //       ctx.save();
    //     }
    //   }
    //   var distributionChartCanvas = $("#distribution-chart").get(0).getContext("2d");
    //   var distributionChart = new Chart(distributionChartCanvas, {
    //     type: 'doughnut',
    //     data: areaData,
    //     options: areaOptions,
    //     plugins: distributionChartPlugins
    //   });
    //   document.getElementById('distribution-legend').innerHTML = distributionChart.generateLegend();
    // }
    //
    // if ($("#distribution-chart-dark").length) {
    //   var areaData = {
    //     labels: ["Jan", "Feb", "Mar"],
    //     datasets: [{
    //         data: [100, 50, 50],
    //         backgroundColor: [
    //           "#00c689", "#3da5f4","#f1536e"
    //         ],
    //         borderColor: "rgba(0,0,0,0)"
    //       }
    //     ]
    //   };
    //   var areaOptions = {
    //     responsive: true,
    //     maintainAspectRatio: true,
    //     segmentShowStroke: false,
    //     cutoutPercentage: 72,
    //     elements: {
    //       arc: {
    //           borderWidth: 4
    //       }
    //     },
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       enabled: true
    //     },
    //     legendCallback: function(chart) {
    //       var text = [];
    //       text.push('<div class="distribution-chart">');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[0] + '"></div>');
    //         text.push('<p>Texas</p>');
    //         text.push('</div>');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[1] + '"></div>');
    //         text.push('<p>Utah</p>');
    //         text.push('</div>');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[2] + '"></div>');
    //         text.push('<p>Georgia</p>');
    //         text.push('</div>');
    //       text.push('</div>');
    //       return text.join("");
    //     },
    //   }
    //   var distributionChartPlugins = {
    //     beforeDraw: function(chart) {
    //       var width = chart.chart.width,
    //           height = chart.chart.height,
    //           ctx = chart.chart.ctx;
    //
    //       ctx.restore();
    //       var fontSize = .96;
    //       ctx.font = "600 " + fontSize + "em sans-serif";
    //       ctx.textBaseline = "middle";
    //       ctx.fillStyle = "#fff";
    //
    //       var text = "70%",
    //           textX = Math.round((width - ctx.measureText(text).width) / 2),
    //           textY = height / 2;
    //
    //       ctx.fillText(text, textX, textY);
    //       ctx.save();
    //     }
    //   }
    //   var distributionChartCanvas = $("#distribution-chart-dark").get(0).getContext("2d");
    //   var distributionChart = new Chart(distributionChartCanvas, {
    //     type: 'doughnut',
    //     data: areaData,
    //     options: areaOptions,
    //     plugins: distributionChartPlugins
    //   });
    //   document.getElementById('distribution-legend').innerHTML = distributionChart.generateLegend();
    // }
    //
    // if ($("#distribution-chart-dark").length) {
    //   var areaData = {
    //     labels: ["Jan", "Feb", "Mar"],
    //     datasets: [{
    //         data: [100, 50, 50],
    //         backgroundColor: [
    //           "#00c689", "#3da5f4","#f1536e"
    //         ],
    //         borderColor: "rgba(0,0,0,0)"
    //       }
    //     ]
    //   };
    //   var areaOptions = {
    //     responsive: true,
    //     maintainAspectRatio: true,
    //     segmentShowStroke: false,
    //     cutoutPercentage: 72,
    //     elements: {
    //       arc: {
    //           borderWidth: 4
    //       }
    //     },
    //     legend: {
    //       display: false
    //     },
    //     tooltips: {
    //       enabled: true
    //     },
    //     legendCallback: function(chart) {
    //       var text = [];
    //       text.push('<div class="distribution-chart">');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[0] + '"></div>');
    //         text.push('<p>Texas</p>');
    //         text.push('</div>');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[1] + '"></div>');
    //         text.push('<p>Utah</p>');
    //         text.push('</div>');
    //         text.push('<div class="item"><div class="legend-label" style="border: 3px solid ' + chart.data.datasets[0].backgroundColor[2] + '"></div>');
    //         text.push('<p>Georgia</p>');
    //         text.push('</div>');
    //       text.push('</div>');
    //       return text.join("");
    //     },
    //   }
    //   var distributionChartPlugins = {
    //     beforeDraw: function(chart) {
    //       var width = chart.chart.width,
    //           height = chart.chart.height,
    //           ctx = chart.chart.ctx;
    //
    //       ctx.restore();
    //       var fontSize = .96;
    //       ctx.font = "600 " + fontSize + "em sans-serif";
    //       ctx.textBaseline = "middle";
    //       ctx.fillStyle = "#b1b1b5";
    //
    //       var text = "70%",
    //           textX = Math.round((width - ctx.measureText(text).width) / 2),
    //           textY = height / 2;
    //
    //       ctx.fillText(text, textX, textY);
    //       ctx.save();
    //     }
    //   }
    //   var distributionChartCanvas = $("#distribution-chart-dark").get(0).getContext("2d");
    //   var distributionChart = new Chart(distributionChartCanvas, {
    //     type: 'doughnut',
    //     data: areaData,
    //     options: areaOptions,
    //     plugins: distributionChartPlugins
    //   });
    //   document.getElementById('distribution-legend').innerHTML = distributionChart.generateLegend();
    // }
    //
    // if ($("#sale-report-chart").length) {
    //   var CurrentChartCanvas = $("#sale-report-chart").get(0).getContext("2d");
    //   var CurrentChart = new Chart(CurrentChartCanvas, {
    //     type: 'bar',
    //     data: {
    //       labels: ["Jan","","Feb","","Mar", "", "Apr","", "May", "", "Jun"],
    //       datasets: [{
    //           label: 'Europe',
    //           data: [28000, 9000, 15000, 20000, 5000, 15000, 26000, 15000, 26000,20000, 28000],
    //           backgroundColor: ["#3da5f4","#e0f2ff","#3da5f4","#e0f2ff","#3da5f4","#e0f2ff","#3da5f4","#e0f2ff","#3da5f4","#e0f2ff","#3da5f4"]
    //         }
    //       ]
    //     },
    //     options: {
    //       responsive: true,
    //       maintainAspectRatio: true,
    //       layout: {
    //         padding: {
    //           left: 0,
    //           right: 0,
    //           top: 0,
    //           bottom: 0
    //         }
    //       },
    //       scales: {
    //         yAxes: [{
    //           display: true,
    //           gridLines: {
    //             drawBorder: false
    //           },
    //           ticks: {
    //             fontColor: "#000",
    //             display: true,
    //             padding: 20,
    //             fontSize: 14,
    //             stepSize: 10000,
    //             callback: function(value) {
    //               var ranges = [
    //                   { divider: 1e6, suffix: 'M' },
    //                   { divider: 1e3, suffix: 'k' }
    //               ];
    //               function formatNumber(n) {
    //                   for (var i = 0; i < ranges.length; i++) {
    //                     if (n >= ranges[i].divider) {
    //                         return (n / ranges[i].divider).toString() + ranges[i].suffix;
    //                     }
    //                   }
    //                   return n;
    //               }
    //               return "$" + formatNumber(value);
    //             }
    //           }
    //         }],
    //         xAxes: [{
    //           stacked: false,
    //           categoryPercentage: .6,
    //           ticks: {
    //             beginAtZero: true,
    //             fontColor: "#000",
    //             display: true,
    //             padding: 20,
    //             fontSize: 14
    //           },
    //           gridLines: {
    //             color: "rgba(0, 0, 0, 0)",
    //             display: true
    //           },
    //           barPercentage: .7
    //         }]
    //       },
    //       legend: {
    //         display: false
    //       },
    //       elements: {
    //         point: {
    //           radius: 0
    //         }
    //       }
    //     }
    //   });
    // }
    //
    // if ($("#sale-report-chart-dark").length) {
    //   var CurrentChartCanvas = $("#sale-report-chart-dark").get(0).getContext("2d");
    //   var CurrentChart = new Chart(CurrentChartCanvas, {
    //     type: 'bar',
    //     data: {
    //       labels: ["Jan","","Feb","","Mar", "", "Apr","", "May", "", "Jun"],
    //       datasets: [{
    //           label: 'Europe',
    //           data: [28000, 9000, 15000, 20000, 5000, 15000, 26000, 15000, 26000,20000, 28000],
    //           backgroundColor: ["#3da5f4","#f1536e","#3da5f4","#f1536e","#3da5f4","#f1536e","#3da5f4","#f1536e","#3da5f4","#f1536e","#3da5f4"]
    //         }
    //       ]
    //     },
    //     options: {
    //       responsive: true,
    //       maintainAspectRatio: true,
    //       layout: {
    //         padding: {
    //           left: 0,
    //           right: 0,
    //           top: 0,
    //           bottom: 0
    //         }
    //       },
    //       scales: {
    //         yAxes: [{
    //           display: true,
    //           gridLines: {
    //             drawBorder: false,
    //             color: "rgba(255, 255, 255, .1)",
    //             zeroLineColor: "rgba(255, 255, 255, .1)"
    //           },
    //           ticks: {
    //             fontColor: "#b1b1b5",
    //             display: true,
    //             padding: 20,
    //             fontSize: 14,
    //             stepSize: 10000,
    //             callback: function(value) {
    //               var ranges = [
    //                   { divider: 1e6, suffix: 'M' },
    //                   { divider: 1e3, suffix: 'k' }
    //               ];
    //               function formatNumber(n) {
    //                   for (var i = 0; i < ranges.length; i++) {
    //                     if (n >= ranges[i].divider) {
    //                         return (n / ranges[i].divider).toString() + ranges[i].suffix;
    //                     }
    //                   }
    //                   return n;
    //               }
    //               return "$" + formatNumber(value);
    //             }
    //           }
    //         }],
    //         xAxes: [{
    //           stacked: false,
    //           categoryPercentage: .6,
    //           ticks: {
    //             beginAtZero: true,
    //             fontColor: "#b1b1b5",
    //             display: true,
    //             padding: 20,
    //             fontSize: 14
    //           },
    //           gridLines: {
    //             color: "rgba(0, 0, 0, 0)",
    //             display: true
    //           },
    //           barPercentage: .7
    //         }]
    //       },
    //       legend: {
    //         display: false
    //       },
    //       elements: {
    //         point: {
    //           radius: 0
    //         }
    //       }
    //     }
    //   });
    // }

  });
})(jQuery);
</script>
@parent

@endsection
