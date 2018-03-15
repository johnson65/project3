<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Update Blog";
include(SHARED_PATH . '/public_header.php');

//get the persons id - userID
$blogid = $_GET['blogid'] ?? false;

// find the user info based on passed userID
$blog = Blog::find_by_id($blogid);

// set new variables to
$blogName = $blog->blogName;
$url = $blog->url;
$email = $blog->email;
$contractFName = $blog->contractFName;
$contractLName = $blog->contractLName;
$qualityScore = $blog->qualityScore;
$mozDA = $blog->mozDA;
$sponsors = $blog->sponsors;
$fqshop = $blog->fqshop;
$gfairy = $blog->gfairy;
$mstar = $blog->mstar;

if($fqshop == 0) {
  $fq = "unchecked";
}else {
  $fq = "checked";
}

if($gfairy == 0) {
  $gf = "unchecked";
}else {
  $gf = "checked";
}

if($mstar == 0) {
  $ms = "unchecked";
}else {
  $ms = "checked";
}

if(is_post_request()) {
    // get post variables
  $blogid = $_POST['blogid'];
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
    $blog->merge_attributes($args);
    $blog->update($blogid);
    
   header('Location: index.php');

}

?>

 <section id="boxes">
      <div class="container">
          <form action="update.php" method="post">
            <fieldset>
              <legend>Update Blog Information</legend>
              <input name="blogid" type="hidden" value="<?php echo $blogid;?>">
              <p>Blog Name: <input type="text" name="blogName"  size="40" value="<?php echo $blogName;?>"></p>
              <p>URL: <input type="text" name="url" size="40" value="<?php echo $url;?>"></p>
              <p>Email: <input type="text" name="email"size="40" value="<?php echo $email?>"></p>
              <p>Contact First Name: <input type="text" name="contractFName" size="40" value="<?php echo $contractFName;?>"></p>
              <p>Contract Last Name: <input type="text" name="contractLName" value="<?php echo $contractLName;?>"></p>
              <p>Quality Score: <input readonly type="number" name="qualityScore" value="<?php echo $qualityScore;?>"></p>
              
              <p>Moz Domain Authority: <input type="text" name="mozDA" value="<?php echo $mozDA;?>"></p>
              
              <p># of Sponsors: <input type="number" name="sponsors" value="<?php echo $sponsors;?>"></p>
              
              <input type="hidden" name="fqshop" value=0>
              <p>Fat Quarter Shop: <input type="checkbox" name="fqshop" value="1" <?php echo "$fq"?>></p>

              <input type="hidden" name="gfairy" value=0>
              <p>Green Fairy Shop: <input type="checkbox" name="gfairy" value="1" <?php echo "$gf"?>></p>
              
              <input type="hidden" name="mstar" value=0>
              <p>Missouri Star Shop: <input type="checkbox" name="mstar" value="1" <?php echo "$ms"?>></p>
              
               <button type="submit" value="Submit">Update</button>
              <button type="button" onclick="location='index.php'">Cancel Update</button>
            </fieldset>
          </form>

<?php


include(SHARED_PATH . '/public_footer.php');
?>
