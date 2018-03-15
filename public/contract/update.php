<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Update Page";
include(SHARED_PATH . '/public_header.php');

//get the persons id - userID
$contractid = $_GET['contractid'] ?? false;

// find the user info based on passed userID
$contract = Contract::find_by_id($contractid);

// set new variables to
$paymentDate = $contract->paymentDate;
$paymentAmount = $contract->paymentAmount;
$contractLength = $contract->contractLength;
$blogid = $contract->blogid;



if(is_post_request()) {
    // get post variables
 
    $blogid = $_POST['blogid'];
    $contractid = $_POST['contractid'];
    $paymentDate = $_POST['paymentDate'];
    $paymentAmount = $_POST['paymentAmount'];
    $contractLength = $_POST['contractLength'];

    //create an array called args to be used with __construct
    $args = [];
    $args['paymentDate'] = $paymentDate;
    $args['paymentAmount'] = $paymentAmount;
    $args['contractLength'] = $contractLength;
    $args['blogid'] = $blogid;



    //instantate 
    $contract = new Contract($args);
    $contract->merge_attributes($args);
    $contract->update($contractid);

    //after saving redirect back to home page.
    header('Location: index.php?blogid=$blogid');

}

?>

 <section id="boxes">
      <div class="container">
          <form action="update.php" method="post">
            <fieldset>
              <legend>Updated Information</legend>
              <input name="contractid" type="hidden" value="<?php echo $contractid;?>">
              <input name="blogid" type="hidden" value="<?php echo $blogid;?>">
              <p>Contract Date: <input type="date" name="paymentDate" value="<?php echo $paymentDate; ?>"></p>
              <p>Payment Amount: <input type="text" name="paymentAmount" value="<?php echo $paymentAmount; ?>"></p>
              <p>Contract Length in Months: <input type="number" name="contractLength" value="<?php echo $contractLength; ?>"></p>
              <button type="submit" value="Submit">Submit</button>
              <button type="button" onclick="location='index.php?blogid=<?php echo $blogid; ?>'">Cancel Update</button>
            </fieldset>
          </form>

<?php


include(SHARED_PATH . '/public_footer.php');
?>
