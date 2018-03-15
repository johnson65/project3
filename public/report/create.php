<?php
require_once("../private/initialize.php");
require_login();
$page_title = "Create Page";
include(SHARED_PATH . '/public_header.php');

// if form has been submitted get variables and calculate numbers then
// set them to the array.

if(is_post_request()) {
    // get post variables
    $userName = $_POST['name'];
    $wage = $_POST['wage'];
    $withholdings = $_POST['withholdings'];

    // 1. calculate $taxableIncome
    $taxableIncome = $wage - 10400;

    // 2. call your static function here calculate taxes based on taxableIncome
    $taxes = Tax::taxation($taxableIncome);

    // 3. calculate owed money or return
    if($withholdings > $taxes) {
      $owe = 0;
      $refund = $withholdings - $taxes;
    } else {
      $owe = $taxes - $withholdings;
      $refund = 0;
    }


    //create an array called args to be used with __construct
    $args = [];
    $args['userName'] = $userName;
    $args['totalWages'] = $wage;
    $args['taxableIncome'] = $taxableIncome;
    $args['withholdings'] = $withholdings;
    $args['taxes'] = $taxes;
    $args['owe'] = $owe;
    $args['refund'] = $refund;

    //instantiate a new object and use the save function to create.
    $tax = new Tax($args);
    $tax->save();

}

?>

 <section id="boxes">
      <div class="container">
          <form action="index.php" method="post">
            <fieldset>
              <legend>Tax Calculators</legend>
              <p>Name: <input type="text" name="name"></p>
              <p>Wages: <input type="text" name="wage"></p>
              <p>Federal Tax Withheld: <input type="text" name="withholdings"></p>
              <button type="submit" value="Submit">Submit</button>
              <button type="reset" value="Reset">Reset</button>
            </fieldset>
          </form>

         <br>
         <h2>Simple Tax Return Data</h2>

         <table>
            <tr>
              <th>User Name</th>
              <th>Total Wages</th>
              <th>Taxable Income</th>
              <th>Federal Withholdings</th>
              <th>Taxes</th>
              <th>Taxes Owed</th>
              <th>Refund Amount</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>


<?php

      //$taxs = Tax::find_all();
      //echo var_dump($taxs);
      foreach($taxs as $tax)
      {
      echo "<tr><td>" .  $tax->userName . "</td>";
      echo "<td>" .  $tax->totalWages . "</td>";
      echo "<td>" .  $tax->taxableIncome . "</td>";
      echo "<td>" .  $tax->withholdings . "</td>";
      echo "<td>" .  $tax->taxes . "</td>";
      echo "<td class='owe'>" .  $tax->owe . "</td>";
      echo "<td class='refund'>" .  $tax->refund . "</td>";
      echo "<td><a href='update.php?userID=" . $tax->userID . "'>Update</a></td>";
      echo "<td><a href='delete.php?userID=" . $tax->userID . "'>Delete</a></td></tr>";
      }

?>
      </table>
      </div>
   </section>
<?php


include(SHARED_PATH . '/public_footer.php');
?>
