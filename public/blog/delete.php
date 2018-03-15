<?php
require_once("../../private/initialize.php");
reqire_login();
$page_title = "Delete Blog";
include(SHARED_PATH . '/public_header.php');

// if form has been submitted get variables and calculate numbers then
// set them to the array.
$blogid = $_GET['blogid'];

// find the user info based on passed userID
$blog = Blog::find_by_id($blogid);

// set new variables to
$blogName = $blog->blogName;

if(is_post_request()) {
    //get userid from form
    $blogid = $_POST['blogid'];

    //send array back to construct
    $args = [];
    $args['blogid'] = $blogid;

    //instantiate and call delete function.
    $blogs = new Blog($args);
    $blogs->delete(blogid);

    //after saving redirect back to home page.
    header('Location: index.php');

}

?>

 <section id="boxes">
      <div class="container">
          <form action="delete.php" method="post">
            <fieldset>
              <legend>Are you sure you want to delete <?php echo $blogName; ?>these blogs?</legend>
              <input name="blogid" type="hidden" value="<?php echo $blogid;?>">
              <button type="submit" value="Submit">Yes, Please Delete</button>
              <button type="button" onclick="location='index.php'">No, Don't Delete</button>
            </fieldset>
          </form>

         <br>
      </div>
   </section>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
