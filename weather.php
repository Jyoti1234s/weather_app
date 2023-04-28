

<?php
     
    $weather = "";
    $error = "";
if (array_key_exists('city',$_GET)) {
  if (!$_GET['city']) {
    $error="sorry ,your input is empty";
  }

   if ($_GET['city']) {
    $apiData=file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=993ebf7db2e9eee0c979fecbe6398780");
       
          $weatherArray = json_decode($apiData, true);
         
          // foreach($weatherArray['list']as $day=>$value){
          //   echo "max temp for day ".$day."will be".$value[temp][max]."<br>";

 if ($weatherArray['cod'] == 200) {
             //c=k-273.15
          
          $tempCelsius =$weatherArray['main']['temp']-273;

           $weather ="<b>".$weatherArray['name'].",".$weatherArray['sys']['country'].":".intval($tempCelsius)."&deg;C</b> <br>";
         $weather .="<b>weather condition:</b>".$weatherArray['weather']['0']['description']."<br>";
          $weather .="<b>weather temp_min:</b>".$weatherArray['main']['temp_min']."<br>";
          $weather .="<b>weather temp_max:</b>".$weatherArray['main']['temp_max']."<br>";
   $weather .="<b>Atmosphere pressure:</b>".$weatherArray['main']['pressure']."hPa<br>";
     $weather .="<b>Wind Speed:</b>".$weatherArray['wind']['speed']."meter/sec<br>";
         $weather .="<b>cloudness</b>".$weatherArray['clouds']['all']."%<br>";

         date_default_timezone_set("Asia/Calcutta");
         $sunrise=$weatherArray['sys']['sunrise'];
         $sunset=$weatherArray['sys']['sunset'];
         $weather.="<b>sunrise:</b>".date("g:i a",$sunrise)."<br>";
         $weather.="<b>Current Time:</b>".date("F j,y,l g:i a")."<br>";
               $weather.="<b>sunset:</b>".date("g:i a",$sunset)."<br>";
           }

           else
           {
            $error="could not  be process";
           }
         


          
          
   }
 }
 
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
 
  <title>Weather App</title>
  <style type="text/css">
  html { 
          background: url() no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
         
          body {
               
              background: none;
               
          }
           
       .container {
    border: 1px solid blue;
    margin-top: 20px;
    padding: 20px;
}
           
          input {
               
              margin: 20px 0;
               
          }
           
        
          #weather {
    border: 1px solid blue;
    padding: 20px;
    text-align: center;
         margin-top:15px;

}

</style>

</head>
<body>
    <div class="container">
       
        
           
           <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
           
          <form action="" method="GET">
  <fieldset class="form-group">
   
   <p> <input type="text" class="form-control" name="city" id="city" placeholder="Search FOR location" ></p>
  </fieldset>
   
 
</form>
</div>


<div class="col-lg-4 col-md-4">
   <div id="weather"><?php
               
              if ($weather) {
                   
                  echo     $weather="<b>Current Time:</b>".date("F j,y,l g:i a")."<br>";
                   
              } if ($error) {
                   
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                   
              }
               
              ?></div>
</div>
<div class="col-lg-4 col-md-4">
   <div id="weather"><?php
               
              if ($weather) {
                   
                  echo    $weather ="<b> temprature ".intval($tempCelsius)."&deg;C</b> <br>";
                   
              } if ($error) {
                   
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                   
              }
               
              ?></div><br>


 <div id="weather"><?php
               
              if ($weather) {
                   
                  echo   $weather ="<b>Low:</b>".$weatherArray['main']['temp_min']."<br>".
          $weather ="<b>High:</b>".$weatherArray['main']['temp_max']."<br>". $weather ="<b>cloudness</b>".$weatherArray['clouds']['all']."%<br>".$weather="<b>sunset:</b>".date("g:i a",$sunset)."<br>".  $weather="<b>sunrise:</b>".date("g:i a",$sunrise)."<br>". $weather ="<b>weather condition:</b>".$weatherArray['weather']['0']['description']."<br>".$weather ="<b>Atmosphere pressure:</b>".$weatherArray['main']['pressure']."hPa<br>";
                   
              } if ($error) {
                   
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                   
              }
               
              ?></div>

</div>
<div class="col-lg-4 col-md-4">
   <div id="weather"><?php
               
              if ($weather) {
                   
                  echo  $weather ="<b>".$weatherArray['name'].",".$weatherArray['sys']['country']." <br>";
                   
              } if ($error) {
                   
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                   
              }
               
              ?></div>
</div>
       
       


       <div class="col-lg-12">
        <?php for ($i=0; $i <7 ; $i++) { ?>
        <div class="col-lg-2">


          <br><br>


          <?php
               
              if ($weather) {
                   
                  echo  date('D',strtotime("$i day"))."<br>". $weather ="<b> temprature ".intval($tempCelsius)."&deg;C</b> <br>";
              } if ($error) {
                   
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                   
              }
               
              ?>
         <?php
        
           
          ?>

          </div>
         <?php }?>

       </div>

      </div>
 
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>