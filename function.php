<?php
ob_start();
try{
	$db = new PDO('mysql:host=localhost;dbname=ajax','root','');

}catch(PDOException $e){
	die($e->getMessage());
}

// showing cars in table
if(isset($_GET['do']) && $_GET['do'] == 'show'){
	$stmt = $db->prepare("select * from cars");
	if($stmt->execute()){
		$cars = $stmt->fetchAll();
			
		foreach ($cars as $car) {
			echo "<tr>";
			echo	"<th scope='row'>". $car['id']. "</th>";
			echo	"<td>". $car['name'] ."</td>";
			echo	"<td>
						<button type='button' rel='{$car['id']}' class='btn btn-info update_car title-link'>Update</button>
						<button type='button' rel='{$car['id']}' class='btn btn-danger delete_car title-link confirm'>Delete</button>
					</td>";
			echo "</tr>";
		}
	}else{
		echo "something went wrong";
	}
}


//showing cars in real time
if(isset($_POST['search']) && !empty($_POST['search'])){
	$search = $_POST['search'];
	$stmt = $db->prepare("select name from cars where name like '$search%'");
	$stmt->execute();
	$data = $stmt->fetchAll();
	if(!empty($data)){
		foreach ($data as $car) {
			echo "<div class='list-group'>";
			?>
				<a href="#" class="list-group-item list-group-item-action"><?php echo $car['name']; ?></a>
			<?php
		}
	echo "</div>";
	} else{ ?>
		<div class='list-group'>
			<p class="list-group-item list-group-item-action">Sorry this car isn't available</p>
		</div>
<?php	}
}

// PHP inserting cars in database

if(isset($_POST['car_name'])){
	$car_name = $_POST['car_name'];
	$stmt = $db->prepare("insert into cars(name) values('$car_name')");
	if($stmt->execute()){
		return "Inserted successfully";
	}else{
		return "Error in Inserting";
	}
}
// PHP show updating car name
if(isset($_GET['do']) && $_GET['do'] == 'showUpdatedName'){
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$stmt = $db->prepare("select * from cars where id = {$id}");
		if($stmt->execute()){
			$car_name = $stmt->fetch();
			echo "<div class='form-group'>";
			echo "<input type='text' class='form-control name_update' name='name_update' value='". $car_name['name'] . "'>";
			echo "</div>";
			echo "<button rel='{$car_name['id']}' class='btn btn-primary btn-sm save-update'>Update</button>";
		}else{
			echo " Something went wrong";
		}

	}
}
//updaing car name
if(isset($_GET['do']) && $_GET['do'] == 'update'){
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$stmt = $db->prepare("update cars set name='{$name}' where id = {$id}");
		if($stmt->execute()){
			return "updated successfully";
		}else{
			return "Error in updating";
		}
	}
}
// PHP deleting car
if(isset($_GET['do']) && $_GET['do'] == 'delete'){
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$stmt = $db->prepare("delete from cars where id = {$id}");
		if($stmt->execute()){
			return "Deleted successfully";
		}else{
			return "Error in Deleting";
		}
	}
}
?>

<script>
// JS show updating car name
	$(".update_car").on("click", function() {
		
		var id = $(this).attr('rel');
		// console.log(id);
		$.ajax({
			url: 'function.php?do=showUpdatedName',
			type: 'post',
			data: {id:id},
		}).done(function(data){
			$(".updating").html(data);
		}).fail(function(){
			alert("error");
		});
	});

// updating car name
	$(".save-update").on("click",function(){
		var id = $(this).attr('rel');
		var name = $(".name_update").val();
		// console.log(id);
		$.ajax({
			url: 'function.php?do=update',
			type: 'post',
			data: {id:id,name:name},
		}).fail(function(){
			alert("error");
		});
	});

// JS deleting car	
	$(".delete_car").on("click",function(){
		if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
		var id = $(this).attr('rel');
		$.ajax({
			url :'function.php?do=delete',
			type:'post',
			data:{id: id},
		});
		// $(this).append("<button>alaa</button>");
	});
	// $('.confirm').click(function (e) {
	// 	if(!confirm('Are you sure?')){
    //         e.preventDefault();
    //         return false;
    //     }
    //     return true;
	// });
	// $('.confirm').click(function() {
    //     return confirm('Are u sure ?!');
    // });
</script> 