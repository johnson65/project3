<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Delete Page";
include(SHARED_PATH . '/public_header.php');

// if form has been submitted get variables and calculate numbers then
// set them to the array.
$userid = $_GET['userid'];

// find the user info based on passed userID
$user = User::find_by_id($userid);

// set new variables to
$userName = $user->userName;

if(is_post_request()) {
    //get userid from form
    $userid = $_POST['userid'];

    //send array back to construct
    $args = [];
    $args['userid'] = $userid;

    //instantiate and call delete function.
    $users = new User($args);
    $users->delete($userid);

    //after saving redirect back to home page.
    header('Location: index.php');

}

?>

 <section id="boxes">
      <div class="container">
          <form action="delete.php" method="post">
            <fieldset>
              <legend>Are you sure you want to delete <?php echo $userName; ?>'s user?</legend>
              <input name="userid" type="hidden" value="<?php echo $userid;?>">
              <button type="submit" value="Submit">Yes, Please Delete</button>
              <button type="button" onclick="location='index.php'">No, Don't Delete</button>
            </fieldset>
          </form>

         <br>
      </div>
   </section>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
