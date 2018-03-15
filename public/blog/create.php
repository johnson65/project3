<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Create Blog Page";
$current = "blog";
include(SHARED_PATH . '/public_header.php');

// if form has been submitted get variables and calculate numbers then
// set them to the array.

if(is_post_request()) {
    // get post variables
    $blogName = $_POST['blogName'];
    $url = $_POST['url'];
    $email = $_POST['email'];
    $contractFName = $_POST['contractFName'];
    $contractLName = $_POST['contractLName'];
    $mozDA = $_POST['mozDA'];
    $sponsors = $_POST['sponsors'];
    $fqshop = $_POST['fqshop'];
    $gfairy = $_POST['gfairy'];
    $mstar = $_POST['mstar'];
    
    $qualityScore = Blog::qualityScore($mozDA, $sponsors, $fqshop, $gfairy, $mstar);


    //create an array called args to be used with __construct
    $args = [];
    $args['blogName'] = $blogName;
    $args['url'] = $url;
    $args['email'] = $email;
    $args['contractFName'] = $contractFName;
    $args['contractLName'] = $contractLName;
    $args['mozDA'] = $mozDA;
    $args['sponsors'] = $sponsors;
    $args['fqshop'] = $fqshop;
    $args['gfairy'] = $gfairy;
    $args['mstar'] = $mstar;
    $args['qualityScore'] = $qualityScore;


    //new object
    $blog = new Blog($args);
    $blog->create();

    header('Location: index.php');

}

?>

 <section id="boxes">
      <div class="container">
          <form action="create.php" method="post">
            <fieldset>
              <legend>Add a Blog</legend>
              <p>Blog Name: <input type="text" name="blogName"></p>
              <p>URL: <input type="text" name="url"></p>
              <p>Email: <input type="text" name="email"></p>
              <p>Contact First Name: <input type="text" name="contractFName"></p>
              <p>Contract Last Name: <input type="text" name="contractLName"></p>
              <br><br><strong>Quality Score Calcluation</strong>
              <p>MOZ Domain Authority: <input type="number" name="mozDA" min="1" max="100"></p>
              <p>Number of Sponsors: <input type="number" name="sponsors" min="1" max="25"></p>
              <p>Fat Quarter Shop: <input type="checkbox" name="fqshop" value="1"></p>
              <p>Green Fairy Shop: <input type="checkbox" name="gfairy" value="1"></p>
              <p>Missouri Star Shop: <input type="checkbox" name="mstar" value="1"></p>
               <button type="submit" value="Submit">Submit</button>
              <button type="reset" value="Reset">Reset</button>
            </fieldset>
          </form>



