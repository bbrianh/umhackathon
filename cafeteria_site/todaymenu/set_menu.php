<!DOCTYPE html>
<html lang="en">
<head>
  <title>Menu setting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Menu of today</h2>         
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
		<th>id</th>
        <th>Picture</th>
        <th>Name</th>
        <th>Ingredients</th>
      </tr>
    </thead>
    <tbody id="tb">
      <!--<tr>
        <td><button type="button" class="btn btn-link">link</button></td>
        <td>Doe</td>
        <td>some strange stuff</td>
      </tr>
	  
	  <tr>
		<td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal'>add<td>
		<td></td>
	  </tr>
	  -->
    </tbody>
  </table>
    
    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add on menu</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<form action="uploadmenu.php" method="POST" enctype="multipart/form-data">
				<input type="file" name="fileToUpload">
				<br>
				<br>
				
					<div class="form-group">
					<label for="text">Name:</label>
					<input type="text" class="form-control" name="name">
					</div>
					
					<div class="form-group">
					<label for="text">Ingredients:</label>
					<input type="text" class="form-control" name="ingredient">
					</div>
				
				<button type="submit" class="btn btn-primary" onclick="refresh()">Submit</button>
			</form>
		
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="refresh()">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
  
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
	function refresh(){
		location.reload();
	}
	
	$(document).ready(function(){
		$.ajax({
				url: 'getmenu.php',
				type: 'GET',
			}).done(function(response){
				console.log("data get");
				var menu = response;
				var table = document.getElementById("tb");
				table.innerHTML = "";
				
				console.log(menu);
				
				var tbcontent = "";
				if (menu!=null){
					for (var i=0; i < menu.length; i++){
						tbcontent += "<tr>";
						//<a href='#' class='btn btn-link' role='button'>Link Button</a>
						path="http://localhost/umhackathon/todaymenu/"+menu[i]["photo"];
						var id=i+1;
						tbcontent += "<td>"+id+"</td>";
						tbcontent += "<td><a href="+path+" class='btn btn-link' role='button'>" + menu[i]["photo"] + "</a></td>";
						tbcontent += "<td>"+menu[i]["name"]+"</td>";
						tbcontent += "<td>"+menu[i]["ingredient"]+"</td>";
						tbcontent += "</tr>";	
				}
				}
				
				table.innerHTML += tbcontent;
				
				var buttons = "<tr><td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal'>add</button>"
				
				
				table.innerHTML += buttons;
				
				
				
				});
	});
			
	
	
	
	
		
  </script>
  
  
  </body>
</html>