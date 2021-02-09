<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dynamic Dependent Drop down in PHP using jQuery AJAX - XpertPhp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Dynamic Dependent Drop down in PHP using jQuery AJAX</h2>
    <div class="form-group">
      <label for="country">Country:</label>
	  <?php 
			include_once 'config.php'; 
			$query = "SELECT * FROM countries ORDER BY name ASC"; 
			$result = mysqli_query($conn,$query);
		?>
	  <select id="country" name="category_id" class="form-control">
        <option value="" selected disabled>Select Country</option>
         <?php while($row = mysqli_fetch_array($result)){  ?>
         <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
         <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="state">State:</label>
      <select name="state" id="state" class="form-control"></select>
    </div>
	<div class="form-group">
      <label for="city">City:</label>
      <select name="city" id="city" class="form-control"></select>
    </div>
</div>
<script type=text/javascript>
  $('#country').change(function(){
  var countryID = $(this).val();  
  if(countryID){
    $.ajax({
      type:"GET",
      url:"getData.php",
	  data:'country_id='+countryID,
      success:function(res){       
			if(res){
				$("#state").empty();
				$("#state").append('<option>Select State</option>');
				var dataObj = jQuery.parseJSON(res);
				if(dataObj){
					$(dataObj).each(function(){
						$("#state").append('<option value="'+this.id+'">'+this.name+'</option>');
					});
				}else{
					$("#state").empty();
				}
			}else{
				$("#state").empty();
			}
        }
    });
  }else{
    $("#state").empty();
    $("#city").empty();
  }   
  });
  $('#state').on('change',function(){
  var stateID = $(this).val();  
  if(stateID){
    $.ajax({
      type:"GET",
	  url:"getData.php",
	  data:'state_id='+stateID,
      success:function(res){        
			if(res){
				$("#city").empty();
				$("#city").append('<option>Select City</option>');
				var dataObj = jQuery.parseJSON(res);
				if(dataObj){
					$(dataObj).each(function(){
						$("#city").append('<option value="'+this.id+'">'+this.name+'</option>');
					});
				}else{
					$("#city").empty();
				}
			}else{
				$("#city").empty();
			}
      }
    });
  }else{
    $("#city").empty();
  }
  });
</script>
</body>
</html>