<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$url = 'https://jsonplaceholder.typicode.com/users/';
$obj = json_decode(file_get_contents($url), TRUE);

foreach($obj as $key => $value) 
{
	$array[] = $obj[$key]['name'];
}

?>
<?php
$message ='';
$error ='';
if(isset($_POST["submit"])){
	if (empty($_POST["name"])){
		$error = "<label class='text-danger'>Enter name</label>";
		
	}
	else if(empty($_POST["body"]))  
      {  
           $error = "<label class='text-danger'>Enter body</label>";  
      }
	  else if(empty($_POST["tl"]))  
      {  
           $error = "<label class='text-danger'>Enter Title</label>";  
      }  else{
		if(file_exists('post.json')){
			

			$current_data = file_get_contents('post.json');
			$array_data = json_decode($current_data , TRUE);
			$extral = array(				
				'title'=>$_POST['tl'],
				'body'=>$_POST['body'],
				'Userid'=>array_search($_POST['name'], $array)+1,
			);
			
			
			
			$array_data[] = $extral;
			$final_data = json_encode($array_data);
			if(file_put_contents('post.json',$final_data)){
				$message ="<label class='text-danger'>Added Successfully</label>";
			}

		}else{
			$error='JSON not Exist';
		}
	}
}


 
?>

<!DOCTYPE html>  
 <html>  
      <head>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">Internship Assignment </h3><br />          
                <form method="post">  
                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>  
                     <br />  
                     <label>Name</label>  
					 <select name="name" class="form-select">
      					<option disabled selected value >Choose one</option>
      					<?php
      					// A sample product array
      					$products = $array;

      					// Iterating through the product array
      					foreach($products as $item){
      					    echo "<option value='$item'>$item</option>";
      					}
      					?>
    						</select>             <br>     
					<label>Title</label>  
                     <input type="text" name="tl" class="form-control" /><br />  
                     <label>Body</label>  
                     <input type="text" name="body" class="form-control" /><br />  
                     <input type="submit" name="submit" value="Add Data" class="btn btn-info" /><br />  
					 <br>
					 <h6>BY ADITYA MANKAR</h6>                         
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>  