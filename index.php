<html>
  <head>
    <meta charset="utf-8">
    <title>Joe's Home made Pies</title>
    <link rel="stylesheet" type="text/css" href="orderform.css" />
    
  </head>

  <body>
    <h1>PHP CRUD Order Form</h1>
    <?php require_once("processform.php");?>
    <?php
     $mysqli = new mysqli('localhost', 'root','Lynsalt1976!','joeorders') or die(mysqli_error($mysqli));
     $result = $mysqli->query("SELECT * FROM data")or die($mysqli->error);
    ?>
    <div class="row justify-content-center">
      <?php
        if(isset($_SESSION['message'])):?>
          <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
            <?php
              echo $_SESSION['message'];
              unset($_SESSION['message']);
            ?>
          </div>
        <?php endif;?>
      
      <div class="container">
      <table class="table" cellpadding="10" cellspacing="10">
        <thead>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Pumkin Pie</th>
              <th>Apple Pie</th>
              <th>Telephone</th>
              <th>Pick up time</th>
              <th>Sub total</th>
              <th>Tax</th> 
              <th>Total</th>
              <th colspan="2">Action</th>   
          </tr>
        </thead>
        <?php
           while($row = $result->fetch_assoc()):?>
              <tr>
                  <td><?php echo $row['firstname'];?></td>
                  <td><?php echo $row['lastname'];?></td>
                  <td><?php echo $row['pumkinpie'];?></td>
                  <td><?php echo $row['applepie'];?></td>
                  <td><?php echo $row['telephone'];?></td>
                   <td><?php echo $row['pickupminutes'];?></td>
                  <td><?php echo $row['subtotal'];?></td>
                  <td><?php echo $row['tax'];?></td>
                  <td><?php echo $row['total'];?></td>
                  <td>
                    <a href="index.php?edit=<?php echo $row['id'];?>" class="btn-brown" onchange="updateOrder();"">Edit</a>
                    <a href="processform.php?delete=<?php echo $row['id'];?>" class="btn-danger">Delete</a>
                  </td>
              </tr>
        <?php endwhile; ?>
      </table>
    </div>
    </div>
    <div id="frame">
      <div id="headingContainer">
        <div class="heading">Joe's Homemade Pies</div>
        <div class="subheading">All Pies $1.50 each, Pumkin or Apple!</div>
      </div>
      <div id="left">
        <img src="baker.png" alt="Just-In-Time Donuts" />
      </div>
      <form name="orderform" id="orderform" action="processform.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="field">
          First Name: <input type="text" id="fname" name="fname" value="<?php echo $firstname; ?>" onkeyup="lettersOnly(this)" required/>
        </div>
         <div class="field">
          Last Name: <input type="text" id="lname" name="lname" value="<?php echo $lastname; ?>" onkeyup="lettersOnly(this)"/>
        </div>
        <div class="field">
        # of Pumkin Pies: <input type="text" id="pumkinpie" name="pumkinpie" value="<?php echo $pumkinpie; ?>" onchange="updateOrder();" onkeyup="numbersOnly(this);" required required/>
        </div>
        <div class="field">
        # of Apple Pies: <input type="text" id="applepie" name="applepie" value="<?php echo $applepie; ?>" onchange="updateOrder();" onkeyup="numbersOnly(this);" required/>
        </div>
        <div class="field">
         Telephone No: <input type="Tel" id="telephone" name="telephone" value="<?php echo $telephone; ?>" maxlength="12" onkeyup="telephoneCheck(this)" required/>
        </div>
        <div class="field">
        Minutes till pickup: <input type="number" id="pickupminutes" value="<?php echo $pickupminutes; ?>"  required name="pickupminutes" min="20" onkeyup="numbersOnly(this);" placeholder ="20 mins minimum"/>
        </div>
        
        <div class="field">
        Subtotal: <input type="text" id="subtotal" name="subtotal" value="<?php echo $subtotal; ?>" readonly="readonly" />
        </div>
        <div class="field">
        Tax: <input type="text" id="tax" name="tax" value="<?php echo $tax; ?>" readonly="readonly"/>
        </div>
        <div class="field">
        Total: <input type="text" id="total" name="total" value="<?php echo $total; ?>" readonly="readonly" />
        </div>
        <div class="field">
          <?php
          if($update ==true):?>
            <input type="submit" value="Update" name="update" onclick="return placeOrder(this.form);" />
            <input type="reset" value="Clear" id="reset" class="hideReset"/>
          <?php else:?> 
        <input type="submit" value="Place Order" name="save" onclick="return placeOrder(this.form);" />
        <input type="reset" value="Clear" id="reset"/>
      <?php endif;?>
        
        </div>
      </form>

    </div> 
    <p><span id="the-date"></span> <a href="https://www.orangefoxmedia.com/" target="_blank">orangefoxmedia.com</a></p>
    <script src="js/validate.js"></script>
  </body>
</html>
