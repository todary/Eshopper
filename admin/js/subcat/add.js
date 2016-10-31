$(function()
{
	console.log("hereeeeeeeeeeee");

	// var x=$('#sel1').val();
var id_categories; // public id
$('body').on('click','.choice_cat',function() 
{
		$("#data").show();
		id_categories=$('#sel1').val();
		// console.log(id_categories);
		
	
});


$('body').on('click','#add_cat',function() 
	{
		console.log("ssss");
		var num=$("#number").val();
		var name=$("#name").val();
		var des=$("#Des").val();
		var subcat={};
		subcat.number=num;
		subcat.name=name;
		subcat.des=des;
		subcat.parent=id_categories;

		console.log(subcat);


		$.ajax
		({
			url: 'http://localhost/Eshopper/server/categorie.php',
			type: 'POST',
			data :subcat,
		    success: function(data)
		    {
		       console.log(data);
		    }
		   
		});

		
	});




	

	


});