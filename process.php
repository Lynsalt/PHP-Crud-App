<html>
<head>
    <title>Joe's Home made Pies</title>
    <link rel="stylesheet" type="text/css" href="orderform.css" />
     <script src="js/validate.js"></script>
</head>
  <body>

    <div id="orderDetails">
    <?php
    date_default_timezone_set("America/New_York");
      $num = rand(1000, 10000);
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $minutes = $_POST['pickupminutes'];
      $total = $_POST['total'];
       echo'<div id="left">
        <img src="baker.png" alt="Joe\'s Home made Pies" />
      </div>';

      echo "<div id='headingContainer'><h1 class='heading'>Joe's Homemade Pies</h1></div>";
      echo "<div id='orderConfirmation'><h2>Order Confirmation</h2>";
      echo "<strong>Order #" . $num . "</strong><br />";
      echo "<p><strong>Date: </strong>".date('d-m-Y') ."<br>"."<strong>Time: </strong> " . date("h:i:sa")."</p>";
      echo "Customer name: " . $fname ." ".$lname. "<br />";
      echo "Ready in: " . $minutes . " minutes<br /><br />";
      echo "<strong>Total:</strong> <em>" . $total . "</em></div>";
    ?>
    
  </div>
  </body>
</html>
