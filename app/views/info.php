<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
?>
<body class="bg-gradient-to-r from-cyan-200  to-cyan-200 h-screen flex justify-center items-center text-white">
    <div class="bg-cyan-900 w-96 mb-16 mx-auto lg:h-4/5 h-full lg:rounded-lg text-center overflow-hidden p-5" style="margin-top: 75px; background-color: darkslateblue; color: white;">
   
        <div class="w-36 h-36 border-solid border-4 border-white rounded-full overflow-hidden m-auto  ">
            <img src="../../../public/upload/132083046_3702406189839103_501186624219407700_n.jpg" alt="">
        </div>
        <div class="flex w-96 ml-5 mt-4">
            <label class="text-xl" for="">Họ và tên : </label><br>
            <h2 class="mx-3 text-xl"><?php echo $_SESSION['user']['username']?></h2>
        </div>
        <div class="flex w-96 ml-5">
            <label class="text-xl" for="">Password : </label><br>
            <h2 class="mx-3 text-xl"><?php echo $_SESSION['user']['password']?></h2>

        </div>
        <div class="flex w-96 ml-5">
            <label class="text-xl" for="">Email : </label><br>
            <h2 class="mx-3 text-xl"><?php echo $_SESSION['user']['email']?></h2>

        </div>
        <div class="flex w-96 ml-5">
            <label class="text-xl" for="">Địa chỉ : </label><br>
            <h2 class="mx-3 text-xl"><?php echo $_SESSION['user']['address']?></h2>

        </div>
        <div class="flex w-96 ml-5">
            <label class="text-xl" for="">Số điện thoại : </label><br>
            <h2 class="mx-3 text-xl"><?php echo $_SESSION['user']['tel']?></h2>

        </div>
       
        <div class="flex-wrap mt-5">
            <button class="w-36 h-10 border-solid border bg-transparent text-white rounded-xl hover:bg-rose-500 transition delay-150 duration-300 ease-in-out border-white	 m-2">
               <a href="../controllers/user/index.php?act=thoat"> Đăng xuất</a>
            </button>
            
            <button class="w-36 h-10 border-solid border bg-transparent text-white rounded-xl hover:bg-rose-500 transition delay-150 duration-300 ease-in-out border-white	 m-2">
                <a href="../user/index.php?act=update">Cập nhật</a> 
            </button> 
            <button class="w-36 h-10 border-solid border bg-transparent text-white rounded-xl hover:bg-rose-500 transition delay-150 duration-300 ease-in-out border-white	 m-2">
                <a href="../controllers/user/index.php?act=home">Trang chủ</a>
            </button> 

        </div>
    </div>
</body>
