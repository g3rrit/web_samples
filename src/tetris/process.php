<?php
   	
   $myFile = "/home/gproessl/public_html/data.json";
   $arr_data = array(); // create empty array

  try
  {
	   //Get form data
	   $formdata = array(
	      'name'=> $_POST['name'],
	      'score'=> $_POST['score'],
	      'lvl'=>$_POST['lvl'],
              'pw'=>$_POST['pw']
	   );

	   //Get data from existing json file
	   $jsondata = file_get_contents($myFile);

	   // converts json data into array
	   $arr_data = json_decode($jsondata, true);

           $new_array = array();

           
           foreach($arr_data as $user) {
             if($user['pw'] == $formdata['pw']) {
                            echo 'Success';
               array_push($new_array, (object) array('name' => $formdata['name'], 'pw' => $formdata['pw'], 'score' => $formdata['score'], 'lvl' => $formdata['lvl']));
             } else {
               array_push($new_array, $user);
             }
           }

           //Convert updated array to JSON
	   $jsondata = json_encode($new_array);
	   
	   //write json data into data.json file
	   if(file_put_contents($myFile, $jsondata)) {
	    }
	   else 
	        echo "error";

   }
   catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
   }

?>
