<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Contract Page";
$current = "contract";
include(SHARED_PATH . '/public_header.php');

// if form has been submitted get variables and calculate numbers then
// set them to the array.
$blogid = $_GET['blogid'] ?? false;


if(is_post_request()) {
    // get post variables
    $blogid = $_POST['blogid'];
    $paymentDate = $_POST['paymentDate'];
    $paymentAmount = $_POST['paymentAmount'];
    $contractLength = $_POST['contractLength'];
    $ednContract = $_post['ednContract'];


    //create an array called args to be used with __construct
    $args = [];
    $args['blogid'] = $blogid;
    $args['paymentDate'] = $paymentDate;
    $args['paymentAmount'] = $paymentAmount;
    $args['contractLength'] = $contractLength;
    $args['ednContract'] = $ednContract;

    //instantiate a new object and use the save function to create.
    $contract = new Contract($args);
    $contract->create();


    header("Location: index.php?blogid=$blogid");

}

?>

 <section id="boxes">
      <div class="container">
           <form action="create.php" method="post">
            <fieldset>
              <legend>Add a Contract</legend>
              <input name="blogid" type="hidden" value="<?php echo $blogid; ?>">
              <p>Payment Date: <input type="date" name="paymentDate"></p>
              <p>Payment Amount: <input type="text" name="paymentAmount"></p>
              <p>Length of Contract in Months: <input type="number" name="contractLength" min="1" max="36"></p>
              <button type="submit" value="Submit">Submit</button>
              <button type="reset" value="Reset">Reset</button>
            </fieldset>
          </form>
          
          </div>
        </section>


<?php

include(SHARED_PATH . '/public_footer.php');
?>
