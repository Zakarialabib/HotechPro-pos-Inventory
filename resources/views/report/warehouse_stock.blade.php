@extends('layout.main')
@section('content')
<section>
	<div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
            <div class="flex-auto p-6">
				<div class="md:w-full pr-4 pl-4">
					<div class="md:w-1/2 pr-4 pl-4 md:mx-1/4 mt-3 text-center">
						{{ Form::open(['route' => 'report.warehouseStock', 'method' => 'post', 'id' => 'report-form']) }}
						<input type="hidden" name="warehouse_id_hidden" value="{{$warehouse_id}}">
						<h3>{{trans('file.Stock Chart')}} </h3>
						<p>Select warehouse to view chart</p>
						<select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded mb-3" id="warehouse_id" name="warehouse_id">
							<option value="0">{{trans('file.All Warehouse')}}</option>
							@foreach($lims_warehouse_list as $warehouse)
							<option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
							@endforeach
						</select>
						{{ Form::close() }}
					</div>
					
					<div class="md:w-1/2 pr-4 pl-4 md:mx-1/4 mt-3 mb-3">
						<div class="flex flex-wrap ">
							<div class="md:w-1/2 pr-4 pl-4">
								<span>Total {{trans('file.Items')}}</span>
								<h2><strong>{{number_format((float)$total_item, 2, '.', '') }}</strong></h2>
							</div>
							<div class="md:w-1/2 pr-4 pl-4">
								<span>Total {{trans('file.Quantity')}}</span>
								<h2><strong>{{number_format((float)$total_qty, 2, '.', '') }}</strong></h2>
							</div>	
						</div>		
					</div>
						
					<div class="md:w-2/5 pr-4 pl-4 md:mx-1/4 mt-2">
						<div class="pie-chart">
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
					      	<canvas id="pieChart" data-color="{{$color}}" data-color_rgba="{{$color_rgba}}" data-price={{$total_price}} data-cost={{$total_cost}} width="10" height="10" data-label1="{{trans('file.Stock Value by Price')}}" data-label2="{{trans('file.Stock Value by Cost')}}" data-label3="{{trans('file.Estimate Profit')}}"> </canvas>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #warehouse-stock-report-menu").addClass("active");

	$('#warehouse_id').val($('input[name="warehouse_id_hidden"]').val());
	$('.selectpicker').selectpicker('refresh');

	$('#warehouse_id').on("change", function(){
		$('#report-form').submit();
	});
</script>
@endsection