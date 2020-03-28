<?php include('layout/AdminLayout/Header.php'); ?>

<!--Grid row-->
<div class="row mb-4 wow fadeIn">
    <?php
    $found = 0;
    $query = "SELECT * FROM blogs";
    $data = mysqli_query($con, $query);
    $blogs = mysqli_fetch_all($data, MYSQLI_ASSOC);

    foreach ($blogs as $blog) :
    ?>

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">

            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view overlay">
                    <img src="<?php echo $blog['image']; ?>" class="card-img-top" alt="" height="200">
                    <a href="#" target="_blank">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title"><?php echo $blog['title']; ?> </h4>
                    <hr>
                    <!--Text-->
                    <p class="card-text"><?php echo $blog['description']; ?></p>
                    <a class="btn btn-primary btn-sm btn-md" href="updateblog.php?id=<?php echo $blog['id']; ?>">Update <i class="far fa-edit"></i></a>
                    <a class="btn btn-danger  btn-sm btn-md" href="deleteblog.php?id=<?php echo $blog['id']; ?>">Delete <i class="far fa-trash-alt"></i></a>
                </div>
            </div>
            <!--/.Card-->
        </div>
        <!--Grid column-->
    <?php
        $found = 1;
    endforeach;
    if ($found == 0) {
        echo "No Blog found..";
    }
    ?>

</div>
<!--Grid row-->

<?php include('layout/AdminLayout/Footer.php'); ?>