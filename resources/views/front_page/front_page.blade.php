<!DOCTYPE html>
<html>
<head>
	<title>Multiple Insert Data</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	
</head>
<body>

	<div class="container">	
		<br>
		@if(Session::has('success'))
		 <div class="alert alert-success">
		     {{Session::get('success')}}
		 </div>
		 @endif
		<form action="/orders" method="POST">
			{{ csrf_field() }}
			<section>
				<div class="panel panel-heder">
					<center><H2 style="font-style: italic">Multiple Insert</H2></center>
					<br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="customer_name" placeholder="please enter your name" class="form-control">
							</div>
						</div>	

						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="customer_address" placeholder="please enter your address" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-footer">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Brand</th>
								<th>Quantity</th>
								<th>Budget</th>
								<th>Amount</th>
								<th>
									<a href="#" class="addRow" title="">
										<i class="glyphicon glyphicon-plus"></i>
									</a>
								</th>
							</tr>
						</thead>
						<tbody>
					{{-- 		@foreach($data as $row) --}}
							<tr>
								<td>
									<input type="text" name="product_name[]" class="form-control " required>
								</td>
								
								<td>
									<input type="text" name="brand[]"  class="form-control brand" required>
								</td>
								<td>
									<input type="text" name="quantity[]" class="form-control quantity" required>
								</td>
								<td>
									<input type="text" name="budget[]" class="form-control budget" required>
								</td>
								<td>
									<input type="text" name="amount[]" class="form-control amount" required>
								</td>
								<td>
									<a href="#" class="btn btn-danger remove" title=""><i class="glyphicon glyphicon-remove"></i></a>
								</td>
							</tr>
							
						</tbody>
						<tfoot>
							<tr>
								<td style="border: none"></td>
								<td style="border: none"></td>
								<td style="border: none"></td>
								<td>Total</td>
								<td><b class="total"></b> </td>
								<td><input type="submit" name="" value="Submit" class="btn btn-success"></td>
							</tr>
						</tfoot>

					</table>

					

				</div>
			</section>	
		</form>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Brand</th>
					<th>Quantity</th>
					<th>Budget</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $row)
				<tr>
					<td>{{ $row->product_name }}</td>
					<td>{{ $row->brand }}</td>
					<td>{{ $row->quantity }}</td>
					<td>{{ $row->budget }}</td>
					<td>{{ $row->amount }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>	

</body>

<script type="text/javascript">

	$(document).ready(function() {
		
		$('tbody').delegate('.quantity,.budget','keyup',function(){
		        var tr=$(this).parent().parent();
		        var quantity= tr.find('.quantity').val();
		        var budget= tr.find('.budget').val();
		        var amount=  quantity*budget;
		        tr.find('.amount').val(amount);
		        total();
		    });
		function total()
		{
			var total = 0;
			$('.amount').each(function(i, e) {
				var amount=$(this).val()-0;
				total +=amount;

			});
			$('.total').html(total +".00 tk")
		}

		$('.addRow').on('click', function(){
			addRow();
		});
 
		function addRow()
		{
			var tr= '<tr>'+
			'<td><input type="text" name="product_name[]" class="form-control" required></td>'+
			
			'<td><input type="text" name="brand[]" class="form-control brand" required></td>'+
			'<td><input type="text" name="quantity[]" class="form-control quantity" required></td>'+ 
			'<td><input type="text" name="budget[]" class="form-control budget" required></td>'+
			'<td><input type="text" name="amount[]" class="form-control amount" required></td>'+
			'<td><a href="#" class="btn btn-danger remove" title=""><i class="glyphicon glyphicon-remove"></i></a></td>'+
			'</tr>';
			$('tbody').append(tr);			 
		}

		$('.remove').live('click', function() {
			var last = $('tbody tr').length;
			if (last == 1) {
				alert('Baris terakhir tidak bisa dihapus!');
			}
			else {
				$(this).parent().parent().remove();
			}
			
		});
	});
</script>

</html>