@extends('layout.main')
@section('content')
    @if (session()->has('not_permitted'))
        <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button
                type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    @if (session()->has('message'))
        <div class="relative px-3 py-3 mb-4 border rounded bg-blue-600 border-green-300 text-green-800  text-center"><button
                type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
    @endif
    <div class="flex flex-wrap px-4">
        <div class="w-full mt-6">
            <div class="font-bold uppercase text-blue-600 float-left">
                <h3>{{ trans('file.welcome') }} <span>{{ Auth::user()->name }}</span> </h3>
            </div>
            <div class="float-right">
                <button
                    class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded-lg py-1 px-3 leading-normal no-underline date-btn  text-white bg-blue-600 border-blue-600"
                    data-start_date="{{ date('Y-m-d') }}"
                    data-end_date="{{ date('Y-m-d') }}">{{ trans('file.Today') }}</button>
                <button
                    class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded-lg py-1 px-3 leading-normal no-underline date-btn  text-white bg-blue-600 border-blue-600"
                    data-start_date="{{ date('Y-m-d', strtotime(' -7 day')) }}"
                    data-end_date="{{ date('Y-m-d') }}">{{ trans('file.Last 7 Days') }}</button>
                <button
                    class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded-lg py-1 px-3 leading-normal no-underline date-btn  text-white bg-blue-600 border-blue-600  active"
                    data-start_date="{{ date('Y') . '-' . date('m') . '-' . '01' }}"
                    data-end_date="{{ date('Y-m-d') }}">{{ trans('file.This Month') }}</button>
                <button
                    class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded-lg py-1 px-3 leading-normal no-underline date-btn  text-white bg-blue-600 border-blue-600"
                    data-start_date="{{ date('Y') . '-01' . '-01' }}"
                    data-end_date="{{ date('Y') . '-12' . '-31' }}">{{ trans('file.This Year') }}</button>
            </div>
        </div>
    </div>
    <!-- Counts Section -->
    <section class="dashboard-counts">
        <div class="mx-auto px-4 max-w-full">
            <div class="flex flex-wrap">
                <!-- Count item widget-->
                <div class="w-1/2 px-4 py-2 bg-white">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-24 h-24  bg-blue-600 text-white rounded-full relative">
                            <i class="dripicons-graph-bar text-5xl text-white mt-3 flex items-center justify-center"></i>
                        </div>
                        <p class="text-gray-800 text-lg font-medium my-2">
                            {{ trans('file.revenue') }}
                        </p>
                        <p class="text-gray-400 text-center text-lg px-2 revenue-data">
                            {{ number_format((float) $revenue, 2, '.', '') }}
                        </p>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="w-1/2 px-4 py-2 bg-white">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-24 h-24  bg-blue-600 text-white rounded-full relative">
                            <i class="dripicons-trophy text-5xl text-white mt-3 flex items-center justify-center"></i>
                        </div>
                        <p class="text-gray-800 text-lg font-medium my-2">
                            {{ trans('file.profit') }}
                        </p>
                        <p class="text-gray-400 text-center text-lg px-2 profit-data">
                            {{ number_format((float) $profit, 2, '.', '') }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- <div class="flex flex-wrap bg-white">
                <div class="my-2 px-2 lg:w-1/4 sm:w-2/4  ">
                    <div class="w-full h-full text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-24 h-24  bg-blue-600 text-white rounded-full relative">
                               <p class="text-5xl text-white mt-2 flex items-center justify-center">
                                   {{ $count_customers }}
                               </p>
                            </div>
                            <p class="text-gray-800 text-xl font-medium py-2 px-6">
                                {{ trans('file.Customers') }} 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="my-2 px-2 lg:w-1/4 sm:w-2/4  ">
                    <div class="w-full h-full text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-24 h-24  bg-blue-600 text-white rounded-full relative">
                                <p class="text-5xl text-white mt-2 flex items-center justify-center">
                                {{ $count_sales }}
                                </p>
                            </div>
                            <p class="text-gray-800 text-xl font-medium py-2 px-6">
                               {{ trans('file.Sales') }} 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="my-2 px-2 lg:w-1/4 sm:w-2/4  ">
                    <div class="w-full h-full text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-24 h-24  bg-blue-600 text-white rounded-full relative">
                                <p class="text-5xl text-white mt-2 flex items-center justify-center">
                                {{ $count_purchases }}
                                </p>
                            </div>
                            <p class="text-gray-800 text-xl font-medium py-2 px-6">
                                {{ trans('file.Purchases') }} 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="my-2 px-2 lg:w-1/4 sm:w-2/4  ">
                    <div class="w-full h-full text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-24 h-24  bg-blue-600 text-white rounded-full relative">
                                <p class="text-5xl text-white mt-2 flex items-center justify-center">
                                {{ $count_products }}
                                </p>
                            </div>
                            <p class="text-gray-800 text-xl font-medium py-2 px-6">
                               {{ trans('file.Products') }} 
                            </p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="flex flex-wrap -mx-2">
                <!-- Count item widget-->
                <div class="my-2 px-2 xl:w-1/6 md:w-1/6 sm:w-1/3">
                    <div class="wrapper bg-blue-600 border-blue-600 text-center p-4">
                        <a class="dashboard-full" href="{{ route('sales.create') }}">
                            <div class="text-white"><strong>{{ trans('file.Add Sale') }}</strong></div>
                            <div class="count-number"><i class="dripicons-shopping-bag"></i></div>
                        </a>
                    </div>
                </div>

                <!-- Count item widget-->
                <div class="my-2 px-2 xl:w-1/6 md:w-1/6 sm:w-1/3">
                    <div class="wrapper bg-blue-600 border-blue-600 text-center p-4">
                        <a class="dashboard-full" href="{{ route('products.create') }}">
                            <div class="text-white"><strong>{{ __('file.add_product') }}</strong></div>
                            <div class="count-number"><i class="dripicons-box"></i></div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="my-2 px-2 xl:w-1/6 md:w-1/6 sm:w-1/3">
                    <div class="wrapper bg-blue-600 border-blue-600 text-center p-4">
                        <a class="dashboard-full" href="{{ route('quotations.create') }}">
                            <div class="text-white"><strong>{{ trans('file.Add Quotation') }}</strong></div>
                            <div class="count-number"><i class="dripicons-question"></i></div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="my-2 px-2 xl:w-1/6 md:w-1/6 sm:w-1/3">
                    <div class="wrapper bg-blue-600 border-blue-600 text-center p-4">
                        <a class="dashboard-full" href="{{ route('customer.create') }}">
                            <div class="text-white"><strong>{{ trans('file.Add Customer') }}</strong></div>
                            <div class="count-number"><i class="dripicons-user"></i></div>
                        </a>
                    </div>
                </div>
                @if (in_array('expenses-add', $all_permission))
                    <div class="my-2 px-2 xl:w-1/6 md:w-1/6 sm:w-1/3">
                        <div class="wrapper bg-blue-600 border-blue-600 text-center p-4">
                            <a class="dashboard-full" data-toggle="modal" data-target="#expense-modal">
                                <div class="text-white"><strong>{{ trans('file.Add Expense') }}</strong>
                                </div>
                                <div class="count-number"><i class="dripicons-plus"></i> </i></div>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="my-2 px-2 xl:w-1/6 md:w-1/6 sm:w-1/3">
                    <div class="wrapper bg-blue-600 border-blue-600 text-center p-4">
                        <a class="dashboard-full" data-toggle="modal" data-target="#activity-modal">
                            <div class="text-white"><strong>{{ trans('file.Add Activity') }}</strong></div>
                            <div class="count-number"><i class="dripicons-plus"></i> </i></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap  -mx-2 ">
                <div class="my-2 px-2 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2">
                    <div
                        class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1  line-chart-example">
                        <div class="py-3 px-6 mb-0 bg-blue-600 border-b-1  text-white flex items-center">
                            <h4>{{ trans('file.Cash Flow') }}</h4>
                        </div>
                        <div class="flex-auto p-6">
                            @php
                                if ($general_setting->theme == 'default.css') {
                                    $color = '#733686';
                                    $color_rgba = 'rgba(115, 54, 134, 0.8)';
                                } elseif ($general_setting->theme == 'green.css') {
                                    $color = '#2ecc71';
                                    $color_rgba = 'rgba(46, 204, 113, 0.8)';
                                } elseif ($general_setting->theme == 'blue.css') {
                                    $color = '#3498db';
                                    $color_rgba = 'rgba(52, 152, 219, 0.8)';
                                } elseif ($general_setting->theme == 'dark.css') {
                                    $color = '#34495e';
                                    $color_rgba = 'rgba(52, 73, 94, 0.8)';
                                }
                            @endphp
                            <canvas id="cashFlow" data-color="{{ $color }}" data-color_rgba="{{ $color_rgba }}"
                                data-recieved="{{ json_encode($payment_recieved) }}"
                                data-sent="{{ json_encode($payment_sent) }}" data-month="{{ json_encode($month) }}"
                                data-label1="{{ trans('file.Payment Recieved') }}"
                                data-label2="{{ trans('file.Payment Sent') }}"></canvas>
                        </div>
                    </div>
                </div>
                <div class="my-2 px-2 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 ">
                        <div class="py-3 px-6 mb-0 bg-blue-600 border-b-1  text-white flex justify-between items-center">
                            <h4>{{ date('F') }} {{ date('Y') }}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                            <canvas id="transactionChart" data-color="{{ $color }}"
                                data-color_rgba="{{ $color_rgba }}" data-revenue={{ $revenue }}
                                data-purchase={{ $purchase }} data-label1="{{ trans('file.Purchase') }}"
                                data-label2="{{ trans('file.revenue') }}" width="100" height="95"> </canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-2">
                <div class="w-full px-3 mt-4">
                    <div
                        class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                        <div class="py-3 px-6 mb-0 bg-blue-600 border-b-1 border-gray-300 text-white flex items-center">
                            <h4>{{ trans('file.yearly report') }}</h4>
                        </div>
                        <div class="flex-auto p-6">
                            <canvas id="saleChart" data-sale_chart_value="{{ json_encode($yearly_sale_amount) }}"
                                data-purchase_chart_value="{{ json_encode($yearly_purchase_amount) }}"
                                data-label1="{{ trans('file.Purchased Amount') }}"
                                data-label2="{{ trans('file.Sold Amount') }}"></canvas>
                        </div>
                    </div>
                </div>

                {{-- <div class="w-1/2 px-2">
                    <div
                        class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                        <div class="response"></div>
                        <div id='calendar'></div>
                    </div>
                </div> --}}

                <div class="my-2 px-2 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2">
                    <div
                        class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                        <div
                            class="py-3 px-6 mb-0 bg-blue-600 border-b-1 border-gray-300 text-white flex justify-between items-center">
                            <h4>{{ trans('file.Recent Transaction') }}</h4>
                            <div class="right-column">
                                <div
                                    class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-500 text-white">
                                    {{ trans('file.latest') }} 5</div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#sale-latest" role="tab"
                                    data-toggle="tab">{{ trans('file.Sale') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#purchase-latest" role="tab"
                                    data-toggle="tab">{{ trans('file.Purchase') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#quotation-latest" role="tab"
                                    data-toggle="tab">{{ trans('file.Quotation') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#payment-latest" role="tab" 
                                    data-toggle="tab">{{ trans('file.Payment') }}</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="sale-latest">
                                <div class="block w-full">
                                    <table class="table w-full max-w-full mb-4 bg-transparent table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ trans('file.date') }}</th>
                                                <th>{{ trans('file.reference') }}</th>
                                                <th>{{ trans('file.customer') }}</th>
                                                <th>{{ trans('file.status') }}</th>
                                                <th>{{ trans('file.grand total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recent_sale as $sale)
                                                <?php $customer = DB::table('customers')->find($sale->customer_id); ?>
                                                <tr>
                                                    <td>{{ date($general_setting->date_format, strtotime($sale->created_at->toDateString())) }}
                                                    </td>
                                                    <td>{{ $sale->reference_no }}</td>
                                                    <td>{{ $customer->name }}</td>
                                                    @if ($sale->sale_status == 1)
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">
                                                                {{ trans('file.Completed') }}</div>
                                                        </td>
                                                    @elseif($sale->sale_status == 2)
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">
                                                                {{ trans('file.Pending') }}</div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">
                                                                {{ trans('file.Draft') }}</div>
                                                        </td>
                                                    @endif
                                                    <td>{{ $sale->grand_total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="purchase-latest">
                                <div class="block w-full">
                                    <table class="table w-full max-w-full mb-4 bg-transparent table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ trans('file.date') }}</th>
                                                <th>{{ trans('file.reference') }}</th>
                                                <th>{{ trans('file.Supplier') }}</th>
                                                <th>{{ trans('file.status') }}</th>
                                                <th>{{ trans('file.grand total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recent_purchase as $purchase)
                                                <?php $supplier = DB::table('suppliers')->find($purchase->supplier_id); ?>
                                                <tr>
                                                    <td>{{ date($general_setting->date_format, strtotime($purchase->created_at->toDateString())) }}
                                                    </td>
                                                    <td>{{ $purchase->reference_no }}</td>
                                                    @if ($supplier)
                                                        <td>{{ $supplier->name }}</td>
                                                    @else
                                                        <td>N/A</td>
                                                    @endif
                                                    @if ($purchase->status == 1)
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">
                                                                Recieved</div>
                                                        </td>
                                                    @elseif($purchase->status == 2)
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">
                                                                Partial</div>
                                                        </td>
                                                    @elseif($purchase->status == 3)
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">
                                                                Pending</div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">
                                                                Ordered</div>
                                                        </td>
                                                    @endif
                                                    <td>{{ $purchase->grand_total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="quotation-latest">
                                <div class="block w-full">
                                    <table class="table w-full max-w-full mb-4 bg-transparent table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ trans('file.date') }}</th>
                                                <th>{{ trans('file.reference') }}</th>
                                                <th>{{ trans('file.customer') }}</th>
                                                <th>{{ trans('file.status') }}</th>
                                                <th>{{ trans('file.grand total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recent_quotation as $quotation)
                                                <?php $customer = DB::table('customers')->find($quotation->customer_id); ?>
                                                <tr>
                                                    <td>{{ date($general_setting->date_format, strtotime($quotation->created_at->toDateString())) }}
                                                    </td>
                                                    <td>{{ $quotation->reference_no }}</td>
                                                    <td>{{ $customer->name }}</td>
                                                    @if ($quotation->quotation_status == 1)
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-600 text-white hover:bg-red-700">
                                                                Pending</div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div
                                                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600">
                                                                Sent</div>
                                                        </td>
                                                    @endif
                                                    <td>{{ $quotation->grand_total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="payment-latest">
                                <div class="block w-full">
                                    <table class="table w-full max-w-full mb-4 bg-transparent table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ trans('file.date') }}</th>
                                                <th>{{ trans('file.reference') }}</th>
                                                <th>{{ trans('file.Amount') }}</th>
                                                <th>{{ trans('file.Paid By') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recent_payment as $payment)
                                                <tr>
                                                    <td>{{ date($general_setting->date_format, strtotime($payment->created_at->toDateString())) }}
                                                    </td>
                                                    <td>{{ $payment->payment_reference }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    <td>{{ $payment->paying_method }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-2 px-2 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2">
                    <div
                        class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                        <div
                            class="py-3 px-6 mb-0 bg-blue-600 border-b-1 border-gray-300 text-white flex justify-between items-center">
                            <h4>{{ trans('file.Best Seller') . ' ' . date('F') }}</h4>
                            <div class="right-column">
                                <div
                                    class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-500 text-white">
                                    {{ trans('file.top') }} 5</div>
                            </div>
                        </div>
                        <div class="block w-full">
                            <table class="table w-full max-w-full mb-4 bg-transparent table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>TOP 5</th>
                                        <th>{{ trans('file.Product Details') }}</th>
                                        <th>{{ trans('file.qty') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($best_selling_qty as $key => $sale)
                                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $product->name }} - [{{ $product->code }}]</td>
                                            <td>{{ $sale->sold_qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="my-2 px-2 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2">
                    <div
                        class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                        <div
                            class="py-3 px-6 mb-0 bg-blue-600 border-b-1 border-gray-300 text-white flex justify-between items-center">
                            <h4>{{ trans('file.Best Seller') . ' ' . date('Y') . ' (' . trans('file.qty') . ')' }}</h4>
                            <div class="right-column">
                                <div
                                    class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-500 text-white">
                                    {{ trans('file.top') }} 5</div>
                            </div>
                        </div>
                        <div class="block w-full">
                            <table class="table w-full max-w-full mb-4 bg-transparent table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>TOP 5</th>
                                        <th>{{ trans('file.Product Details') }}</th>
                                        <th>{{ trans('file.qty') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yearly_best_selling_qty as $key => $sale)
                                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $product->name }} - [{{ $product->code }}]</td>
                                            <td>{{ $sale->sold_qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="my-2 px-2 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2">
                    <div
                        class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                        <div
                            class="py-3 px-6 mb-0 bg-blue-600 border-b-1 border-gray-300 text-white flex justify-between items-center">
                            <h4>{{ trans('file.Best Seller') . ' ' . date('Y') . ' (' . trans('file.price') . ')' }}
                            </h4>
                            <div class="right-column">
                                <div
                                    class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-red-500 text-white">
                                    {{ trans('file.top') }} 5</div>
                            </div>
                        </div>
                        <div class="block w-full">
                            <table class="table w-full max-w-full mb-4 bg-transparent table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>TOP 5</th>
                                        <th>{{ trans('file.Product Details') }}</th>
                                        <th>{{ trans('file.grand total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yearly_best_selling_price as $key => $sale)
                                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $product->name }} - [{{ $product->code }}]</td>
                                            <td>{{ number_format((float) $sale->total_price, 2, '.', '') }}</td>
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

        var all_permission = <?php echo json_encode($all_permission); ?>;

        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setInterval(function() {
                $(".success").fadeOut();
            }, 1000);
        }


        $(".date-btn").on("click", function() {
            $(".date-btn").removeClass("active");
            $(this).addClass("active");
            var start_date = $(this).data('start_date');
            var end_date = $(this).data('end_date');
            $.get('dashboard-filter/' + start_date + '/' + end_date, function(data) {
                dashboardFilter(data);
            });
        });

        function dashboardFilter(data) {
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

@endsection