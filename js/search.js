$(function()
{
			console.log("start");


	$('body').on('click','#search',function() 
	{
			console.log("start");

			start=sessionStorage.getItem('start');
			end=sessionStorage.getItem('end');
			console.log(start);
			console.log(end);

			obj={};
			obj.start=parseInt(start);
			obj.end=parseInt(end);
			obj.search="";
			// console.log(obj);
			var mydiv = document.getElementById("div_search_price");
		$.ajax
		({
			url: "http://localhost/Eshopper/server/product.php",
			type: 'POST',
			data :obj,
		    success: function(data)
		    {
		    	console.log(data);
		    	if (data.data=='Product not found') 
		    		{
				    	var HTMLtxt='Product not found';
				    	mydiv.innerHTML = HTMLtxt;

		    		}
		    		else
		    		{
		    			var HTMLtxt='';
						$.each (data.data,function (index, value)
						{
							HTMLtxt +='<div class="col-sm-9">';
							HTMLtxt +='<div class="product-image-wrapper">';
							HTMLtxt +='<div class="single-products">';
							HTMLtxt +='<div class="productinfo text-center">';
							HTMLtxt +='<img src="'+value.image+'" alt="" />';
							HTMLtxt +='<h2>'+value.price+'</h2>';
							HTMLtxt +='<p>'+value.des_product+'</p>';
							HTMLtxt +='<button type="button"  data-rowid="'+value.id+'" class="btn btn-default add-to-cart add_pro"><i class="fa fa-shopping-cart"></i>Add to cart</button>';					 
							HTMLtxt +='</div>';
							HTMLtxt +='</div>';
							HTMLtxt +='</div>';
							HTMLtxt +='</div>';
						});
						mydiv.innerHTML = HTMLtxt;
		
		    		}
		    	


		   	

		    }
		   
		});
	});


	












});