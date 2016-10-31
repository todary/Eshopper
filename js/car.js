	$(function()
	{

		$('body').on('click','.delete_pro',function() 
		{
			var row_id = $(this).data('rowid');
			console.log(row_id);
			$(this).parent().parent().remove();

			var obj={}; 
			obj._method='delete';

			 $.ajax
			({
				url: "http://localhost/Eshopper/server/shope_car.php?id="+row_id+"",
				type: 'POST',
				data :obj,
			    success: function(data)
			    {
			    	console.log(data);

			    }
			   
			});



		});

		$('body').on('click','.incres',function() 
		{

			var row_id = $(this).data('rowid');


			


			// var row_id = $('.input_quant').data('rowid');
			// console.log(row_id);
			var val=$('#'+row_id+'').val();
			// console.log(val);
			$('#'+row_id+'').val(parseInt(val)+1);
			var number =$('#'+row_id+'').val();
			console.log(number);
			var total=document.getElementById("t"+row_id+"");
			var price=document.getElementById("p"+row_id+"");
			
			var value_price=$("#p"+row_id+"").val();
			console.log(value_price);
			total.innerHTML=parseInt(number)*parseInt(value_price);

			var bill = document.getElementById('total_bill');
			// console.log(bill.contents());
			var last_bill=$("#total_bill").html();
			// console.log(x);
			bill.innerHTML=(parseInt(last_bill)+parseInt(value_price));


			var obj_update={};
			obj_update._method='quantity';
			obj_update.quantity=number;


			 $.ajax
			({
				url: "http://localhost/Eshopper/server/shope_car.php?id="+row_id+"",
				type: 'POST',
				data :obj_update,
			    success: function(data)
			    {
			    	console.log(data);

			    }
			   
			});

			// $('#t'+row_id+'').innerHTML="sdsd";
		// console.log(x);
		// $(this).parent().parent().remove();
		});
		$('body').on('click','.decres',function() 
		{
			var row_id = $(this).data('rowid');
			// var row_id = $('.input_quant').data('rowid');
			// console.log(row_id);
			var val=$('#'+row_id+'').val();
			var total=document.getElementById("t"+row_id+"");
			var price=document.getElementById("p"+row_id+"");

			// console.log(val);
			if(parseInt(val)==0)
			{
				$('#'+row_id+'').val('0');
			}
			else
			{
				$('#'+row_id+'').val(parseInt(val)-1);

			}
			var number =$('#'+row_id+'').val();
			var value_price=$("#p"+row_id+"").val();
			console.log(value_price);
			total.innerHTML=parseInt(number)*parseInt(value_price);
		// $(this).parent().parent().remove();


			var bill = document.getElementById('total_bill');
			// console.log(bill.contents());
			var last_bill=$("#total_bill").html();
			// console.log(x);
			bill.innerHTML=(parseInt(last_bill)-parseInt(value_price));


			var obj_update={};
			obj_update._method='quantity';
			obj_update.quantity=number;


			 $.ajax
			({
				url: "http://localhost/Eshopper/server/shope_car.php?id="+row_id+"",
				type: 'POST',
				data :obj_update,
			    success: function(data)
			    {
			    	console.log(data);

			    }
			   
			});


		});




		// $('body').on('click','.buy_products',function() 
		// {
			
			
		// });
		





		


	});