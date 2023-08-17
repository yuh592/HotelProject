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
    function update_taikhoan($id,$user,$password,$email,$address,$tel, $role){
        $sql="UPDATE taikhoan
            SET username = '$user', password = '$password',email = '$email',tel = '$tel',address = '$address', role = '$role'
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
    $visiblePages = 5;
    $startPage = max(1, $currentPage - floor($visiblePages / 2));
    $endPage = min($totalPages, $startPage + $visiblePages - 1);

    if ($startPage > 1) {
        echo '<a href="index.php?act=' . $_GET['act'] . '&page=1">Trang đầu</a>';
    }

    if ($startPage > 2) {
        echo '<span>...</span>';
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        echo '<a class="' . ($i === $currentPage ? 'active' : '') . '" href="index.php?act=' . $_GET['act'] . '&page=' . $i . '">' . $i . '</a>';
    }

    if ($endPage < $totalPages - 1) {
        echo '<span>...</span>';
    }

    echo '<a href="index.php?act=' . $_GET['act'] . '&page=' . $totalPages . '">Trang cuối</a>';
    }
?>