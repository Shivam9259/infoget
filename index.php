<?php include('layout/HomeLayout/Header.php'); ?>

<!--Section: Jumbotron-->
<section class="card blue-gradient wow fadeIn">

  <!-- Content -->
  <div class="card-body text-white text-center py-5 px-5 my-5">

    <h1 class="mb-4">
      <strong>Infoget App</strong>
    </h1>
    <p>
      <strong>Here you will get information about new things.</strong>
    </p>
    <p class="mb-4">
      <strong>Our sole purpose is to help you find compelling ideas, knowledge, and perspectives. We don’t serve ads—we serve you, the curious reader who loves to learn new things. Infoget is home to thousands of information and we combine humans and technology to find the best reading for you—and filter out the rest.</strong>
    </p>
    <a href="blogs.php" class="btn btn-outline-white btn-lg">All Blogs
      <i class="fas fa-book-medical ml-2"></i>
    </a>

  </div>
  <!-- Content -->
</section>
<!--Section: Jumbotron-->
<hr class="my-4">

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
        <p class="grey-text"><?php echo substr($blog['description'], 0, 150); ?></p>
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

  <!--Pagination-->
  <nav class="d-flex justify-content-center wow fadeIn">
    <ul class="pagination pg-blue">
      <li class="page-item">
        <a class="page-link" href="blogs.php">View All Blogs ...</a>
      </li>
    </ul>
  </nav>
  <!--Pagination-->

</section>
<!--Section: Cards-->

<?php include('layout/HomeLayout/Footer.php'); ?>