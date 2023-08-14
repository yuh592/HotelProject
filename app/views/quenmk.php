<?php
session_start();
include '../../app/models/pdo.php';
include '../../app/models/taikhoan.php';
if (isset($_POST['guiemail']) && ($_POST['guiemail'])) {
  $email = $_POST['email'];
  // echo $email;
  $checkemail = checkEmail($email);
  // echo "<pre>";
  // var_dump($checkemail);
  if (isset($checkemail)) {
      $thongbao = 'Mật khẩu của bạn là ' . $checkemail['password'];
  } else {
      $thongbao = 'Email này không tồn tại';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../../public/assets/clients/css/dkdn.css">
    <link rel="stylesheet" href="path/to/your/charts.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="bg-image"></div>
<div class="form-container">
   <form action="" method="post">
      <h3>Quên mật khẩu</h3>
      <div>
        <input type="text" name="email" required placeholder="Email"><br>
        <span style="color: white;">
          <?php echo isset($error['username']) ? $error['username'] : ''; ?>
        </span>
      </div>
      <br>

      <div class="" style="text-align:center;color: red;">
            <?php
                    if(isset($thongbao)&&($thongbao!="")){?>
                    
                      <div class="w-1/5 h-1/5 text-center fixed inset-y-60 inset-x-1/4 rounded-lg shadow-2xl border-solid z-10 bg-white" style="margin-left:313px; margin-top:150px;">
                        <i class="text-green-500 py-10  text-6xl text-center fa-sharp fa-solid fa-circle-check"></i>
                        <p class="text-black py-8 text-3xl text-center"><?php echo $thongbao;?></p>

                        <div class="form4" style="text-align:center;">
                          <button class="bg-gradient-to-r from-purple-500 to-pink-500" style="padding: 8px 15px 8px 15px; border-radius: 6px; background: #516CD7; color:#fff; text-transform: capitalize; font-size: 20px; cursor: pointer;">
                            <a href="./dangnhap.php" style="color: #fff;text-decoration: none;">Đăng nhập</a>
                          </button>
                        </div>
                      </div>
            <?php } ?>
        </div>

      <input type="submit" name="guiemail" value="Kiểm tra" class="form-btn">
      <a href="../index.php?act=home" >Trang chủ</a>
      <p>Chưa có tài khoản ? <a href="./dangki.php">Đăng kí ngay</a></p>

      <div class="" style="text-align:center;color: red;">
                <?php
                    if(isset($txt_erro)&&($txt_erro!="")){
                        echo $txt_erro;
                    }
                ?>
        </div>
    </form>
</body>
</html>