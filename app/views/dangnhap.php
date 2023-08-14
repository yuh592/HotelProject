<?php
session_start();
include '../../app/models/pdo.php';
include '../../app/models/taikhoan.php';
$error = array();
$data = array();
if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
                $data['username'] = isset($_POST['username']) ? $_POST['username'] : '';
                $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
                function is_password($password) {
                  $parttern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                  if (preg_match($parttern, $password))
                      return true;
                } 
                if (empty($data['username'])) {
                  $error['username'] = 'Vui lòng nhập tên';
                }
                
                if (empty($data['password'])) {
                  $error['password'] = 'Vui lòng nhập mật khẩu';
                }else {
                    // Kiểm tra định dạng password
                    if (!is_password($_POST['password'])) {
                        $error['password'] = "Password không đúng định dạng";
                    } else {
                        $password = $_POST['password'];
                    }
                }
                if (!$error) {
                  $user = $_POST['username'];
                  $pass = $_POST['password'];
                  $checkuser = checkUser($user, $pass);
                  if (is_array($checkuser)) {
                    $_SESSION['user'] = $checkuser;

                    if ($checkuser['role'] == 1) {
                        header("location:/HotelProject/app/controllers/admin/index.php");
                    } elseif ($checkuser['role'] == 0) {
                      header("location:/HotelProject/app/controllers/user/index.php");
                    }
                  } else {
                    $thongbao = "Tài khoản không tồn tại. Vui lòng kiểm tra đăng ký";
                  }  
                }
            }
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../../public/assets/clients/css/dkdn.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
<div class="bg-image"></div>
<div class="form-container">
   <form action="" method="post">
      <h3>Đăng nhập</h3>

      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>

      <div>
        <input type="text" name="username" required placeholder="Username" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>"><br>
        <span style="color: white;">
          <?php echo isset($error['username']) ? $error['username'] : ''; ?>
        </span>
      </div>

      <div>
        <input type="password" name="password" required placeholder="Mật khẩu" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>"><br>
        <span style="color: white;">
        <?php echo isset($error['password']) ? $error['password'] : ''; ?>
        </span>
      </div>
      <br>

      <?php
                    if(isset($thongbao)&&($thongbao!="")){?>
                    
                      <div class="w-96 h-52 text-center fixed inset-y-60 inset-x-1/3 rounded-lg shadow-2xl border-solid z-10 bg-white" style="margin-left: 160px; margin-top: 50px;">
                        <i class="text-black py-3  text-5xl text-center fa-sharp fa-solid fa-circle-check"></i>
                        <p class="text-black pb-5 text-2xl text-center"><?php echo $thongbao;?></p>

                        <div class="form4" style="text-align:center;">
                        </div>
                      </div>
                  
      <?php } ?>

      <input type="submit" name="dangnhap" value="Đăng nhập" class="form-btn">
      <a href="./quenmk.php" >Quên mật khẩu?</a>
      <p>Chưa có tài khoản ? <a href="./dangki.php">Đăng kí ngay</a></p>

      <div class="" style="text-align:center;color: red;">
                <?php
                    if(isset($txt_erro)&&($txt_erro!="")){
                        echo $txt_erro;
                    }
                ?>
        </div>
    </form>
  </div>
</body>
</html>