<?php include('layout/AdminLayout/Header.php'); ?>

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
<div class="row">
    <div class="col-3"></div>

    <div class="col-sm-6">
        <form action="" enctype="multipart/form-data" class="text-center border border-light p-5" method="post">

            <p class="h4 mb-4">Update Blog</p>

            <!-- Name -->
            <input type="text" class="form-control mb-4" name="title" value="<?php echo $title; ?>" required>

            <div class="form-group">
                <textarea class="form-control" id="textarea" name="description" rows="7" required><?php echo $description; ?></textarea>
            </div>

            <div class="form-group col-12">
                <label class="custom-file-label">Choose Image...</label>
                <input name="image" type="file" class="custom-file-input" onchange="readURL(this);">
            </div>
            <div class="form-group col-4">
                <img id="image" width="100" src="<?php echo $image; ?>">
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="img" value="<?php echo $image; ?>">

            <!-- Sign up button -->
            <button class="btn btn-info my-4 btn-block" type="submit">Update Blog</button>
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
                    $image = $_POST['img'];
                }

                $query = "UPDATE blogs SET title='$title',description='$description',image='$image' WHERE id=$id";

                if (mysqli_query($con, $query)) {
                    echo "<div class='alert alert-success'>Blog Updated succesfully.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    $url1 = $_SERVER['REQUEST_URI'];
                    header("Refresh: 1; URL=$url1");
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