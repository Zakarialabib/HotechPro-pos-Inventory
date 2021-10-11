<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ url('public/logo', $general_setting->site_logo) }}" />
    <title>{{ $general_setting->site_title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.styles')
    
    @include('partials.scripts')

</head>

<body class="hold-transition layout-fixed layout-navbar-fixed">
    <!-- Side Navbar -->
    <aside class="main-sidebar elevation-4 sidebar-dark-primary">
      <a class="brand-link" href="{{ url('/') }}"> <span class="brand-text font-weight-light"> {{ $general_setting->site_title }} </span></a>
        <section class="sidebar pt-0 mt-0">
            <nav class="mt-6">
              <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">                  
                    <li class="nav-item menu-open"><a class="nav-link active" href="{{ url('/') }}"><i class="nav-icon dripicons-meter"></i>
                            <span>{{ __('Dashboard') }}</span></a></li>
                    <?php
                    $role = DB::table('roles')->find(Auth::user()->role_id);
                    $category_permission_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'category'], ['role_id', $role->id]])
                        ->first();
                    $index_permission = DB::table('permissions')
                        ->where('name', 'products-index')
                        ->first();
                    $index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $brand_permission = DB::table('permissions')
                        ->where('name', 'brand')
                        ->first();
                    $brand_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $brand_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $stock_count = DB::table('permissions')
                        ->where('name', 'stock_count')
                        ->first();
                    $stock_count_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $stock_count->id], ['role_id', $role->id]])
                        ->first();
                    
                    $adjustment = DB::table('permissions')
                        ->where('name', 'adjustment')
                        ->first();
                    $adjustment_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $adjustment->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    @if ($category_permission_active || $index_permission_active || $print_barcode_active || $stock_count_active || $adjustment_active)
                        <li class="nav-item">
                            <a href="#product" class="nav-link"><i class="nav-icon dripicons-list"></i> <span>{{ __('file.product') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="product">

                                @if ($brand_permission_active)
                                    <li class="nav-item" id="brand-menu"><a class="nav-link"
                                            href="{{ route('brand.index') }}">{{ trans('file.Brand List') }}</a>
                                    </li>
                                @endif

                                @if ($category_permission_active)
                                    <li class="nav-item" id="category-menu"><a class="nav-link"
                                            href="{{ route('category.index') }}">{{ __('file.Category List') }}</a>
                                    </li>
                                @endif

                                @if ($index_permission_active)
                                    <li class="nav-item" id="product-list-menu"><a class="nav-link"
                                            href="{{ route('products.index') }}">{{ __('file.Product List') }}</a>
                                    </li>
                                @endif

                                @if ($adjustment_active)
                                    <li class="nav-item" id="adjustment-list-menu"><a class="nav-link"
                                            href="{{ route('qty_adjustment.index') }}">{{ trans('file.Adjustment List') }}</a>
                                    </li>
                                    <li class="nav-item" id="adjustment-create-menu"><a class="nav-link"
                                            href="{{ route('qty_adjustment.create') }}">{{ trans('file.Add Adjustment') }}</a>
                                    </li>
                                @endif

                                @if ($stock_count_active)
                                    <li class="nav-item" id="stock-count-menu"><a class="nav-link"
                                            href="{{ route('stock-count.index') }}">{{ trans('file.Stock Count') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <?php
                    $index_permission = DB::table('permissions')
                        ->where('name', 'purchases-index')
                        ->first();
                    $index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_permission->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    @if ($index_permission_active)
                        <li class="nav-item">
                            <a href="#purchase" class="nav-link"><i class="nav-icon dripicons-card"></i> <span>{{ __('file.Purchase') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="purchase">
                                <li class="nav-item" id="purchase-list-menu"><a class="nav-link"
                                        href="{{ route('purchases.index') }}">{{ trans('file.Purchase List') }}</a>
                                </li>
                                <?php
                                $add_permission = DB::table('permissions')
                                    ->where('name', 'purchases-add')
                                    ->first();
                                $add_permission_active = DB::table('role_has_permissions')
                                    ->where([['permission_id', $add_permission->id], ['role_id', $role->id]])
                                    ->first();
                                ?>
                                @if ($add_permission_active)
                                    <li class="nav-item" id="purchase-import-menu"><a class="nav-link"
                                            href="{{ url('purchases/purchase_by_csv') }}">{{ trans('file.Import Purchase By CSV') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    <?php
                    $index_permission = DB::table('permissions')
                        ->where('name', 'quotes-index')
                        ->first();
                    $index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_permission->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    @if ($index_permission_active)
                        <li class="nav-item">
                            <a href="#quotation" class="nav-link"><i class="nav-icon dripicons-card"></i>
                                <span>{{ __('file.Quotation') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="quotation">

                                <li class="nav-item" id="quotation-list-menu">
                                    <a class="nav-link"
                                        href="{{ route('quotations.index') }}">{{ trans('file.Quotation List') }}</a>
                                </li>
                                <?php
                                $add_permission = DB::table('permissions')
                                    ->where('name', 'quotes-add')
                                    ->first();
                                $add_permission_active = DB::table('role_has_permissions')
                                    ->where([['permission_id', $add_permission->id], ['role_id', $role->id]])
                                    ->first();
                                ?>
                                @if ($add_permission_active)
                                    <li class="nav-item" id="quotation-create-menu"><a class="nav-link"
                                            href="{{ route('quotations.create') }}">{{ trans('file.Add Quotation') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    <?php
                    $sale_index_permission = DB::table('permissions')
                        ->where('name', 'sales-index')
                        ->first();
                    $sale_index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $sale_index_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $delivery_permission_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'delivery'], ['role_id', $role->id]])
                        ->first();
                    
                    $message_permission_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'message'], ['role_id', $role->id]])
                        ->first();
                    
                    $sale_add_permission = DB::table('permissions')
                        ->where('name', 'sales-add')
                        ->first();
                    $sale_add_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $sale_add_permission->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    @if ($sale_index_permission_active || $delivery_permission_active || $message_permission_active)
                        <li class="nav-item">
                            <a href="#sale" class="nav-link"><i class="nav-icon dripicons-cart"></i> <span>{{ __('file.Sale') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="sale">

                                @if ($sale_index_permission_active)
                                    <li class="nav-item" id="sale-list-menu"><a class="nav-link"
                                            href="{{ route('sales.index') }}">{{ trans('file.Sale List') }}</a>
                                    </li>
                                    @if ($sale_add_permission_active)
                                        <li class="nav-item" id="sale-import-menu"><a class="nav-link"
                                                href="{{ url('sales/sale_by_csv') }}">{{ trans('file.Import Sale By CSV') }}</a>
                                        </li>
                                    @endif
                                @endif

                                @if ($delivery_permission_active)
                                    <li class="nav-item" id="delivery-menu"><a class="nav-link"
                                            href="{{ route('delivery.index') }}">{{ trans('file.Delivery List') }}</a>
                                    </li>
                                @endif

                                {{-- @if ($message_permission_active)
                                    <li class="nav-item" id="message-menu"><a class="nav-link"
                                            href="{{ route('message.index') }}">{{ trans('file.Message List') }}</a></li>
                                @endif --}}
                            </ul>
                        </li>
                    @endif

                    <?php
                    $index_permission = DB::table('permissions')
                        ->where('name', 'expenses-index')
                        ->first();
                    $index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_permission->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    @if ($index_permission_active)
                        <li class="nav-item">
                            <a href="#expense" class="nav-link"><i class="nav-icon dripicons-wallet"></i> <span>{{ __('file.Expense') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="expense">

                                <li class="nav-item" id="exp-cat-menu"><a class="nav-link"
                                        href="{{ route('expense_categories.index') }}">{{ trans('file.Expense Category') }}</a>
                                </li>
                                <li class="nav-item" id="exp-list-menu"><a class="nav-link"
                                        href="{{ route('expenses.index') }}">{{ trans('file.Expense List') }}</a>
                                </li>
                                <?php
                                $add_permission = DB::table('permissions')
                                    ->where('name', 'expenses-add')
                                    ->first();
                                $add_permission_active = DB::table('role_has_permissions')
                                    ->where([['permission_id', $add_permission->id], ['role_id', $role->id]])
                                    ->first();
                                ?>
                                @if ($add_permission_active)
                                    <li><a id="add-expense" href=" " class="nav-link"> {{ trans('file.Add Expense') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif


                    <?php
                    $index_permission = DB::table('permissions')
                        ->where('name', 'account-index')
                        ->first();
                    $index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $money_transfer_permission = DB::table('permissions')
                        ->where('name', 'money-transfer')
                        ->first();
                    $money_transfer_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $money_transfer_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $balance_sheet_permission = DB::table('permissions')
                        ->where('name', 'balance-sheet')
                        ->first();
                    $balance_sheet_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $balance_sheet_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $account_statement_permission = DB::table('permissions')
                        ->where('name', 'account-statement')
                        ->first();
                    $account_statement_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $account_statement_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    ?>
                    @if ($index_permission_active || $balance_sheet_permission_active || $account_statement_permission_active)
                        <li class="nav-item">
                            <a href="#account" class="nav-link"><i class="nav-icon dripicons-briefcase"></i>
                                <span>{{ __('file.Accounting') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="account">
                                @if ($index_permission_active)
                                    <li class="nav-item" id="account-list-menu"><a class="nav-link"
                                            href="{{ route('accounts.index') }}">{{ trans('file.Account List') }}</a>
                                    </li>
                                @endif
                                @if ($money_transfer_permission_active)
                                    <li class="nav-item" id="money-transfer-menu"><a class="nav-link"
                                            href="{{ route('money-transfers.index') }}">{{ trans('file.Money Transfer') }}</a>
                                    </li>
                                @endif
                                @if ($balance_sheet_permission_active)
                                    <li class="nav-item" id="balance-sheet-menu"><a class="nav-link"
                                            href="{{ route('accounts.balancesheet') }}">{{ trans('file.Balance Sheet') }}</a>
                                    </li>
                                @endif
                                @if ($account_statement_permission_active)
                                    <li class="nav-item" id="account-statement-menu"><a class="nav-link"
                                      id="account-statement" href="">{{ trans('file.Account Statement') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    <?php
                    $department = DB::table('permissions')
                        ->where('name', 'department')
                        ->first();
                    $department_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $department->id], ['role_id', $role->id]])
                        ->first();
                    $index_employee = DB::table('permissions')
                        ->where('name', 'employees-index')
                        ->first();
                    $index_employee_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $index_employee->id], ['role_id', $role->id]])
                        ->first();
                    $attendance = DB::table('permissions')
                        ->where('name', 'attendance')
                        ->first();
                    $attendance_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $attendance->id], ['role_id', $role->id]])
                        ->first();
                    $activity = DB::table('permissions')
                        ->where('name', 'activity')
                        ->first();
                    $activity_active = DB::table('role_has_permissions')
                        ->where([
                            //['permission_id', $activity->id],['role_id', $role->id],
                        ])
                        ->first();
                    $resume = DB::table('permissions')
                        ->where('name', 'resume')
                        ->first();
                    $resume_active = DB::table('role_has_permissions')
                        ->where([
                            //           ['permission_id', $resume->id],
                            ['role_id', $role->id],
                        ])
                        ->first();
                    $payroll = DB::table('permissions')
                        ->where('name', 'payroll')
                        ->first();
                    $payroll_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $payroll->id], ['role_id', $role->id]])
                        ->first();
                    ?>

                    @if (Auth::user()->role_id != 5)
                        <li class="nav-item">
                            <a href="#hrm" class="nav-link"><i class="nav-icon dripicons-user-group"></i> <span>{{ __('file.HRM') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="hrm">
                                @if ($department_active)
                                    <li class="nav-item" id="dept-menu"><a class="nav-link"
                                            href="{{ route('departments.index') }}">{{ trans('file.Department') }}</a>
                                    </li>
                                @endif
                                @if ($index_employee_active)
                                    <li class="nav-item" id="employee-menu"><a class="nav-link"
                                            href="{{ route('employees.index') }}">{{ trans('file.Employee') }}</a>
                                    </li>
                                @endif

                                @if ($attendance_active)
                                    <li class="nav-item" id="attendance-menu"><a class="nav-link"
                                            href="{{ route('attendance.index') }}">{{ trans('file.Attendance') }}</a>
                                    </li>
                                @endif
                                
                                @if ($payroll_active)
                                    <li class="nav-item" id="payroll-menu"><a class="nav-link"
                                            href="{{ route('payroll.index') }}">{{ trans('file.Payroll') }}</a>
                                    </li>
                                @endif

                                <li class="nav-item" id="holiday-menu"><a class="nav-link"
                                        href="{{ route('holidays.index') }}">{{ trans('file.Holiday') }}</a></li>

                                @if ($activity_active)
                                    <li class="nav-item" id="activity-menu"><a class="nav-link"
                                            href="{{ route('activity.index') }}">{{ trans('file.Activity') }}</a>
                                    </li>
                                @endif

                                @if ($resume_active)
                                    <li class="nav-item" id="resume-menu"><a class="nav-link"
                                            href="{{ route('resume.index') }}">{{ trans('file.Resume') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <?php
                    $user_index_permission_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'users-index'], ['role_id', $role->id]])
                        ->first();
                    
                    $customer_index_permission = DB::table('permissions')
                        ->where('name', 'customers-index')
                        ->first();
                    
                    $customer_index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $customer_index_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $customer_group_permission = DB::table('permissions')
                        ->where('name', 'customer_group')
                        ->first();
                    $customer_group_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $customer_group_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $biller_index_permission = DB::table('permissions')
                        ->where('name', 'billers-index')
                        ->first();
                    
                    $biller_index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $biller_index_permission->id], ['role_id', $role->id]])
                        ->first();
                    
                    $supplier_index_permission = DB::table('permissions')
                        ->where('name', 'suppliers-index')
                        ->first();
                    
                    $supplier_index_permission_active = DB::table('role_has_permissions')
                        ->where([['permission_id', $supplier_index_permission->id], ['role_id', $role->id]])
                        ->first();
                    ?>
                    @if ($user_index_permission_active || $customer_index_permission_active || $biller_index_permission_active || $supplier_index_permission_active)
                        <li class="nav-item">
                            <a href="#people" class="nav-link"><i class="nav-icon dripicons-user-group"></i>
                                <span>{{ __('file.People') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="people">
                                @if ($user_index_permission_active)
                                    <li class="nav-item" id="user-list-menu"><a class="nav-link"
                                            href="{{ route('user.index') }}">{{ trans('file.User List') }}</a>
                                    </li>
                                @endif

                                @if ($customer_index_permission_active)
                                    <li class="nav-item" id="customer-list-menu"><a class="nav-link"
                                            href="{{ route('customer.index') }}">{{ trans('file.Customer List') }}</a>
                                    </li>
                                @endif

                                @if ($customer_group_permission_active)
                                    <li class="nav-item" id="customer-group-menu"><a class="nav-link"
                                            href="{{ route('customer_group.index') }}">{{ trans('file.Customer Group') }}</a>
                                    </li>
                                @endif

                                @if ($biller_index_permission_active)
                                    <li class="nav-item" id="biller-list-menu"><a class="nav-link"
                                            href="{{ route('biller.index') }}">{{ trans('file.Biller List') }}</a>
                                    </li>
                                @endif

                                @if ($supplier_index_permission_active)
                                    <li class="nav-item" id="supplier-list-menu"><a class="nav-link"
                                            href="{{ route('supplier.index') }}">{{ trans('file.Supplier List') }}</a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                    @endif

                    <?php
                    $profit_loss_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'profit-loss'], ['role_id', $role->id]])
                        ->first();
                    $best_seller_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'best-seller'], ['role_id', $role->id]])
                        ->first();
                    $warehouse_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'warehouse-report'], ['role_id', $role->id]])
                        ->first();
                    $warehouse_stock_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'warehouse-stock-report'], ['role_id', $role->id]])
                        ->first();
                    $product_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'product-report'], ['role_id', $role->id]])
                        ->first();
                    $daily_sale_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'daily-sale'], ['role_id', $role->id]])
                        ->first();
                    $monthly_sale_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'monthly-sale'], ['role_id', $role->id]])
                        ->first();
                    $daily_purchase_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'daily-purchase'], ['role_id', $role->id]])
                        ->first();
                    $monthly_purchase_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'monthly-purchase'], ['role_id', $role->id]])
                        ->first();
                    $purchase_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'purchase-report'], ['role_id', $role->id]])
                        ->first();
                    $sale_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'sale-report'], ['role_id', $role->id]])
                        ->first();
                    $payment_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'payment-report'], ['role_id', $role->id]])
                        ->first();
                    $product_qty_alert_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'product-qty-alert'], ['role_id', $role->id]])
                        ->first();
                    $user_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'user-report'], ['role_id', $role->id]])
                        ->first();
                    
                    $customer_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'customer-report'], ['role_id', $role->id]])
                        ->first();
                    $supplier_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'supplier-report'], ['role_id', $role->id]])
                        ->first();
                    $due_report_active = DB::table('permissions')
                        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                        ->where([['permissions.name', 'due-report'], ['role_id', $role->id]])
                        ->first();
                    ?>
                    @if ($profit_loss_active || $best_seller_active || $warehouse_report_active || $warehouse_stock_report_active || $product_report_active || $daily_sale_active || $monthly_sale_active || $daily_purchase_active || $monthly_purchase_active || $purchase_report_active || $sale_report_active || $payment_report_active || $product_qty_alert_active || $user_report_active || $customer_report_active || $supplier_report_active || $due_report_active)
                        <li class="nav-item">
                            <a href="#report" class="nav-link"><i class="nav-icon dripicons-document-remove"></i>
                                <span>{{ __('file.Reports') }}</span>
                                <span class="pull-right-container">
                                    <i class="nav-icon fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview" id="report">
                                @if ($profit_loss_active)
                                    <li class="nav-item" id="profit-loss-report-menu">
                                        {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}
                                        <input type="hidden" name="start_date"
                                            value="{{ date('Y-m') . '-' . '01' }}" />
                                        <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />
                                        <a id="profitLoss-link" href="" class="nav-link">{{ trans('file.Summary Report') }}</a>
                                        {!! Form::close() !!}
                                    </li>
                                @endif
                                @if ($best_seller_active)
                                    <li class="nav-item" id="best-seller-report-menu">
                                        <a class="nav-link"
                                            href="{{ url('report/best_seller') }}">{{ trans('file.Best Seller') }}</a>
                                    </li>
                                @endif
                                @if ($product_report_active)
                                    <li class="nav-item" id="product-report-menu">
                                        {!! Form::open(['route' => 'report.product', 'method' => 'post', 'id' => 'product-report-form']) !!}
                                        <input type="hidden" name="start_date" value="2021-01-01" />
                                        <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />
                                        <input type="hidden" name="warehouse_id" value="0" />
                                        <a id="report-link" href="" class="nav-link">{{ trans('file.Product Report') }}</a>
                                        {!! Form::close() !!}
                                    </li>
                                @endif
                                @if ($daily_sale_active)
                                    <li class="nav-item" id="daily-sale-report-menu">
                                        <a class="nav-link"
                                            href="{{ url('report/daily_sale/' . date('Y') . '/' . date('m')) }}">{{ trans('file.Daily Sale') }}</a>
                                    </li>
                                @endif
                                @if ($monthly_sale_active)
                                    <li class="nav-item" id="monthly-sale-report-menu">
                                        <a class="nav-link"
                                            href="{{ url('report/monthly_sale/' . date('Y')) }}">{{ trans('file.Monthly Sale') }}</a>
                                    </li>
                                @endif
                                @if ($daily_purchase_active)
                                    <li class="nav-item" id="daily-purchase-report-menu">
                                        <a class="nav-link"
                                            href="{{ url('report/daily_purchase/' . date('Y') . '/' . date('m')) }}">{{ trans('file.Daily Purchase') }}</a>
                                    </li>
                                @endif
                                @if ($monthly_purchase_active)
                                    <li class="nav-item" id="monthly-purchase-report-menu">
                                        <a class="nav-link"
                                            href="{{ url('report/monthly_purchase/' . date('Y')) }}">{{ trans('file.Monthly Purchase') }}</a>
                                    </li>
                                @endif
                                @if ($sale_report_active)
                                    <li class="nav-item" id="sale-report-menu">
                                        {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}
                                        <input type="hidden" name="start_date" value="2021-01-01" />
                                        <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />
                                        <input type="hidden" name="warehouse_id" value="0" />
                                        <a id="sale-report-link" href="" class="nav-link">{{ trans('file.Sale Report') }}</a>
                                        {!! Form::close() !!}
                                    </li>
                                @endif
                                @if ($payment_report_active)
                                    <li class="nav-item" id="payment-report-menu">
                                        {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}
                                        <input type="hidden" name="start_date" value="2021-01-01" />
                                        <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />
                                        <a id="payment-report-link" href="" class="nav-link">{{ trans('file.Payment Report') }}</a>
                                        {!! Form::close() !!}
                                    </li>
                                @endif
                                @if ($purchase_report_active)
                                    <li class="nav-item" id="purchase-report-menu">
                                        {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}
                                        <input type="hidden" name="start_date" value="2021-01-01" />
                                        <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />
                                        <input type="hidden" name="warehouse_id" value="0" />
                                        <a id="purchase-report-link" href="" class="nav-link">{{ trans('file.Purchase Report') }}</a>
                                        {!! Form::close() !!}
                                    </li>
                                @endif
                                @if ($warehouse_report_active)
                                    <li class="nav-item" id="warehouse-report-menu">
                                        <a id="warehouse-report-link" class="nav-link"
                                            href="">{{ trans('file.Warehouse Report') }}</a>
                                    </li>
                                @endif
                                @if ($warehouse_stock_report_active)
                                    <li class="nav-item" id="warehouse-stock-report-menu">
                                        <a class="nav-link"
                                            href="{{ route('report.warehouseStock') }}">{{ trans('file.Warehouse Stock Chart') }}</a>
                                    </li>
                                @endif
                                @if ($product_qty_alert_active)
                                    <li class="nav-item" id="qtyAlert-report-menu">
                                        <a class="nav-link"
                                            href="{{ route('report.qtyAlert') }}">{{ trans('file.Product Quantity Alert') }}</a>
                                    </li>
                                @endif
                                @if ($user_report_active)
                                    <li class="nav-item" id="user-report-menu">
                                        <a id="user-report-link" href="" class="nav-link">{{ trans('file.User Report') }}</a>
                                    </li>
                                @endif
                                @if ($customer_report_active)
                                    <li class="nav-item" id="customer-report-menu">
                                        <a id="customer-report-link" href="" class="nav-link">{{ trans('file.Customer Report') }}</a>
                                    </li>
                                @endif
                                @if ($supplier_report_active)
                                    <li class="nav-item" id="supplier-report-menu">
                                        <a id="supplier-report-link" href="" class="nav-link">{{ trans('file.Supplier Report') }}</a>
                                    </li>
                                @endif
                                @if ($due_report_active)
                                    <li class="nav-item" id="due-report-menu">
                                        {!! Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']) !!}
                                        <input type="hidden" name="start_date" value="2021-01-01" />
                                        <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />
                                        <a id="due-report-link" href="" class="nav-link">{{ trans('file.Due Report') }}</a>
                                        {!! Form::close() !!}
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="#setting" class="nav-link"><i class="nav-icon dripicons-gear"></i> <span>{{ __('file.settings') }}</span>
                            <span class="pull-right-container">
                                <i class="nav-icon fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="nav nav-treeview" id="setting">

                            <?php
                            $send_notification_permission = DB::table('permissions')
                                ->where('name', 'send_notification')
                                ->first();
                            $send_notification_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $send_notification_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $warehouse_permission = DB::table('permissions')
                                ->where('name', 'warehouse')
                                ->first();
                            $warehouse_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $warehouse_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $unit_permission = DB::table('permissions')
                                ->where('name', 'unit')
                                ->first();
                            $unit_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $unit_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $currency_permission = DB::table('permissions')
                                ->where('name', 'currency')
                                ->first();
                            $currency_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $currency_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $tax_permission = DB::table('permissions')
                                ->where('name', 'tax')
                                ->first();
                            $tax_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $tax_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $general_setting_permission = DB::table('permissions')
                                ->where('name', 'general_setting')
                                ->first();
                            $general_setting_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $general_setting_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $backup_database_permission = DB::table('permissions')
                                ->where('name', 'backup_database')
                                ->first();
                            $backup_database_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $backup_database_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $mail_setting_permission = DB::table('permissions')
                                ->where('name', 'mail_setting')
                                ->first();
                            $mail_setting_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $mail_setting_permission->id], ['role_id', $role->id]])
                                ->first();
                            
                            $hrm_setting_permission = DB::table('permissions')
                                ->where('name', 'hrm_setting')
                                ->first();
                            $hrm_setting_permission_active = DB::table('role_has_permissions')
                                ->where([['permission_id', $hrm_setting_permission->id], ['role_id', $role->id]])
                                ->first();
                            ?>
                            @if ($general_setting_permission_active)
                                <li class="nav-item" id="general-setting-menu"><a class="nav-link"
                                        href="{{ route('setting.general') }}">{{ trans('file.General Setting') }}</a>
                                </li>
                            @endif
                            @if ($mail_setting_permission_active)
                                <li class="nav-item" id="mail-setting-menu"><a class="nav-link"
                                        href="{{ route('setting.mail') }}">{{ trans('file.Mail Setting') }}</a>
                                </li>
                            @endif
                            @if ($hrm_setting_permission_active)
                                <li class="nav-item" id="hrm-setting-menu"><a  class="nav-link"
                                         href="{{ route('setting.hrm') }}">{{ trans('file.HRM Setting') }}</a></li>
                            @endif
                            @if ($role->id <= 2)
                                <li class="nav-item" id="role-menu"><a class="nav-link"
                                        href="{{ route('role.index') }}">{{ trans('file.Role Permission') }}</a>
                                </li>
                            @endif
                            @if ($send_notification_permission_active)
                                <li class="nav-item" id="notification-menu"><a class="nav-link"
                                    href="" id="send-notification" >{{ trans('file.Send Notification') }}</a>
                                </li>
                            @endif
                            @if ($warehouse_permission_active)
                                <li class="nav-item" id="warehouse-menu"><a class="nav-link"
                                        href="{{ route('warehouse.index') }}">{{ trans('file.Warehouse') }}</a>
                                </li>
                            @endif

                            @if ($unit_permission_active)
                                <li class="nav-item" id="unit-menu"><a class="nav-link"
                                        href="{{ route('unit.index') }}">{{ trans('file.Unit') }}</a></li>
                            @endif
                            @if ($currency_permission_active)
                                <li class="nav-item" id="currency-menu"><a class="nav-link"
                                        href="{{ route('currency.index') }}">{{ trans('file.Currency') }}</a>
                                </li>
                            @endif
                            @if ($tax_permission_active)
                                <li class="nav-item" id="tax-menu"><a  class="nav-link"
                                  href="{{ route('tax.index') }}">{{ trans('file.Tax') }}</a>
                                </li>
                            @endif
                            <li class="nav-item" id ="user-menu"><a class="nav-link"
                                    href="{{ route('user.profile', ['id' => Auth::id()]) }}">{{ trans('file.User Profile') }}</a>
                            </li>

                            @if ($backup_database_permission_active)
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('setting.backup') }}">{{ trans('file.Backup Database') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </nav>
        </section>
    </aside>

    <div class="flex flex-col flex-1 w-full">
        <header class="main-header bg-white shadow-md">
            <div class="flex items-center justify-between h-full px-6 mx-auto text-blue-600">
                <?php
                $add_permission = DB::table('permissions')
                    ->where('name', 'sales-add')
                    ->first();
                $add_permission_active = DB::table('role_has_permissions')
                    ->where([['permission_id', $add_permission->id], ['role_id', $role->id]])
                    ->first();
                
                $empty_database_permission = DB::table('permissions')
                    ->where('name', 'empty_database')
                    ->first();
                $empty_database_permission_active = DB::table('role_has_permissions')
                    ->where([['permission_id', $empty_database_permission->id], ['role_id', $role->id]])
                    ->first();
                ?>
                <!-- Mobile hamburger -->
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                  </a>

                <!-- Search input -->
                <div class="flex justify-center flex-1 lg:mr-32">
                    <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">

                    </div>
                </div>
                <ul class="flex items-center flex-shrink-0 space-x-6">
                        <?php 
                          $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
                          $add_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $add_permission->id],
                              ['role_id', $role->id]
                          ])->first();
        
                          $empty_database_permission = DB::table('permissions')->where('name', 'empty_database')->first();
                          $empty_database_permission_active = DB::table('role_has_permissions')->where([
                              ['permission_id', $empty_database_permission->id],
                              ['role_id', $role->id]
                          ])->first();
                        ?>
                        <li class="nav-item"><a class="btn btn-sm btn-danger" href="{{route('sale.pos')}}"><i class="dripicons-shopping-bag"></i><span> POS</span></a></li>
                        <li class="nav-item"><a id="btnFullscreen"><i class="dripicons-expand"></i></a></li>
                        @if(\Auth::user()->role_id <= 2)
                          <li class="nav-item"><a href="{{route('cashRegister.index')}}" title="{{trans('file.Cash Register List')}}"><i class="dripicons-archive"></i></a></li>
                        @endif
                        @if($product_qty_alert_active)
                          @if(($alert_product + count(\Auth::user()->unreadNotifications)) > 0)
                          <li class="nav-item" id="notification-icon">
                                <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span class="badge badge-danger notification-number">{{$alert_product + count(\Auth::user()->unreadNotifications)}}</span>
                                </a>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications" user="menu">
                                    <li class="notifications">
                                      <a href="{{route('report.qtyAlert')}}" class="btn btn-link"> {{$alert_product}} product exceeds alert quantity</a>
                                    </li>
                                    @foreach(\Auth::user()->unreadNotifications as $key => $notification)
                                        <li class="notifications">
                                            <a href="#" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                          </li>
                          @elseif(count(\Auth::user()->unreadNotifications) > 0)
                          <li class="nav-item" id="notification-icon">
                                <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span class="badge badge-danger notification-number">{{count(\Auth::user()->unreadNotifications)}}</span>
                                </a>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications" user="menu">
                                    @foreach(\Auth::user()->unreadNotifications as $key => $notification)
                                        <li class="notifications">
                                            <a href="#" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                          </li>
                          @endif
                        @endif
                        <li class="nav-item">
                              <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-web"></i> <span>{{__('file.language')}}</span> <i class="fa fa-angle-down"></i></a>
                              <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                  <a href="{{ url('language_switch/fr') }}" class="btn btn-link"> Français</a>
                                </li>
                                <li>
                                  <a href="{{ url('language_switch/ar') }}" class="btn btn-link"> عربى</a>
                                  </li>
                                  <li>
                                    <a href="{{ url('language_switch/en') }}" class="btn btn-link"> English</a>
                                  </li>
                              </ul>
                        </li>
                        <li class="nav-item">
                          <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i> <span>{{ucfirst(Auth::user()->name)}}</span> <i class="fa fa-angle-down"></i>
                          </a>
                          <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                              <li> 
                                <a href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="dripicons-user"></i> {{trans('file.profile')}}</a>
                              </li>
                              @if($general_setting_permission_active)
                              <li> 
                                <a href="{{route('setting.general')}}"><i class="dripicons-gear"></i> {{trans('file.settings')}}</a>
                              </li>
                              @endif
                              <li> 
                                <a href="{{url('my-transactions/'.date('Y').'/'.date('m'))}}"><i class="dripicons-swap"></i> {{trans('file.My Transaction')}}</a>
                              </li>
                              @if(Auth::user()->role_id != 5)
                              <li> 
                                <a href="{{url('holidays/my-holiday/'.date('Y').'/'.date('m'))}}"><i class="dripicons-vibrate"></i> {{trans('file.My Holiday')}}</a>
                              </li>
                              @endif
                              <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
                                    {{trans('file.logout')}}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                              </li>
                          </ul>
                        </li> 
                </ul>
            </div>
        </header>

        <div>
            <div class="content-wrapper">
                <div class="animate-bottom px-6 mx-auto grid">
                    @yield('content')
                </div>

                <!-- notification modal -->
                <div id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">
                                    {{ trans('file.Send Notification') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'notifications.store', 'method' => 'post']) !!}
                                <div class="flex flex-wrap ">
                                    <?php
                                    $lims_user_list = DB::table('users')
                                        ->where([['is_active', true], ['id', '!=', \Auth::user()->id]])
                                        ->get();
                                    ?>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.User') }} *</label>
                                        <select name="user_id"
                                            class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            required data-live-search="true" data-live-search-style="begins"
                                            title="Select user...">
                                            @foreach ($lims_user_list as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name . ' (' . $user->email . ')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:w-full pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Message') }} *</label>
                                        <textarea rows="5" name="message"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- expense modal -->
                <div id="expense-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Expense') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'expenses.store', 'method' => 'post']) !!}
                                <?php
                                $lims_expense_category_list = DB::table('expense_categories')
                                    ->where('is_active', true)
                                    ->get();
                                if (Auth::user()->role_id > 2) {
                                    $lims_warehouse_list = DB::table('warehouses')
                                        ->where([['is_active', true], ['id', Auth::user()->warehouse_id]])
                                        ->get();
                                } else {
                                    $lims_warehouse_list = DB::table('warehouses')
                                        ->where('is_active', true)
                                        ->get();
                                }
                                $lims_account_list = \App\Account::where('is_active', true)->get();
                                
                                ?>
                                <div class="flex flex-wrap ">
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Expense Category') }} *</label>
                                        <select name="expense_category_id"
                                            class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            data-live-search="true" data-live-search-style="begins"
                                            title="Select Expense Category...">
                                            @foreach ($lims_expense_category_list as $expense_category)
                                                <option value="{{ $expense_category->id }}">
                                                    {{ $expense_category->name . ' (' . $expense_category->code . ')' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Warehouse') }} *</label>
                                        <select name="warehouse_id"
                                            class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            data-live-search="true" data-live-search-style="begins"
                                            title="{{ trans('file.Select warehouse...') }}">
                                            @foreach ($lims_warehouse_list as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Amount') }} *</label>
                                        <input type="number" name="amount" step="any" required
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label> {{ trans('file.Account') }}</label>
                                        <select
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker"
                                            name="account_id">
                                            @foreach ($lims_account_list as $account)
                                                @if ($account->is_default)
                                                    <option selected value="{{ $account->id }}">
                                                        {{ $account->name }}
                                                        [{{ $account->account_no }}]</option>
                                                @else
                                                    <option value="{{ $account->id }}">{{ $account->name }}
                                                        [{{ $account->account_no }}]</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label>{{ trans('file.Note') }}</label>
                                    <textarea name="note" rows="3"
                                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"></textarea>
                                </div>
                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- account modal -->
                <div id="account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Account') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'accounts.store', 'method' => 'post']) !!}
                                <div class="mb-4">
                                    <label>{{ trans('file.Account No') }} *</label>
                                    <input type="text" name="account_no" required
                                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                                <div class="mb-4">
                                    <label>{{ trans('file.name') }} *</label>
                                    <input type="text" name="name" required
                                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                                <div class="mb-4">
                                    <label>{{ trans('file.Initial Balance') }}</label>
                                    <input type="number" name="initial_balance" step="any"
                                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                                </div>
                                <div class="mb-4">
                                    <label>{{ trans('file.Note') }}</label>
                                    <textarea name="note" rows="3"
                                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"></textarea>
                                </div>
                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- account statement modal -->
                <div id="account-statement-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">
                                    {{ trans('file.Account Statement') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'accounts.statement', 'method' => 'post']) !!}
                                <div class="flex flex-wrap ">
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label> {{ trans('file.Account') }}</label>
                                        <select
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker"
                                            name="account_id">
                                            @foreach ($lims_account_list as $account)
                                                <option value="{{ $account->id }}">{{ $account->name }}
                                                    [{{ $account->account_no }}]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label> {{ trans('file.Type') }}</label>
                                        <select
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker"
                                            name="type">
                                            <option value="0">{{ trans('file.All') }}</option>
                                            <option value="1">{{ trans('file.Debit') }}</option>
                                            <option value="2">{{ trans('file.Credit') }}</option>
                                        </select>
                                    </div>
                                    <div class="md:w-full pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Choose Your Date') }}</label>
                                        <div class="relative flex items-stretch w-full">
                                            <input type="text"
                                                class="daterangepicker-field block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                                required />
                                            <input type="hidden" name="start_date" />
                                            <input type="hidden" name="end_date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- warehouse modal -->
                <div id="warehouse-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">
                                    {{ trans('file.Warehouse Report') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'report.warehouse', 'method' => 'post']) !!}
                                <?php
                                $lims_warehouse_list = DB::table('warehouses')
                                    ->where('is_active', true)
                                    ->get();
                                ?>
                                <div class="mb-4">
                                    <label>{{ trans('file.Warehouse') }} *</label>
                                    <select name="warehouse_id"
                                        class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                        required data-live-search="true" id="warehouse-id"
                                        data-live-search-style="begins"
                                        title="{{ trans('file.Select warehouse...') }}">
                                        @foreach ($lims_warehouse_list as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="start_date" value="2021-01-01" />
                                <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />

                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- user modal -->
                <div id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                    class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.User Report') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'report.user', 'method' => 'post']) !!}
                                <?php
                                $lims_user_list = DB::table('users')
                                    ->where('is_active', true)
                                    ->get();
                                ?>
                                <div class="mb-4">
                                    <label>{{ trans('file.User') }} *</label>
                                    <select name="user_id"
                                        class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                        required data-live-search="true" id="user-id" data-live-search-style="begins"
                                        title="Select user...">
                                        @foreach ($lims_user_list as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name . ' (' . $user->phone . ')' }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="start_date" value="2021-01-01" />
                                <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />

                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- customer modal -->
                <div id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">
                                    {{ trans('file.Customer Report') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'report.customer', 'method' => 'post']) !!}
                                <?php
                                $lims_customer_list = DB::table('customers')
                                    ->where('is_active', true)
                                    ->get();
                                ?>
                                <div class="mb-4">
                                    <label>{{ trans('file.customer') }} *</label>
                                    <select name="customer_id"
                                        class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                        required data-live-search="true" id="customer-id"
                                        data-live-search-style="begins" title="Select customer...">
                                        @foreach ($lims_customer_list as $customer)
                                            <option value="{{ $customer->id }}">
                                                {{ $customer->name . ' (' . $customer->phone_number . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="start_date" value="2021-01-01" />
                                <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />

                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- supplier modal -->
                <div id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">
                                    {{ trans('file.Supplier Report') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'report.supplier', 'method' => 'post']) !!}
                                <?php
                                $lims_supplier_list = DB::table('suppliers')
                                    ->where('is_active', true)
                                    ->get();
                                ?>
                                <div class="mb-4">
                                    <label>{{ trans('file.Supplier') }} *</label>
                                    <select name="supplier_id"
                                        class="selectpicker block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                        required data-live-search="true" id="supplier-id"
                                        data-live-search-style="begins" title="Select Supplier...">
                                        @foreach ($lims_supplier_list as $supplier)
                                            <option value="{{ $supplier->id }}">
                                                {{ $supplier->name . ' (' . $supplier->phone_number . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="start_date" value="2021-01-01" />
                                <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}" />

                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- activity modal -->
                <div id="activity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">{{ trans('file.Add Activity') }}
                                </h5>
                                <button type="button" data-dismiss="modal" aria-label="Close"
                                    class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i
                                            class="dripicons-cross"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p class="italic">
                                    <small>{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                                </p>
                                {!! Form::open(['route' => 'activity.store', 'method' => 'post', 'files' => true]) !!}
                                <?php
                                $lims_employee_list = DB::table('employees')
                                    ->where('is_active', true)
                                    ->get();
                                ?>
                                <div class="flex flex-wrap ">
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Employee') }} *</label>
                                        <select
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker"
                                            name="employee_id[]" required data-live-search="true"
                                            data-live-search-style="begins" title="Selection..." multiple>
                                            @foreach ($lims_employee_list as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Date') }} *</label>
                                        <input type="text" name="date"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded date"
                                            value="{{ date($general_setting->date_format) }}" required>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Hour') }} *</label>
                                        <input type="text" id="hour" name="hour"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded time"
                                            required>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.customer') }} *</label>
                                        <select
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded selectpicker"
                                            name="customer_id[]" required data-live-search="true"
                                            data-live-search-style="begins" title="Selection..." multiple>
                                            @foreach ($lims_customer_list as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Object') }} *</label>
                                        <input type="text" id="object" name="object"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            required>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Duration') }} *</label>
                                        <input type="text" id="duration" name="duration"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            required>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Transportation') }} *</label>
                                        <input type="text" id="transportation" name="transportation"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            required>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Expense') }} *</label>
                                        <input type="text" id="expense" name="expense"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            required>
                                    </div>
                                    <div class="md:w-1/2 pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Place') }} *</label>
                                        <input type="text" id="place" name="place"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                            required>
                                    </div>
                                    <div class="md:w-full pr-4 pl-4 mb-4">
                                        <label>{{ trans('file.Note') }}</label>
                                        <textarea name="note" rows="3"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"></textarea>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit"
                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ trans('file.submit') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="layout-footer-fixed">
                    <div class="container max-w-full mx-auto sm:px-4">
                        <div class="flex flex-wrap ">
                            <div class="sm:w-full pr-4 pl-4">
                                <p>&copy; {{ $general_setting->site_title }} | {{ trans('file.Developed') }}
                                    {{ trans('file.By') }} <span class="external">Zakaria Labib</span></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
</body>

</html>

@push('scripts')

    <script type="text/javascript">
        var alert_product = <?php echo json_encode($alert_product); ?>;


        if ($(window).outerWidth() > 1199) {
            $('nav.side-navbar').removeClass('shrink');
        }

        $("div.alert").delay(3000).slideUp(750);

        function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        $("li#notification-icon").on("click", function(argument) {
            $.get('notifications/mark-as-read', function(data) {
                $("span.notification-number").text(alert_product);
            });
        });

        $("a#add-activity").click(function(e) {
            e.preventDefault();
            $('#activity-modal').modal();
        });

        $("a#add-expense").click(function(e) {
            e.preventDefault();
            $('#expense-modal').modal();
        });

        $("a#send-notification").click(function(e) {
            e.preventDefault();
            $('#notification-modal').modal();
        });

        $("a#add-account").click(function(e) {
            e.preventDefault();
            $('#account-modal').modal();
        });

        $("a#account-statement").click(function(e) {
            e.preventDefault();
            $('#account-statement-modal').modal();
        });

        $("a#profitLoss-link").click(function(e) {
            e.preventDefault();
            $("#profitLoss-report-form").submit();
        });

        $("a#report-link").click(function(e) {
            e.preventDefault();
            $("#product-report-form").submit();
        });

        $("a#purchase-report-link").click(function(e) {
            e.preventDefault();
            $("#purchase-report-form").submit();
        });

        $("a#sale-report-link").click(function(e) {
            e.preventDefault();
            $("#sale-report-form").submit();
        });

        $("a#payment-report-link").click(function(e) {
            e.preventDefault();
            $("#payment-report-form").submit();
        });

        $("a#warehouse-report-link").click(function(e) {
            e.preventDefault();
            $('#warehouse-modal').modal();
        });

        $("a#user-report-link").click(function(e) {
            e.preventDefault();
            $('#user-modal').modal();
        });

        $("a#customer-report-link").click(function(e) {
            e.preventDefault();
            $('#customer-modal').modal();
        });

        $("a#supplier-report-link").click(function(e) {
            e.preventDefault();
            $('#supplier-modal').modal();
        });

        $("a#due-report-link").click(function(e) {
            e.preventDefault();
            $("#due-report-form").submit();
        });

        $(".daterangepicker-field").daterangepicker({
            callback: function(startDate, endDate, period) {
                var start_date = startDate.format('YYYY-MM-DD');
                var end_date = endDate.format('YYYY-MM-DD');
                var title = start_date + ' To ' + end_date;
                $(this).val(title);
                $('#account-statement-modal input[name="start_date"]').val(start_date);
                $('#account-statement-modal input[name="end_date"]').val(end_date);
            }
        });

        $('.selectpicker').selectpicker({
            style: 'btn-link',
        });
    </script>

@endpush
