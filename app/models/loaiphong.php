<?php
    function insert_loaiphong($tenloaiphong){
        $sql="INSERT INTO loaiphong(name_loaiphong) values('$tenloaiphong')";
        pdo_execute($sql);
    }
    function delete_loaiphong($id){
        $query="update phong set id_loaiphong = 1 where id_loaiphong=".$id;
        pdo_execute($query);
        $sql="delete from loaiphong where id_loaiphong=".$id;
        pdo_execute($sql);
    }
    function loadall_loaiphong(){ 
        if(isset($_POST['kyw']) && $_POST['kyw'] != ""){
            $search = $_POST['kyw'];
            $query = "select * from loaiphong where name_loaiphong like '%$search%'";
            $listlp=pdo_query($query);
            return $listlp;

        }
        if(empty($listlp)){
            $query="SELECT * FROM loaiphong order by id_loaiphong desc";
            $listlp=pdo_query($query);
            return $listlp;

        }
    }
    function loadall_loaiphong_ourrooms(){   
        $sql="select * from loaiphong order by id_loaiphong desc limit 0,4";
        $listlp=pdo_query($sql);
        return $listlp;

    }
    function loadone_loaiphong($id){
        $sql="select * from loaiphong where id_loaiphong=".$id;
        $lp=pdo_query_one($sql);
        return $lp;
    }
    function update_loaiphong($id,$tenloaiphong){
        $sql="update loaiphong set name_loaiphong='".$tenloaiphong."' where id_loaiphong=".$id;
        pdo_execute($sql);
    }

    //pagination
    function count_loaiphong() {
        $sql = "SELECT COUNT(*) AS total FROM loaiphong";
        $countAcc = pdo_query_one($sql);
        return $countAcc['total'];
        }
        
        function load_loaiphong_for_page($startFrom, $accountsPerPage) {
        $sql = "SELECT * FROM loaiphong";
        $sql .= " LIMIT $startFrom, $accountsPerPage";
        $listlp = pdo_query($sql);
        return $listlp;
        }
    
        //thay act = page khac
        function display_loaiphong_pagination($currentPage, $totalPages) {
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