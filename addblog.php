<?php include('layout/AdminLayout/Header.php'); ?>


<div class="row">
    <div class="col-3"></div>

    <div class="col-sm-6">
        <form action="" enctype="multipart/form-data" class="text-center border border-light p-5" method="post">

            <p class="h4 mb-4">Create New Blog</p>

            <!-- Name -->
            <input type="text" class="form-control mb-4" name="title" placeholder="Blog Title" required>

            <div class="form-group">
                <textarea class="form-control" id="textarea" name="description" placeholder="Blog Description" rows="7" required></textarea>
                <span asp-validation-for="description" class="text-danger"></span>
            </div>

            <div class="form-group col-12">
                <label class="custom-file-label">Choose Image...</label>
                <input name="image" type="file" class="custom-file-input" onchange="readURL(this);" required>
            </div>
            <div class="form-group col-4">
                <img id="image" width="100" src="">
            </div>

            <!-- Sign up button -->
            <button class="btn btn-info my-4 btn-block" type="submit">Add Blog</button>

            <?php
            if (isset($_POST['title'])) {
                $title = trim($_POST['title']);
                $description = trim($_POST['description']);
                $create_date = date('Y-m-d');
                $image = "";
                if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
                    $filename = $_FILES["image"]["name"];
                    $filetype = $_FILES["image"]["type"];
                    $filesize = $_FILES["image"]["size"];

                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!array_key_exists($ext, $allowed)) die("<div class='alert alert-danger'>Please select a valid file format.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

                    $maxsize = 5 * 1024 * 1024;
                    if ($filesize > $maxsize) die("<div class='alert alert-danger'>File size is larger than the allowed limit.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

                    if (in_array($filetype, $allowed)) {
                        if (file_exists("uploads/" . $filename)) {
                            echo "<div class='alert alert-danger'>Change file name first..<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        } else {
                            $filename = rand() . $filename;
                            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $filename);
                            $image = "uploads/" . $filename;
                        }
                    } else {
                        echo "<div class='alert alert-danger'>There was a problem uploading your image. Please try again.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Some technical Issue..<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                }

                $query = "INSERT INTO blogs (title,description,create_date,image) VALUES ('$title','$description','$create_date','$image')";

                if (mysqli_query($con, $query)) {
                    echo "<div class='alert alert-success'>Blog created succesfully.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                } else {
                    echo "<div class='alert alert-danger'>Some Error occure..<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                }
            }
            ?>

        </form>
    </div>

    <div class="col-3"></div>
</div>
<?php include('layout/AdminLayout/Footer.php'); ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image')
                    .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>