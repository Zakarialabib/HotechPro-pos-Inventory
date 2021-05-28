@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800  text-center"><button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('not_permitted') !!}</div> 
@endif
<section class="forms">
    <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                        <h4>{{trans('file.Create SMS')}}</h4>
                    </div>
                    <div class="flex-auto p-6">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.<strong>{{trans('file.Add mobile numbers by selecting the customers')}}</strong></small></p>
                        {!! Form::open(['route' => 'setting.sendSms', 'method' => 'post']) !!}
                            <div class="flex flex-wrap ">
                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div class="mb-4">
                                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="lims_customerSearch" id="lims_customerSearch" placeholder="Please type customer name or mobile no and select..." />
                                    </div>
                                    <div class="mb-4 twilio">
                                        <label>{{trans('file.Mobile')}} *</label>
                                        <input type="text" name="mobile" id="mobile" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" placeholder="example : +8801*********,+8801*********" required />
                                    </div>
                                    <div class="mb-4 twilio">
                                        <label>{{trans('file.Message')}} *</label>
                                        <textarea name="message" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600"><i class="fa fa-paper-plane"></i> {{trans('file.Send SMS')}}</button> 
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #create-sms-menu").addClass("active");

    <?php $customerArray = []; ?>
    var customer = [ @foreach($lims_customer_list as $customer)
        <?php
            $customerArray[] = $customer->name . ' [' . $customer->phone_number . ']';
        ?>
         @endforeach
            <?php
            echo  '"'.implode('","', $customerArray).'"';
            ?> ];

    var lims_customerSearch = $('#lims_customerSearch');

    lims_customerSearch.autocomplete({
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(customer, function(item) {
                return matcher.test(item);
            }));
        },
        response: function(event, ui) {
            if (ui.content.length == 1) {
                var data = ui.content[0].value;
                $(this).autocomplete( "close" );
                getNumber(data);
            };
        },
        select: function(event, ui) {
            var data = ui.item.value;
            event.preventDefault();
            getNumber(data);
        }
    });

    function getNumber(data) { 
        mobile_no = data.substring(data.indexOf("[")+1, data.indexOf("]") );
        if( !$('#mobile').val().includes(mobile_no) ){
            if($('#mobile').val() == '')
                $('#mobile').val(mobile_no);
            else
                $('#mobile').val( $('#mobile').val()+','+mobile_no );
        }
        $('#lims_customerSearch').val('');
    }

</script>
@endsection