<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Reports Page";
$current = "report";
include(SHARED_PATH . '/public_header.php');


?>

 <section id="boxes">
      <div class="container">
          

         <br>
         <h2>Report Page</h2>


<?php
       // query 1

        $sql = "SELECT paymentAmount FROM contract WHERE month(paymentDate) = 03;";

        $amount = Contract::find_by_sql($sql);

        foreach ($amount as $amt)
          {$total = $amt->paymentAmount;
            $math += $total;}

        echo "<p>1. How much $$$ did we spend this month on Blog Advertising? " . $math . "</p>";


       
       // query 2

        $sql = "SELECT blogName FROM blog WHERE blogid NOT IN (SELECT blogid FROM contract) ORDER BY qualityScore DESC LIMIT 1";

          $quality = Blog::find_by_sql($sql);

           foreach($quality as $qual) 
          
           echo $qual->blogName;


          echo "<p>2. Who is our next biggest potential blogger to contact?" ;

         

          
       
       // query 3

       //$sql = "SELECT blogName
               // FROM blogid WHERE blogid IN (SELECT blogid FROM contract
               // WHERE endContract > CURRENT_DATE)
               // GROUP BY blogName;";

      //$expired = Blog::find_by_sql($sql);

       //echo "<p>3. Who is out of contract that needs to get paid? ";

         //foreach($expired as $exp)

        //{ echo $exp->blogName; }

          //echo "</p>";
                 
        
?>

      </div>
   </section>


<?php


include(SHARED_PATH . '/public_footer.php');
?>
