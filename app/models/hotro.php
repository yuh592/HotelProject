<?php
    function insert_hotro($name_user,$tel,$ghichu){
        $sql = "INSERT INTO hotro(name_user,tel,ghichu) values ('$name_user','$tel','$ghichu')";
        pdo_execute($sql);
    }
    function loadall_hotro($kyw=""){
        $sql="SELECT * FROM hotro where 1";
        if($kyw!=""){
            $sql.=" and name_user like '%".$kyw."%'";
        }
        $sql.=" order by id_hotro desc";
        
        $listhotro=pdo_query($sql);
        return $listhotro;
    }
    function delete_hotro($id){
        $sql="delete from hotro where id_hotro=".$id;
        pdo_execute($sql);
    }

    function count_hotro() {
        $sql = "SELECT COUNT(*) AS total FROM hotro";
        $countAcc = pdo_query_one($sql);
        return $countAcc['total'];
        }
        
    function load_hotro_for_page($startFrom, $accountsPerPage) {
        $sql = "SELECT * FROM hotro";
        $sql .= " LIMIT $startFrom, $accountsPerPage";
        $listhotro = pdo_query($sql);
        return $listhotro;
        }
    
        //thay act = page khac
    function display_hotro_pagination($currentPage, $totalPages) {
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