<?php include('layout/HomeLayout/Header.php'); ?>

<div class="row">
  <div class="col-3"></div>

  <div class="col-sm-6">
    <!-- Default form login -->
    <form action="" class="text-center border border-light p-5" method="post">
      <p class="h4 mb-4">Login</p>

      <!-- E-mail -->
      <input type="email" class="form-control mb-4" name="email" placeholder="E-mail" required>

      <!-- Password -->
      <input type="password" class="form-control mb-4" name="password" placeholder="Password" required>

      <div class="d-flex justify-content-around">
        <div>
          <!-- Remember me -->
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="check">
            <label class="custom-control-label" for="check">Remember me</label>
          </div>
        </div>
      </div>
      <!-- Sign in button -->
      <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

      <?php
      if (isset($_POST['email'])) {
        $email = trim(strtolower($_POST['email']));
        $password = trim($_POST['password']);
        $password = md5($password);
        $found = 0;
        $query = "SELECT * FROM admin";

        $data = mysqli_query($con, $query);
        $admins = mysqli_fetch_all($data, MYSQLI_ASSOC);

        foreach ($admins as $admin) {
          if ($admin['email'] == $email and $admin['password'] == $password) {
            $_SESSION['loggedin'] = true;
            header('Location:dashboard.php');
            $found = 1;
          }
        }
        if ($found == 0) {
          echo "<div class='alert alert-danger'>Your Email id or password mismatch..<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
      }
      ?>

    </form>
    <!-- Default form login -->
  </div>
  <!--/.Card : Dynamic content wrapper-->
  <div class="col-3"></div>
</div>

<?php include('layout/HomeLayout/Footer.php'); ?>
