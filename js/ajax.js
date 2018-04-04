
$(function(){
	// search about cars

	setInterval(function(){
		showCars();
	},500);

// show cars in table with options
	function showCars(){
		var show = 'show';
		$.ajax({
			url: 'function.php?do=show',
			type: 'get',
		}).done(function(data){
			$('.cars_data').html(data);
		})
	}

//showing cars in available in real time
	$('.search').keyup(function(){
		var search = $(this).val();
		$.ajax({
			url: 'function.php',
			type: 'post',
			data: {search:search},

		}).done(function(data){
			$('.result').html(data);
		}).fail(function() {
		    alert( "error" );
		  });
	});

// Adding cars
	$('.form_add_car').submit(function(e){
		e.preventDefault();


		var car_name = $('.add_car_name').val();
		var url = 'function.php';
		$.post(url,
				{
					car_name : car_name
				}).done(function(data){
			$('.add_car_name').val('');
		});		
	});

// confirm deleteing 





});