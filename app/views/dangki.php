<?php
session_start();
include '../models/pdo.php';
include '../models/taikhoan.php';

    $error = array();
    $data = array();
    if (isset($_POST['dangki']) && ($_POST['dangki'])) {
        $data['username'] = isset($_POST['username']) ? $_POST['username'] : '';
        $data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
        $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
        $data['add'] = isset($_POST['add']) ? $_POST['add'] : '';
        function is_email($str) {
            return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
        }
        function is_password($password) {
            $parttern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,}$/";
            if (preg_match($parttern, $password))
                return true;
        }
        function validate_mobile($mobile){
            return preg_match('/^[0-9]{10}+$/', $mobile);
        }
        if (empty($data['username'])) {
            $error['username'] = 'Vui lòng nhập tên';
        }
        if (empty($data['email'])) {
            $error['email'] = 'Vui lòng nhập địa chỉ email ';
        }else if (!is_email($data['email'])){
            $error['email'] = 'Email không đúng định dạng';
        }

        if (empty($data['password'])) {
            $error['password'] = 'Vui lòng nhập mật khẩu';
        }else {
            // Kiểm tra định dạng password
            if (!is_password($_POST['password'])) {
                $error['password'] = "Password không đúng định dạng (Sử dụng ít nhất 1 kí tự viết hoa và số)";
            } else {
                $password = $_POST['password'];
            }
        }

        if (empty($data['phone'])) {
            $error['phone'] = 'Vui lòng nhập số điện thoại';
        }else {
            // Kiểm tra định dạng password
            if (!validate_mobile($_POST['phone'])) {
                $error['phone'] = "Số điện thoại không đúng định dạng";
            } else {
                $phone = $_POST['phone'];
            }
        }
        if (empty($data['add'])) {
            $error['add'] = 'Vui lòng nhập địa chỉ';
        }
        if (!$error) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $email = $_POST['email'];
            $tel = $_POST['phone'];   
            $address = $_POST['add'];
            $sql = "select * from taikhoan";
            $listtaikhoan=pdo_query($sql);
            $check = false;
            foreach($listtaikhoan as $taikhoan){
                if($taikhoan['username'] == $user || $taikhoan['email'] == $email){
                    $check = true;
                }else{
                    $check = false;
                }
            }
            if($check === true){
                $thongbao = "Tên hoặc địa chỉ email đã được sử dụng để đăng kí . Vui lòng đăng kí bằng tên và tài khoản email khác !";

            }else if($check === false){
                insert_taikhoan($user, $pass, $email, $tel, $address);
                $thongbao = "Đã đăng kí thành công!";
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
    <title>Đăng ký</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../public/assets/clients/css/dkdn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="bg-image"></div>
    <div class="form-container">

        <form action="" method="post">
        <h3>Đăng ký</h3>

        <div>
            <input type="text" name="username" required placeholder="Username" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>">
            <br>
            <span class="" style="color: red;">
                <?php echo isset($error['username']) ? $error['username'] : ''; ?>
            </span>
        </div>

        <div>
        <input type="password" name="password" required placeholder="Mật khẩu" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>">
        <br>
        <span class="w-100" style="color: red; ">
            <?php echo isset($error['password']) ? $error['password'] : ''; ?>
        </span>
        </div>

        <?php
                          if(isset($thongbao)&&($thongbao!="")){?>
                                  
                              <div class="w-96 h-64 fixed inset-y-60 inset-x-1/3 rounded-lg shadow-2xl border-solid z-10 bg-white" style="margin-left: 160px; margin-top: 50px;">
                                  <i class="text-black py-5  text-5xl text-center fa-sharp fa-solid fa-circle-check"></i>
                                  <p class="text-black pb-5 text-2xl text-center"><?php echo $thongbao;?></p>
                                    <div class="form4" style="text-align:center;">
                                      <button style="padding: 8px 15px 8px 15px; border-radius: 6px; background: #516CD7; color:#fff; text-transform: capitalize; font-size: 20px; cursor: pointer;"><a href="./dangnhap.php" style="color: #fff;text-decoration: none;">Đăng nhập</a></button>
                                  </div>
                              </div>
                              
        <?php } ?>

        <div>
        <input type="email" name="email" required placeholder="Địa chỉ email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
        <br>
            <span style="color: red;">
                <?php echo isset($error['email']) ? $error['email'] : ''; ?>
            </span>
        </div>
        
        <div>
        <input type="text" name="phone" required placeholder="Số điện thoại" value="<?php echo isset($data['phone']) ? $data['phone'] : ''; ?>">
        <br>
        <span style="color: red;">
            <?php echo isset($error['phone']) ? $error['phone'] : ''; ?>
        </span>
        </div>

        <div>
        <input type="text" name="add" required placeholder="Địa chỉ" value="<?php echo isset($data['add']) ? $data['add'] : ''; ?>">
        <br>
        <span style="color: red;">
            <?php echo isset($error['add']) ? $error['add'] : ''; ?>
        </span>
        </div>
        
        <input type="submit" value="Đăng kí" name="dangki" class="form-btn">

        <input type="reset" value="Reset" class="form-btn">

        <p>Đã có tài khoản ? <a href="./dangnhap.php">Đăng nhập</a></p>

        <a href="../../app/controllers/user/index.php?act=home">Trang chủ</a>

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