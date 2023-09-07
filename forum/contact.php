<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <title>letsDiscuss Forum</title>
    
  </head>
  <body>
  <?php include 'partials/_dbconnect.php';?>
  <?php include 'partials/_header.php';?>
  
  <?php
    $insert = false;
    if(isset($_POST['name'])){
        include 'partials/_dbconnect.php';
 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $issue = $_POST['issue'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
   

    $sql= "INSERT INTO `contacts` (`name`, `email`, `phone`, `issue`, `address`, `city`, `state`, `zip`, `dt`) VALUES ('$name', '$email', '$phone', '$issue', '$address', '$city', '$state', '$zip', current_timestamp())";

    $result = mysqli_query($conn,$sql);
    if(!$result){
        echo "Error: ".mysqli_error($conn);
        exit;
    }
    if($result== true){
       $insert = true;
    }
    
    mysqli_close($conn);
    }
?>

<div class="container my-3">
<h1 class="text-center">Contact Us</h1>
<?php
        if($insert == true){
        echo "<p class='text-success text-center'>Thanks for submitting your form.</p>";
        }
        ?> 
<form method = "post" action = "contact.php">
  <div class="form-group">
    <label for="inputAddress">Name</label>
    <input name="name" type="text" class="form-control" id="inputAddress" placeholder="enter your full name" Required>
  </div> 

  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" Required>
  </div>
  
  <div class="form-group">
    <label for="inputAddress">Contact Number</label>
    <input name="phone" type="phone" class="form-control" minLength="10" maxLength="10" id="inputAddress" placeholder="1234 Main St">
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Mention your issue</label>
    <textarea name="issue" class="form-control" id="exampleFormControlTextarea1" rows="3" Required></textarea>
  </div>

  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input name="city" type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select name="state" id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>Andhra Pradesh</option>
        <option>Arunachal Pradesh</option>
        <option>Assam</option>
        <option>Bihar</option>
        <option>Chhattisgarh</option>
        <option>Goa</option>
        <option>Gujarat</option>
        <option>Haryana</option>
        <option>Himachal Pradesh</option>
        <option>Jammu and Kashmir</option>
        <option>Jharkhand</option>
        <option>Karnataka</option>
        <option>Kerala</option>
        <option>Madhya Pradesh</option>
        <option>Maharashtra</option>
        <option>Punjab</option>
        <option>Rajasthan</option>
        <option>Uttar Pradesh</option>
        <option>West Bengal</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input name="zip" type="number" class="form-control" id="inputZip">
    </div>
  </div>



  <button class="btn btn-success" name="submit">Submit</button>
</form>
</div>
  <?php include 'partials/_footer.php';?> 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>