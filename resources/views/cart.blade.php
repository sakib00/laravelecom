@extends('layouts.app')
@section('content')
<div class="container">
	<h2>Cart Page</h2>
		<div class="alert alert-danger" role="alert" style="display: none;">Items Deleted Successfully.</div>
		@if( isset($data['temp_orders']) && count($data['temp_orders']) )
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="width:45%">Product</th>
					<th style="width:25%">Qty</th>
					<th style="width:15%">Total</th>
					<th style="width:15%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data['temp_orders'] as $temp_order)
					<form id="update_cart" method="post" action="{{ url('/') }}/update-cart" id="{{ $temp_order->temp_order_row_id}}">
						{{ csrf_field() }}
						<tr id="tid_{{$temp_order->temp_order_row_id}}">
							<td>{{$temp_order->product_name}}</td>	
							<td>
								<div style="float: left; margin-left: 10px">
									<input type="text" class="form-control" title="Qty" min="1" value="{{$temp_order->product_qty}}" maxlength="12" id="qty_{{$temp_order->temp_order_row_id}}" name="qty_textbox" style="width: 100px">
								</div>
								<div style="float: left; margin-left: 10px">
									<input type="hidden" name="temp_order_row_id" value="{{$temp_order->temp_order_row_id}}">
									<button class="btn btn-success">Update Cart</button>			
								</div>
							</td>
							<td>${{ $temp_order->product_total_price }}</td>
							<td>
								<a href="javascript:void(0)" temp_order_row_id="{{ $temp_order->temp_order_row_id }}" class="remove-item" data-toggle="modal" data-target="#confirm"/> 
									<button class="btn btn-danger remove-item-cart">Delete</button>
								</a>
								<input type="hidden" name="temp_order_row_id[]" value="{{ $temp_order->temp_order_row_id }}"/>
							</td>						
						</tr>						
					</form>
					@endforeach
					<tr>
						<td colspan="2" class="text-right">
							<strong>Total :</strong>							
						</td>
						<td class="text-left"> ${{$data['total_price']}}</td>
						<td>&nbsp;</td>
					</tr>

					<tr class="first last">
						<td colspan="4" class="a-right last">
							<a href="{{URL::to('/checkoutPage')}}"> 
								<button type="button" title="Continue Shopping" class="button btn-continue btn-info" href=" {{ url('/') }} "><span>Checkout</span></button>
							</a>

							<a href="{{URL::to('/')}}"> 
								<button type="button" title="Continue Shopping" class="button btn-continue btn-info" href=" {{ url('/') }} "><span>Continue Shopping</span></button>
							</a>

							<a href="javascript:void(0)" temp_order_row_id="{{ $temp_order->temp_order_row_id }}" id="remove-all" /> 
								<button type="button" class="button btn-danger">Remove All</button>
							</a>
						</td>
					</tr>
			</tbody>
		</table>
		@else
		<div class="col-sm-12 text-center">Cart is empty!</div>
		@endif
</div>

<div class="modal" id="confirm" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Delete Confirmation</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			</div>

			<div class="modal-body">
				<p>Are you sure, you want to delete?</p>				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" id="delete-btn">Delete</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function(){
		$("#qty_textbox").change(function(){
			$("#car_from").submit();
		});

		$('.remove-item').click(function(e){
			var temp_order_row_id = $(this).attr('temp_order_row_id');
			$('#delete-btn').attr('temp_order_row_id', temp_order_row_id);
		});

		$('#delete-btn').click(function(){
			$('#confirm').modal('toggle');
			var temp_order_row_id = $(this).attr('temp_order_row_id');
			$.ajax({
				url: "{{ url('cartItemDelete/') }}" + '/' + temp_order_row_id,
				type: "GET",
				dataType: "html",
				success: function(data){
					if(data == 1){
						$('.alert-danger').css("display", "block");
						$('.alert-danger').delay(3000).fadeOut('slow');
						$('#tid_'+temp_order_row_id).hide('slow');
					}
				}
			});
		});
		$('#remove-all').click(function(){

			//var dataString = temp_order_row_id = + temp_order_row_id;
			if(!confirm('Are you sure to remove all items from cart?'))
			{
				return false;
			}
			$.ajax({
					type: "GET",
					url: "{{url ('/') }}" + "/cartItemDeleteAll",
					dataType: "html",
					success : function(data){
						//console.log(data);
						window.location.href = '{{url('/')}}/mycart';
					}
			});

		});

	});

</script>

@endsection