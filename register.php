<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap-4/css/bootstrap.min.css">
  <title>Bintang Jaya Sofa</title>
  <link rel="icon" type="image/png" href="assets/img/tes10.jpeg" sizes="16x16" />
  <link rel="stylesheet" href="assets/index.css">
  <link rel="stylesheet" href="sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="sweetalert2/animate.min.css">
  <style>
    /* RESET STYLES */
    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: linear-gradient(45deg, #4b6cb7, #182848);
    }

    /* WRAPPER */
    .wrapper {
      width: 90%;
      /* Adjusted for smaller screens */
      max-width: 420px;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(20px);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      color: #fff;
      border-radius: 15px;
      padding: 20px;
    }

    /* FORM ELEMENTS */
    .form-box.register h2 {
      font-size: 1.8em;
      color: #fff;
      text-align: center;
      margin-bottom: 20px;
    }

    .input-box {
      position: relative;
      width: 100%;
      height: 50px;
      border-bottom: 2px solid #fff;
      margin: 20px 0;
    }

    .input-box label {
      position: absolute;
      top: 50%;
      left: 5px;
      transform: translateY(-50%);
      font-size: 1em;
      color: #fff;
      font-weight: 500;
      pointer-events: none;
      transition: 0.5s;
    }

    .input-box input {
      width: 100%;
      height: 100%;
      background: transparent;
      border: none;
      outline: none;
      font-size: 1em;
      color: #fff;
      font-weight: 600;
      padding: 0 35px 0 5px;
    }

    .input-box .icon {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 1.2em;
      color: #fff;
    }

    .input-box input:focus~label,
    .input-box input:valid~label {
      top: -5px;
      color: #fff;
    }

    .btn {
      width: 100%;
      height: 45px;
      background: #fff;
      border: none;
      border-radius: 40px;
      cursor: pointer;
      font-size: 1em;
      color: #4b6cb7;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background: #4b6cb7;
      color: #fff;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

    .login-register {
      font-size: 0.9em;
      color: #fff;
      text-align: center;
      margin-top: 20px;
    }

    .login-register a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
    }

    .login-register a:hover {
      text-decoration: underline;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 768px) {
      .wrapper {
        padding: 15px;
      }

      .form-box.register h2 {
        font-size: 1.5em;
      }

      .input-box {
        margin: 15px 0;
      }

      .btn {
        font-size: 0.9em;
      }

      .login-register {
        font-size: 0.8em;
      }
    }

    @media (max-width: 480px) {
      .wrapper {
        padding: 10px;
      }

      .form-box.register h2 {
        font-size: 1.3em;
      }

      .input-box {
        margin: 10px 0;
      }

      .btn {
        font-size: 0.8em;
      }

      .login-register {
        font-size: 0.7em;
      }
    }
  </style>
</head>

<body>
  <div class="wrapper container">
    <div class="form-box register">
      <h2>Registration</h2>
      <form method="POST">
        <div class="input-box">
          <span class="icon"><ion-icon name="person"></ion-icon></span>
          <input type="text" name="username" id="username" required>
          <label>Username</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" name="email" id="email" required>
          <label>Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="eye-off" onclick="passRegister()" id="pass-icon-register"
              style="cursor: pointer"></ion-icon></span>
          <input type="password" id="password-register" name="password" required>
          <label>Password</label>
        </div>
        <button type="submit" name="register" class="btn">Register</button>
        <div class="login-register">
          <p>Already have an account? <a href="index.php" class="login-link">Login</a></p>
        </div>
      </form>
    </div>
  </div>



  <?php
  include "config.php";

  // Register
  if (isset($_POST['register'])) { //jika tombol submit di klik
    //ambil data dari form input
    //mengabaikan tanda petik
    $nama = mysqli_real_escape_string($conn, $_POST['username']);
    $password = htmlspecialchars(md5($_POST['password']));
    $email = htmlspecialchars($_POST['email']); //mengabaikan tag html; 
    $query = mysqli_query($conn, "INSERT INTO users VALUES(NULL,'$nama','$email','$password','user')");
    $sukses = mysqli_affected_rows($conn);
    if ($sukses > 0) {
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
      echo "<script>const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  
  Toast.fire({
    icon: 'success',
    title: 'Pendaftaran Berhasil',
    showCloseButton: true
  });
</script>";
    } else {
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
      echo "<script>const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  
  Toast.fire({
    icon: 'error',
    title: 'Pendaftaran Gagal',
    showCloseButton: true
  });
</script>";
    }
  }
  ?>


  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script src="bootstrap-4/js/bootstrap.min.js"></script>
  <script src="assets/index.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script src="bootstrap-4/js/jquery-3.3.1.slim.min.js"></script>
  <!-- <script src="bootstrap-4/js/popper.min.js"></script> -->
  <script src="bootstrap-4/js/bootstrap.min.js"></script>
  <script src="sweetalert2/sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>