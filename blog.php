<?php include('layout/HomeLayout/Header.php'); ?>

<?php
$id = $_GET['id'];
$found = 0;
$image = "";
$title = "";
$description = "";
$date = "";
$query = "SELECT * FROM blogs";

$data = mysqli_query($con, $query);
$blogs = mysqli_fetch_all($data, MYSQLI_ASSOC);
foreach ($blogs as $blog) {
  if ($blog['id'] == $id) {
    $image = $blog['image'];
    $title = $blog['title'];
    $description = $blog['description'];
    $create_date = date("d-m-Y", strtotime($blog['create_date']));;
    $found = 1;
  }
}
if ($found == 0) {
  header('Location:index.php');
}
?>
<!--Section: Post-->
<section class="mt-4">

  <!--Grid row-->
  <div class="row">


    <!--Grid column-->
    <div class="col-md-8 mb-4">

      <!--Featured Image-->
      <div class="card mb-4 wow fadeIn">

        <img src="<?php echo $image; ?>" class="img-fluid" alt="" height="800" width="1000">

      </div>
      <!--/.Featured Image-->

      <!--Card-->
      <div class="card mb-4 wow fadeIn">
        <!--Card content-->
        <div class="card-body">
          <p class="h4 my-4 text-center"><?php echo "$title"; ?></p>
          <hr>
          <p><?php echo $description; ?></p>
          <hr>
          <p class="text-right grey-text">By- Admin (<?php echo $create_date; ?>)</p>
        </div>
      </div>
      <!--/.Card-->


    </div>
    <!--Grid column-->
    <div class="col-md-4 mb-4">

      <!--Card-->
      <div class="card mb-4 wow fadeIn">

        <div class="card-header">Other Blogs</div>

        <!--Card content-->
        <div class="card-body">

          <ul class="list-unstyled">
            <?php
            $found = 0;
            $query = "SELECT * FROM blogs";
            $data = mysqli_query($con, $query);
            $blogs = mysqli_fetch_all($data, MYSQLI_ASSOC);

            foreach ($blogs as $blog) :
            ?>
              <li class="media">
                <img class="d-flex mr-3" src="<?php echo $blog['image']; ?>" alt="Generic placeholder image" width="100" height="90">
                <div class="media-body">
                  <a href="blog.php?id=<?php echo $blog['id']; ?>">
                    <h5 class="mt-0 mb-1 font-weight-bold"><?php echo $blog['title']; ?></h5>
                  </a>
                  <?php echo substr($blog['description'], 0, 30); ?> ...
                  <hr>
                </div>
              </li>
            <?php
              $found = 1;
            endforeach;
            if ($found == 0) {
              echo "No Blog found..";
            }
            ?>
          </ul>

        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

  </div>
  <!--Grid row-->

</section>

<?php include('layout/HomeLayout/Footer.php'); ?>