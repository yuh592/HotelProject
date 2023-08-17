<?php
    function insert_binhluan($noidung,$iduser,$ngaybinhluan,$idroom){
        $sql="insert into binhluan(noidung,id_user,ngaybinhluan,id_phong) values('$noidung',$iduser,'$ngaybinhluan',$idroom)";
        pdo_execute($sql);
    }
    function loadall_binhluan($kyw=""){
        $sql="SELECT * FROM binhluan where 1";
        if($kyw!=""){
            $sql.=" and noidung like '%".$kyw."%'";
        }
        $sql.=" order by id_comment desc";
        
        $listbl=pdo_query($sql);
        return $listbl;
    }
    function load_binhluan($id){
        $sql = "select taikhoan.username,binhluan.id_comment,binhluan.id_phong, binhluan.noidung, binhluan.ngaybinhluan
                from binhluan inner join taikhoan on taikhoan.id_user = binhluan.id_user
                where binhluan.id_phong = $id order by binhluan.id_comment desc";
        $listbl=pdo_query($sql);
        return $listbl;
    }
    function delete_binhluan($id){
        $sql="delete from binhluan where id_comment=".$id;
        pdo_execute($sql);
    }
    function loadone_binhluan($id){
        $sql="select * from binhluan where id_comment=".$id;
        $bl=pdo_query_one($sql);
        return $bl;
    }
    function update_binhluan($id,$noidung){
        $sql="update binhluan set noidung = '$noidung' where id_comment= $id";
        pdo_execute($sql);
    }
    function count_binhluan() {
        $sql = "SELECT COUNT(*) AS total FROM binhluan";
        $countAcc = pdo_query_one($sql);
        return $countAcc['total'];
        }
        
        function load_binhluan_for_page($startFrom, $accountsPerPage) {
        $sql = "SELECT * FROM binhluan";
        $sql .= " LIMIT $startFrom, $accountsPerPage";
        $listbl = pdo_query($sql);
        return $listbl;
        }
    
        //thay act = page khac
        function display_binhluan_pagination($currentPage, $totalPages) {
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