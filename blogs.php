<?php include('layout/HomeLayout/Header.php'); ?>


<!--Section: Cards-->
<section class="pt-5">
  <?php
  $found = 0;
  $query = "SELECT * FROM blogs";
  $data = mysqli_query($con, $query);
  $blogs = mysqli_fetch_all($data, MYSQLI_ASSOC);
  foreach ($blogs as $blog) :
  ?>
    <!--Grid row-->
    <div class="row wow fadeIn">

      <!--Grid column-->
      <div class="col-lg-5 col-xl-4 mb-4">
        <!--Featured image-->
        <div class="view overlay rounded z-depth-1">
          <img src="<?php echo $blog['image']; ?>" class="card-img-top" alt="">
          <a href="#">
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
        <h3 class="mb-3 font-weight-bold dark-grey-text">
          <strong><?php echo $blog['title']; ?></strong>
        </h3>
        <p class="grey-text"><?php echo $blog['description']; ?></p>
        <a href="blog.php?id=<?php echo $blog['id']; ?>" class="btn btn-primary btn-md">Read More ...</a>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
    <hr class="mb-5">
  <?php
    $found = 1;
  endforeach;
  if ($found == 0) {
    echo "No Blog found..";
  }
  ?>

</section>
<!--Section: Cards-->

<?php include('layout/HomeLayout/Footer.php'); ?>