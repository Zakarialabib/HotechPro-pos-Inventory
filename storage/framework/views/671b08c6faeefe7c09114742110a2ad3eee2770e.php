<?php $__env->startSection('content'); ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
      <div class="row">
        <div class="container-fluid">
          <div class="col-md-12">
            <div class="brand-text float-left mt-4">
                <h3><?php echo e(trans('file.welcome')); ?> <span><?php echo e(Auth::user()->name); ?></span> </h3>
            </div>
            <div class="filter-toggle">
              <button class="btn date-btn btn-outline-primary" data-start_date="<?php echo e(date('Y-m-d')); ?>" data-end_date="<?php echo e(date('Y-m-d')); ?>"><?php echo e(trans('file.Today')); ?></button>
              <button class="btn date-btn btn-outline-primary" data-start_date="<?php echo e(date('Y-m-d', strtotime(' -7 day'))); ?>" data-end_date="<?php echo e(date('Y-m-d')); ?>"><?php echo e(trans('file.Last 7 Days')); ?></button>
              <button class="btn date-btn btn-outline-primary active" data-start_date="<?php echo e(date('Y').'-'.date('m').'-'.'01'); ?>" data-end_date="<?php echo e(date('Y-m-d')); ?>"><?php echo e(trans('file.This Month')); ?></button>
              <button class="btn date-btn btn-outline-primary" data-start_date="<?php echo e(date('Y').'-01'.'-01'); ?>" data-end_date="<?php echo e(date('Y').'-12'.'-31'); ?>"><?php echo e(trans('file.This Year')); ?></button>
            </div>
          </div>
        </div>
      </div>
      <!-- Counts Section -->
      <section class="dashboard-counts">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 form-group">
              <div class="row">
                <!-- Count item widget-->
                <div class="col-sm-6">
                  <div class="wrapper count-title bg-gradient-success text-center">
                    <div class="icon"><i class="dripicons-graph-bar"></i></div>
                    <div class="name"><strong><?php echo e(trans('file.revenue')); ?></strong></div>
                    <div class="count-number revenue-data"><?php echo e(number_format((float)$revenue, 2, '.', '')); ?></div>
                  </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-6">
                  <div class="wrapper count-title bg-gradient-success text-center">
                    <div class="icon"><i class="dripicons-trophy"></i></div>
                    <div class="name"><strong><?php echo e(trans('file.profit')); ?></strong></div>
                    <div class="count-number profit-data"><?php echo e(number_format((float)$profit, 2, '.', '')); ?></div>
                  </div>
                </div>
              </div>
                <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                  <div class="card gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="avatar bg-rgba-success  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-user text-success icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700"><?php echo e($count_customers); ?></h2>
                              <p class="mb-0 line-ellipsis"><?php echo e(__('Customers')); ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                  <div class="card gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="avatar bg-rgba-danger  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-money text-danger icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700"><?php echo e($count_sales); ?></h2>
                              <p class="mb-0 line-ellipsis"><?php echo e(__('Sales')); ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                  <div class="card gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="avatar bg-rgba-info  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-eye text-info icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700"><?php echo e($count_purchases); ?></h2>
                              <p class="mb-0 line-ellipsis"><?php echo e(__('Purchases')); ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                  <div class="card gradient-light-primary text-center">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="avatar bg-rgba-warning  m-0 mb-1">
                                  <div class="avatar-content">
                                      <i class="fa fa-truck text-warning icon-home"></i>
                                  </div>
                              </div>
                              <h2 class="text-bold-700"><?php echo e($count_products); ?></h2>
                              <p class="mb-0 line-ellipsis"><?php echo e(__('Products')); ?></p>
                          </div>
                      </div>
                   </div>
               </div>
            </div>
            <div class="row">
                   <!-- Count item widget-->
                 <div class="col-sm-2">
                  <div class="wrapper gradient-light-danger text-center">
                  <a class="dashboard-full" href="<?php echo e(route('sales.create')); ?>">
                    <div class="name"><strong><?php echo e(trans('file.Add Sale')); ?></strong></div>
                    <div class="count-number"><i class="dripicons-shopping-bag"></i></div>
                  </a>
                  </div>
                </div>

                <!-- Count item widget-->
                <div class="col-sm-2">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" href="<?php echo e(route('products.create')); ?>">
                    <div class="name"><strong><?php echo e(__('file.add_product')); ?></strong></div>
                    <div class="count-number"><i class="dripicons-box"></i></div> </a>
                  </div>
                </div>
               <!-- Count item widget-->
                <div class="col-sm-2">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" href="<?php echo e(route('quotations.create')); ?>">
                    <div class="name"><strong><?php echo e(trans('file.Add Quotation')); ?></strong></div>
                    <div class="count-number"><i class="dripicons-question"></i></div></a>
                  </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-2">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" href="<?php echo e(route('customer.create')); ?>">
                    <div class="name"><strong><?php echo e(trans('file.Add Customer')); ?></strong></div>
                    <div class="count-number"><i class="dripicons-user"></i></div></a>
                  </div>
                </div>
                <?php if(in_array("expenses-add", $all_permission)): ?>
                <div class="col-sm-2">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" data-toggle="modal" data-target="#expense-modal">
                    <div class="name"><strong><?php echo e(trans('file.Add Expense')); ?></strong></div>
                    <div class="count-number"><i class="dripicons-plus"></i> </i></div></a>
                  </div>
                </div>
                <?php endif; ?>
                <div class="col-sm-2">
                  <div class="wrapper gradient-light-danger text-center">
                    <a class="dashboard-full" data-toggle="modal" data-target="#activity-modal">
                    <div class="name"><strong><?php echo e(trans('file.Add Activity')); ?></strong></div>
                    <div class="count-number"><i class="dripicons-plus"></i> </i></div></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7 mt-4">
              <div class="card line-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4><?php echo e(trans('file.Cash Flow')); ?></h4>
                </div>
                <div class="card-body">
                  <?php
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
                  ?>
                  <canvas id="cashFlow" data-color = "<?php echo e($color); ?>" data-color_rgba = "<?php echo e($color_rgba); ?>" data-recieved = "<?php echo e(json_encode($payment_recieved)); ?>" data-sent = "<?php echo e(json_encode($payment_sent)); ?>" data-month = "<?php echo e(json_encode($month)); ?>" data-label1="<?php echo e(trans('file.Payment Recieved')); ?>" data-label2="<?php echo e(trans('file.Payment Sent')); ?>"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 mt-4">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4><?php echo e(date('F')); ?> <?php echo e(date('Y')); ?></h4>
                </div>
                <div class="pie-chart mb-2">
                    <canvas id="transactionChart" data-color = "<?php echo e($color); ?>" data-color_rgba = "<?php echo e($color_rgba); ?>" data-revenue=<?php echo e($revenue); ?> data-purchase=<?php echo e($purchase); ?> data-label1="<?php echo e(trans('file.Purchase')); ?>" data-label2="<?php echo e(trans('file.revenue')); ?>" width="100" height="95"> </canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4><?php echo e(trans('file.yearly report')); ?></h4>
                </div>
                <div class="card-body">
                  <canvas id="saleChart" data-sale_chart_value = "<?php echo e(json_encode($yearly_sale_amount)); ?>" data-purchase_chart_value = "<?php echo e(json_encode($yearly_purchase_amount)); ?>" data-label1="<?php echo e(trans('file.Purchased Amount')); ?>" data-label2="<?php echo e(trans('file.Sold Amount')); ?>"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
              <div class="response"></div>
              <div id='calendar'></div>  
              </div>
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" style="color:white;background-color:#300ED7;">
                  <h4><?php echo e(trans('file.Recent Transaction')); ?></h4>
                  <div class="right-column">
                    <div class="badge badge-primary"><?php echo e(trans('file.latest')); ?> 5</div>
                  </div>
                </div>
                <ul class="nav nav-tabs nav-fill" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab"><?php echo e(trans('file.Sale')); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#purchase-latest" role="tab" data-toggle="tab"><?php echo e(trans('file.Purchase')); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#quotation-latest" role="tab" data-toggle="tab"><?php echo e(trans('file.Quotation')); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#payment-latest" role="tab" data-toggle="tab"><?php echo e(trans('file.Payment')); ?></a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade show active" id="sale-latest">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th><?php echo e(trans('file.date')); ?></th>
                              <th><?php echo e(trans('file.reference')); ?></th>
                              <th><?php echo e(trans('file.customer')); ?></th>
                              <th><?php echo e(trans('file.status')); ?></th>
                              <th><?php echo e(trans('file.grand total')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $recent_sale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $customer = DB::table('customers')->find($sale->customer_id); ?>
                            <tr>
                              <td><?php echo e(date($general_setting->date_format, strtotime($sale->created_at->toDateString()))); ?></td>
                              <td><?php echo e($sale->reference_no); ?></td>
                              <td><?php echo e($customer->name); ?></td>
                              <?php if($sale->sale_status == 1): ?>
                              <td><div class="badge badge-success"><?php echo e(trans('file.Completed')); ?></div></td>
                              <?php elseif($sale->sale_status == 2): ?>
                              <td><div class="badge badge-danger"><?php echo e(trans('file.Pending')); ?></div></td>
                              <?php else: ?>
                              <td><div class="badge badge-warning"><?php echo e(trans('file.Draft')); ?></div></td>
                              <?php endif; ?>
                              <td><?php echo e($sale->grand_total); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="purchase-latest">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th><?php echo e(trans('file.date')); ?></th>
                              <th><?php echo e(trans('file.reference')); ?></th>
                              <th><?php echo e(trans('file.Supplier')); ?></th>
                              <th><?php echo e(trans('file.status')); ?></th>
                              <th><?php echo e(trans('file.grand total')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $recent_purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $supplier = DB::table('suppliers')->find($purchase->supplier_id); ?>
                            <tr>
                              <td><?php echo e(date($general_setting->date_format, strtotime($purchase->created_at->toDateString()))); ?></td>
                              <td><?php echo e($purchase->reference_no); ?></td>
                              <?php if($supplier): ?>
                                <td><?php echo e($supplier->name); ?></td>
                              <?php else: ?>
                                <td>N/A</td>
                              <?php endif; ?>
                              <?php if($purchase->status == 1): ?>
                              <td><div class="badge badge-success">Recieved</div></td>
                              <?php elseif($purchase->status == 2): ?>
                              <td><div class="badge badge-success">Partial</div></td>
                              <?php elseif($purchase->status == 3): ?>
                              <td><div class="badge badge-danger">Pending</div></td>
                              <?php else: ?>
                              <td><div class="badge badge-danger">Ordered</div></td>
                              <?php endif; ?>
                              <td><?php echo e($purchase->grand_total); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="quotation-latest">
                      <div class="table-responsive">
                      <table class="table table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th><?php echo e(trans('file.date')); ?></th>
                              <th><?php echo e(trans('file.reference')); ?></th>
                              <th><?php echo e(trans('file.customer')); ?></th>
                              <th><?php echo e(trans('file.status')); ?></th>
                              <th><?php echo e(trans('file.grand total')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $recent_quotation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $customer = DB::table('customers')->find($quotation->customer_id); ?>
                            <tr>
                              <td><?php echo e(date($general_setting->date_format, strtotime($quotation->created_at->toDateString()))); ?></td>
                              <td><?php echo e($quotation->reference_no); ?></td>
                              <td><?php echo e($customer->name); ?></td>
                              <?php if($quotation->quotation_status == 1): ?>
                              <td><div class="badge badge-danger">Pending</div></td>
                              <?php else: ?>
                              <td><div class="badge badge-success">Sent</div></td>
                              <?php endif; ?>
                              <td><?php echo e($quotation->grand_total); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="payment-latest">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead class="thead-light">
                            <tr>
                              <th><?php echo e(trans('file.date')); ?></th>
                              <th><?php echo e(trans('file.reference')); ?></th>
                              <th><?php echo e(trans('file.Amount')); ?></th>
                              <th><?php echo e(trans('file.Paid By')); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $recent_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e(date($general_setting->date_format, strtotime($payment->created_at->toDateString()))); ?></td>
                              <td><?php echo e($payment->payment_reference); ?></td>
                              <td><?php echo e($payment->amount); ?></td>
                              <td><?php echo e($payment->paying_method); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" style="color:white;background-color:#300ED7;">
                  <h4><?php echo e(trans('file.Best Seller').' '.date('F')); ?></h4>
                  <div class="right-column">
                    <div class="badge badge-primary"><?php echo e(trans('file.top')); ?> 5</div>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>TOP 5</th>
                          <th><?php echo e(trans('file.Product Details')); ?></th>
                          <th><?php echo e(trans('file.qty')); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $best_selling_qty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                        <tr>
                          <td><?php echo e($key + 1); ?></td>
                          <td><?php echo e($product->name); ?> - [<?php echo e($product->code); ?>]</td>
                          <td><?php echo e($sale->sold_qty); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" style="color:white;background-color:#300ED7;">
                  <h4><?php echo e(trans('file.Best Seller').' '.date('Y'). ' ('.trans('file.qty').')'); ?></h4>
                  <div class="right-column">
                    <div class="badge badge-primary"><?php echo e(trans('file.top')); ?> 5</div>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>TOP 5</th>
                          <th><?php echo e(trans('file.Product Details')); ?></th>
                          <th><?php echo e(trans('file.qty')); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $yearly_best_selling_qty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                        <tr>
                          <td><?php echo e($key + 1); ?></td>
                          <td><?php echo e($product->name); ?> - [<?php echo e($product->code); ?>]</td>
                          <td><?php echo e($sale->sold_qty); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" style="color:white;background-color:#300ED7;">
                  <h4><?php echo e(trans('file.Best Seller').' '.date('Y') . ' ('.trans('file.price').')'); ?></h4>
                  <div class="right-column">
                    <div class="badge badge-primary"><?php echo e(trans('file.top')); ?> 5</div>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>TOP 5</th>
                          <th><?php echo e(trans('file.Product Details')); ?></th>
                          <th><?php echo e(trans('file.grand total')); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $yearly_best_selling_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $product = DB::table('products')->find($sale->product_id); ?>
                        <tr>
                          <td><?php echo e($key + 1); ?></td>
                          <td><?php echo e($product->name); ?> - [<?php echo e($product->code); ?>]</td>
                          <td><?php echo e(number_format((float)$sale->total_price, 2, '.', '')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    var SITEURL = "<?php echo e(url('/')); ?>";
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/hotech/resources/views/index.blade.php ENDPATH**/ ?>