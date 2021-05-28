@extends('layout.main')
@section('content')
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
      <div class="flex flex-wrap ">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
          <div class="md:w-full pr-4 pl-4">
            <div class="brand-text float-left mt-4">
                <h3>{{trans('file.welcome')}} <span>{{Auth::user()->name}}</span> </h3>
            </div>
            <div class="filter-toggle">
              <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline date-btn text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600" data-start_date="{{date('Y-m-d')}}" data-end_date="{{date('Y-m-d')}}">{{trans('file.Today')}}</button>
              <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline date-btn text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600" data-start_date="{{date('Y-m-d', strtotime(' -7 day'))}}" data-end_date="{{date('Y-m-d')}}">{{trans('file.Last 7 Days')}}</button>
              <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline date-btn text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600 active" data-start_date="{{date('Y').'-'.date('m').'-'.'01'}}" data-end_date="{{date('Y-m-d')}}">{{trans('file.This Month')}}</button>
              <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline date-btn text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600" data-start_date="{{date('Y').'-01'.'-01'}}" data-end_date="{{date('Y').'-12'.'-31'}}">{{trans('file.This Year')}}</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Counts Section -->
      <section class="dashboard-counts">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
          <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4 mb-4">
              <div class="flex flex-wrap ">
                <!-- Count item widget-->
                <div class="sm:w-1/2 pr-4 pl-4">
                  <div class="wrapper count-title bg-gradient-success text-center">
                    <div class="icon"><i class="dripicons-graph-bar"></i></div>
                    <div class="name"><strong>{{ trans('file.revenue') }}</strong></div>
                    <div class="count-number revenue-data">{{number_format((float)$revenue, 2, '.', '')}}</div>
                  </div>
                </div>
                <!-- Count item widget-->
                <div class="sm:w-1/2 pr-4 pl-4">
                  <div class="wrapper count-title bg-gradient-success text-center">
                    <div class="icon"><i class="dripicons-trophy"></i></div>
                    <div class="name"><strong>{{trans('file.profit')}}</strong></div>
                    <div class="count-number profit-data">{{number_format((float)$profit, 2, '.', '')}}</div>
                  </div>
                </div>
              </div>
                <div class="flex flex-wrap ">
                <div class="lg:w-1/4 pr-4 pl-4 md:w-1/4 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 sm:w-1/2 pr-4 pl-4">
                  <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="flex-auto p-6">
                              <div class="avatar bg-rgba-success  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-user text-green-500 icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700">{{$count_customers}}</h2>
                              <p class="mb-0 line-ellipsis">{{__('Customers')}}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="lg:w-1/4 pr-4 pl-4 md:w-1/4 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 sm:w-1/2 pr-4 pl-4">
                  <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="flex-auto p-6">
                              <div class="avatar bg-rgba-danger  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-money text-red-600 icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700">{{$count_sales}}</h2>
                              <p class="mb-0 line-ellipsis">{{__('Sales')}}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="lg:w-1/4 pr-4 pl-4 md:w-1/4 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 sm:w-1/2 pr-4 pl-4">
                  <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="flex-auto p-6">
                              <div class="avatar bg-rgba-info  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-eye text-teal-500 icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700">{{$count_purchases}}</h2>
                              <p class="mb-0 line-ellipsis">{{__('Purchases')}}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="lg:w-1/4 pr-4 pl-4 md:w-1/4 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 sm:w-1/2 pr-4 pl-4">
                  <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="flex-auto p-6">
                              <div class="avatar bg-rgba-warning  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-truck text-yellow-500 icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700">{{$count_products}}</h2>
                              <p class="mb-0 line-ellipsis">{{__('Products')}}</p>
                          </div>
                      </div>
                   </div>
               </div>
            </div>
            <div class="flex flex-wrap ">
                   <!-- Count item widget-->
                 <div class="sm:w-1/5 pr-4 pl-4">
                  <div class="wrapper gradient-light-danger text-center">
                  <a class="dashboard-full" href="{{route('sales.create')}}">
                    <div class="name"><strong>{{ trans('file.Add Sale') }}</strong></div>
                    <div class="count-number"><i class="dripicons-shopping-bag"></i></div>
                  </a>
                  </div>
                </div>

                <!-- Count item widget-->
                <div class="sm:w-1/5 pr-4 pl-4">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" href="{{route('products.create')}}">
                    <div class="name"><strong>{{__('file.add_product')}}</strong></div>
                    <div class="count-number"><i class="dripicons-box"></i></div> </a>
                  </div>
                </div>
               <!-- Count item widget-->
                <div class="sm:w-1/5 pr-4 pl-4">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" href="{{route('quotations.create')}}">
                    <div class="name"><strong>{{trans('file.Add Quotation')}}</strong></div>
                    <div class="count-number"><i class="dripicons-question"></i></div></a>
                  </div>
                </div>
                <!-- Count item widget-->
                <div class="sm:w-1/5 pr-4 pl-4">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" href="{{route('customer.create')}}">
                    <div class="name"><strong>{{trans('file.Add Customer')}}</strong></div>
                    <div class="count-number"><i class="dripicons-user"></i></div></a>
                  </div>
                </div>
                @if(in_array("expenses-add", $all_permission))
                <div class="sm:w-1/5 pr-4 pl-4">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" data-toggle="modal" data-target="#expense-modal">
                    <div class="name"><strong>{{trans('file.Add Expense')}}</strong></div>
                    <div class="count-number"><i class="dripicons-plus"></i> </i></div></a>
                  </div>
                </div>
                @endif
                <div class="sm:w-1/5 pr-4 pl-4">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" data-toggle="modal" data-target="#activity-modal">
                    <div class="name"><strong>{{trans('file.Add Activity')}}</strong></div>
                    <div class="count-number"><i class="dripicons-plus"></i> </i></div></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="md:w-3/5 pr-4 pl-4 mt-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 line-chart-example">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                  <h4>{{trans('file.Cash Flow')}}</h4>
                </div>
                <div class="flex-auto p-6">
                  @php
                    if($general_setting->theme == 'default.css'){
                      $color = '#733686';
                      $color_rgba = 'rgba(115, 54, 134, 0.8)';
                    }
                    elseif($general_setting->theme == 'green.css'){
                        $color = '#2ecc71';
                        $color_rgba = 'rgba(46, 204, 113, 0.8)';
                    }
                    elseif($general_setting->theme == 'blue.css'){
                        $color = '#3498db';
                        $color_rgba = 'rgba(52, 152, 219, 0.8)';
                    }
                    elseif($general_setting->theme == 'dark.css'){
                        $color = '#34495e';
                        $color_rgba = 'rgba(52, 73, 94, 0.8)';
                    }
                  @endphp
                  <canvas id="cashFlow" data-color = "{{$color}}" data-color_rgba = "{{$color_rgba}}" data-recieved = "{{json_encode($payment_recieved)}}" data-sent = "{{json_encode($payment_sent)}}" data-month = "{{json_encode($month)}}" data-label1="{{trans('file.Payment Recieved')}}" data-label2="{{trans('file.Payment Sent')}}"></canvas>
                </div>
              </div>
            </div>
            <div class="md:w-2/5 pr-4 pl-4 mt-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex justify-between items-center">
                  <h4>{{date('F')}} {{date('Y')}}</h4>
                </div>
                <div class="pie-chart mb-2">
                    <canvas id="transactionChart" data-color = "{{$color}}" data-color_rgba = "{{$color_rgba}}" data-revenue={{$revenue}} data-purchase={{$purchase}} data-label1="{{trans('file.Purchase')}}" data-label2="{{trans('file.revenue')}}" width="100" height="95"> </canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
          <div class="flex flex-wrap ">
            <div class="md:w-1/2 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                  <h4>{{trans('file.yearly report')}}</h4>
                </div>
                <div class="flex-auto p-6">
                  <canvas id="saleChart" data-sale_chart_value = "{{json_encode($yearly_sale_amount)}}" data-purchase_chart_value = "{{json_encode($yearly_purchase_amount)}}" data-label1="{{trans('file.Purchased Amount')}}" data-label2="{{trans('file.Sold Amount')}}"></canvas>
                </div>
              </div>
            </div>
            <div class="md:w-1/2 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
              <div class="response"></div>
              <div id='calendar'></div>  
              </div>
            </div>
            <div class="md:w-3/5 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex justify-between items-center" style="color:white;background-color:#300ED7;">
                  <h4>{{trans('file.Recent Transaction')}}</h4>
                  <div class="right-column">
                    <div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{trans('file.latest')}} 5</div>
                  </div>
                </div>
                <ul class="flex flex-wrap list-none pl-0 mb-0 border border-t-0 border-r-0 border-l-0 border-b-1 border-gray-200 " role="tablist">
                  <li class="">
                    <a class="inline-block py-2 px-4 no-underline active" href="#sale-latest" role="tab" data-toggle="tab">{{trans('file.Sale')}}</a>
                  </li>
                  <li class="">
                    <a class="inline-block py-2 px-4 no-underline" href="#purchase-latest" role="tab" data-toggle="tab">{{trans('file.Purchase')}}</a>
                  </li>
                  <li class="">
                    <a class="inline-block py-2 px-4 no-underline" href="#quotation-latest" role="tab" data-toggle="tab">{{trans('file.Quotation')}}</a>
                  </li>
                  <li class="">
                    <a class="inline-block py-2 px-4 no-underline" href="#payment-latest" role="tab" data-toggle="tab">{{trans('file.Payment')}}</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane opacity-0 opacity-100 block active" id="sale-latest">
                      <div class="block w-full overflow-auto scrolling-touch">
                        <table class="w-full max-w-full mb-4 bg-transparent table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th>{{trans('file.date')}}</th>
                              <th>{{trans('file.reference')}}</th>
                              <th>{{trans('file.customer')}}</th>
                              <th>{{trans('file.status')}}</th>
                              <th>{{trans('file.grand total')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_sale as $sale)
                            <?php $customer = DB::table('customers')->find($sale->customer_id); ?>
                            <tr>
                              <td>{{ date($general_setting->date_format, strtotime($sale->created_at->toDateString())) }}</td>
                              <td>{{$sale->reference_no}}</td>
                              <td>{{$customer->name}}</td>
                              @if($sale->sale_status == 1)
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">{{trans('file.Completed')}}</div></td>
                              @elseif($sale->sale_status == 2)
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">{{trans('file.Pending')}}</div></td>
                              @else
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">{{trans('file.Draft')}}</div></td>
                              @endif
                              <td>{{$sale->grand_total}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane opacity-0" id="purchase-latest">
                      <div class="block w-full overflow-auto scrolling-touch">
                        <table class="w-full max-w-full mb-4 bg-transparent table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th>{{trans('file.date')}}</th>
                              <th>{{trans('file.reference')}}</th>
                              <th>{{trans('file.Supplier')}}</th>
                              <th>{{trans('file.status')}}</th>
                              <th>{{trans('file.grand total')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_purchase as $purchase)
                            <?php $supplier = DB::table('suppliers')->find($purchase->supplier_id); ?>
                            <tr>
                              <td>{{date($general_setting->date_format, strtotime($purchase->created_at->toDateString())) }}</td>
                              <td>{{$purchase->reference_no}}</td>
                              @if($supplier)
                                <td>{{$supplier->name}}</td>
                              @else
                                <td>N/A</td>
                              @endif
                              @if($purchase->status == 1)
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">Recieved</div></td>
                              @elseif($purchase->status == 2)
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">Partial</div></td>
                              @elseif($purchase->status == 3)
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">Pending</div></td>
                              @else
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">Ordered</div></td>
                              @endif
                              <td>{{$purchase->grand_total}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane opacity-0" id="quotation-latest">
                      <div class="block w-full overflow-auto scrolling-touch">
                      <table class="w-full max-w-full mb-4 bg-transparent table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th>{{trans('file.date')}}</th>
                              <th>{{trans('file.reference')}}</th>
                              <th>{{trans('file.customer')}}</th>
                              <th>{{trans('file.status')}}</th>
                              <th>{{trans('file.grand total')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_quotation as $quotation)
                            <?php $customer = DB::table('customers')->find($quotation->customer_id); ?>
                            <tr>
                              <td>{{date($general_setting->date_format, strtotime($quotation->created_at->toDateString())) }}</td>
                              <td>{{$quotation->reference_no}}</td>
                              <td>{{$customer->name}}</td>
                              @if($quotation->quotation_status == 1)
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">Pending</div></td>
                              @else
                              <td><div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">Sent</div></td>
                              @endif
                              <td>{{$quotation->grand_total}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane opacity-0" id="payment-latest">
                      <div class="block w-full overflow-auto scrolling-touch">
                        <table class="w-full max-w-full mb-4 bg-transparent table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th>{{trans('file.date')}}</th>
                              <th>{{trans('file.reference')}}</th>
                              <th>{{trans('file.Amount')}}</th>
                              <th>{{trans('file.Paid By')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_payment as $payment)
                            <tr>
                              <td>{{date($general_setting->date_format, strtotime($payment->created_at->toDateString())) }}</td>
                              <td>{{$payment->payment_reference}}</td>
                              <td>{{$payment->amount}}</td>
                              <td>{{$payment->paying_method}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="md:w-2/5 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex justify-between items-center" style="color:white;background-color:#300ED7;">
                  <h4>{{trans('file.Best Seller').' '.date('F')}}</h4>
                  <div class="right-column">
                    <div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{trans('file.top')}} 5</div>
                  </div>
                </div>
                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>TOP 5</th>
                          <th>{{trans('file.Product Details')}}</th>
                          <th>{{trans('file.qty')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($best_selling_qty as $key=>$sale)
                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$product->name}} - [{{$product->code}}]</td>
                          <td>{{$sale->sold_qty}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <div class="md:w-1/2 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex justify-between items-center" style="color:white;background-color:#300ED7;">
                  <h4>{{trans('file.Best Seller').' '.date('Y'). ' ('.trans('file.qty').')'}}</h4>
                  <div class="right-column">
                    <div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{trans('file.top')}} 5</div>
                  </div>
                </div>
                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>TOP 5</th>
                          <th>{{trans('file.Product Details')}}</th>
                          <th>{{trans('file.qty')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($yearly_best_selling_qty as $key => $sale)
                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$product->name}} - [{{$product->code}}]</td>
                          <td>{{$sale->sold_qty}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <div class="md:w-1/2 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex justify-between items-center" style="color:white;background-color:#300ED7;">
                  <h4>{{trans('file.Best Seller').' '.date('Y') . ' ('.trans('file.price').')'}}</h4>
                  <div class="right-column">
                    <div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-blue-500 text-white hover:bg-blue-600">{{trans('file.top')}} 5</div>
                  </div>
                </div>
                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>TOP 5</th>
                          <th>{{trans('file.Product Details')}}</th>
                          <th>{{trans('file.grand total')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($yearly_best_selling_price as $key => $sale)
                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$product->name}} - [{{$product->code}}]</td>
                          <td>{{number_format((float)$sale->total_price, 2, '.', '')}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
<script type="text/javascript">

 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    var all_permission = <?php echo json_encode($all_permission) ?>;


    // Show and hide color-switcher
    $(".color-switcher .switcher-button").on('click', function() {
        $(".color-switcher").toggleClass("show-color-switcher", "hide-color-switcher", 300);
    });

    // Color Skins
    $('a.color').on('click', function() {
        /*var title = $(this).attr('title');
        $('#style-colors').attr('href', 'css/skin-' + title + '.css');
        return false;*/
        $.get('setting/general_setting/change-theme/' + $(this).data('color'), function(data) {
        });
        var style_link= $('#custom-style').attr('href').replace(/([^-]*)$/, $(this).data('color') );
        $('#custom-style').attr('href', style_link);
    });

    $(".date-btn").on("click", function() {
        $(".date-btn").removeClass("active");
        $(this).addClass("active");
        var start_date = $(this).data('start_date');
        var end_date = $(this).data('end_date');
        $.get('dashboard-filter/' + start_date + '/' + end_date, function(data) {
            dashboardFilter(data);
        });
    });

    function dashboardFilter(data){
        $('.revenue-data').hide();
        $('.revenue-data').html(parseFloat(data[0]).toFixed(2));
        $('.revenue-data').show(500);

        $('.return-data').hide();
        $('.return-data').html(parseFloat(data[1]).toFixed(2));
        $('.return-data').show(500);

        $('.profit-data').hide();
        $('.profit-data').html(parseFloat(data[2]).toFixed(2));
        $('.profit-data').show(500);

        $('.purchase_return-data').hide();
        $('.purchase_return-data').html(parseFloat(data[3]).toFixed(2));
        $('.purchase_return-data').show(500);
    }
</script>
<script type="text/javascript">

    $(document).ready(function () {
    var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
 
        var calendar = $('#calendar').fullCalendar({
            lang:'fr',
            events: SITEURL + "/fullcalendar",
            displayEventTime: false,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Titre ou Date:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
             $.ajax({
               url: SITEURL + "/fullcalendar/create",
              data: 'title=' + title + '&start=' + start + '&end=' + end,
              type: "POST",
            success: function (data) {
            alert("Creer avec succes");         }
     });
     calendar.fullCalendar('renderEvent',
             {
                 title: title,
                 start: start,
                 end: end,
                 allDay: allDay
             },
     true
             );
 }
 calendar.fullCalendar('unselect');
},

eventDrop: function (event, delta) {
         var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
         var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
         $.ajax({
             url: SITEURL + '/fullcalendar/update',
             data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&amp;id=' + event.id,
             type: "POST",
             success: function (response) {
                calendar.fullCalendar('refetchEvents');
                alert('Evenement a jour');             }
         });
     },
     eventResize: function(event) {
   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
    url: SITEURL + '/fullcalendar/update',
    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&amp;id='+ event.id ,
    type: "POST",
    success: function(json) {
        calendar.fullCalendar('refetchEvents');
     alert("Evenement a jour");
    }
    });
    },
eventClick: function (event) {
 var deleteMsg = confirm("Vous voulez Supprimer?");
 if (deleteMsg) {
     $.ajax({
         type: "POST",
         url: SITEURL + '/fullcalendar/delete',
         data: "&id=" + event.id,
         success: function (response) {
             if(parseInt(response) > 0) {
                 $('#calendar').fullCalendar('removeEvents', event.id);
                 alert("Evenement Supprimer");             }
         }
     });
 }
}

});
});
  function displayMessage(message) {
    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
  }
</script>
@endsection

