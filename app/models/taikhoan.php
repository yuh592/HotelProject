<?php
    function insert_taikhoan($username,$email,$password,$tel,$address){
        $sql="INSERT INTO taikhoan(username,password,email,tel,address) values('$username','$email','$password','$tel','$address')";
        pdo_execute($sql);
    }
    function delete_taikhoan($id){
        $sql="delete from taikhoan where id_user=".$id;
        pdo_execute($sql);
    }
    function loadone_taikhoan($id){
        $sql="select * from taikhoan where id_user=".$id;
        $tk=pdo_query_one($sql);
        return $tk;
    }
    function checkUser($user, $pass){
        $sql = "select * from taikhoan where username ='".$user."' AND password = '".$pass."'";
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function checkEmail($email){
        $sql = "select * from taikhoan where email = '".$email."'";
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function update_taikhoan($id,$user,$password,$email,$address,$tel){
        $sql="UPDATE taikhoan
            SET username = '$user', password = '$password',email = '$email',tel = '$tel',address = '$address'
            WHERE id_user=$id";
        pdo_execute($sql);
    }
    function loadall_taikhoan($kyw){
        $sql="SELECT * FROM taikhoan where 1";
        if($kyw!=""){
            $sql.=" and username like '%".$kyw."%'";
        }
        $sql.=" order by id_user desc";
        $listtaikhoan=pdo_query($sql);
        return $listtaikhoan;
    }

    function count_taikhoan() {
    $sql = "SELECT COUNT(*) AS total FROM taikhoan";
    $countAcc = pdo_query_one($sql);
    return $countAcc['total'];
    }
    
    function load_accounts_for_page($startFrom, $accountsPerPage) {
    $sql = "SELECT * FROM taikhoan";
    $sql .= " LIMIT $startFrom, $accountsPerPage";
    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
    }

    //thay act = page khac
    function display_taikhoan_pagination($currentPage, $totalPages) {
        echo '<a class="' . ($currentPage === 1 ? 'disabled' : '') . '" href="index.php?act=dskh&page=1">First</a>';
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                echo '<a class="active" href="index.php?act=dskh&page=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="index.php?act=dskh&page=' . $i . '">' . $i . '</a>';
            }
        }
        echo '<a href="index.php?act=dskh&page=' . $totalPages . '">Last</a>';
    }
?>