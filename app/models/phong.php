<?php
    function insert_phong($tenphong,$gia,$giasale,$sokhach,$img,$mota,$idlp){
        $sql="INSERT INTO phong(name_phong,price,price_sale,sokhach,img,mota,id_loaiphong) values('$tenphong','$gia','$giasale','$sokhach','$img','$mota','$idlp')";
        pdo_execute($sql);
    }
    function delete_phong($id){
        // $sql="update phong set id_phong=1";
        $sql="delete from phong where id_phong=".$id;
        pdo_execute($sql);
    }
    function loadall_phong_home(){
        $sql="SELECT * FROM phong where 1 order by id_phong desc limit 0,9";
        $listp=pdo_query($sql);
        return $listp;
    }
    function loadall_phong($kyw="",$idlp=0){
        $sql="SELECT * FROM phong where 1";
        if($kyw!=""){
            $sql.=" and name_phong like '%".$kyw."%'";
        }
        if($idlp>0){
            $sql.=" and id_loaiphong like '".$idlp."'";
        }
        $sql.=" order by id_phong desc";
        
        $listp=pdo_query($sql);
        return $listp;
    }
    function loadall_phong_timkiem(){
        $sql= "select phong.id_phong,phong.name_phong,phong.img,phong.sokhach,phong.price,phong.price,phong.trangthai,phong.id_loaiphong,phong.price_sale,datphong.ngayden,datphong.ngaytra from datphong
            inner join phong on datphong.id_phong=phong.id_phong";
        // $sql.= "upadate phong set trangthai ='' where id_phong=".$id_phong;
        $listsearch=pdo_query($sql);
        return $listsearch;
    }
    function loadone_phong($id){
        $sql="select * from phong where id_phong=".$id;
        $p=pdo_query_one($sql);
        return $p;
    }
    // đã đặt
    function loadall_phongdadat2($ngaydat , $ngaytra){
        $sql =  "select * from phong where id_phong IN (select id_phong from datphong where tinhtrang = 1 AND ngayden = '$ngaydat' AND ngaytra = '$ngaytra' )";
        $listphongdd = pdo_query($sql);
        return $listphongdd;
    }
    // 
    // chưa đặt
    function loadall_phongchuadat(){
        $sql = "select * from phong where id_phong ";
        $listphongtk = pdo_query($sql);
        return $listphongtk;
    }
    function loadall_phongchuadat1($ngaydat , $ngaytra){
        $sql = "select * from phong where id_phong NOT IN (select id_phong from datphong where tinhtrang = 1 AND ngayden = '$ngaydat' AND ngaytra = '$ngaytra' )";
        $listphongtk = pdo_query($sql);
        return $listphongtk;
    }
    function loadall_phongchuadat2($ngaydat , $ngaytra){
        $sql = "select * from phong where id_phong NOT IN (select id_phong from datphong where tinhtrang = 1 AND ngayden > '$ngaydat' OR ngaytra < '$ngaytra' )";
        $listphongtk = pdo_query($sql);
        return $listphongtk;
    }
    function loadall_phongchuadat3($ngaydat , $ngaytra){
        $sql = "select * from phong where id_phong NOT IN (select id_phong from datphong where tinhtrang = 1 AND ngayden <= '$ngaydat' AND ngaytra >= '$ngaytra')";
        $listphongtk = pdo_query($sql);
        return $listphongtk;
    }
    // 
    function load_phong_cungloai($id,$idlp){
        $sql="select * from phong where id_loaiphong=".$idlp." AND id_phong <> ".$id;
        $listp=pdo_query($sql);
        return $listp;
    }
    function load_phongview_cungloai($id){
        $sql="select * from phong where id_loaiphong=".$id." ";
        $listp=pdo_query($sql);
        return $listp;
    }
    function load_tenlp($idlp){
        if($idlp>0){
            $sql="select * from loaiphong where id_loaiphong=".$idlp;
            $lp=pdo_query_one($sql);
            extract($lp);
            return $name_phong;
        }else{
            return "";
        }
        
    }
    function update_phong($id,$tenphong,$gia,$giasale,$sokhach,$img,$mota,$idlp){
        if($img!=""){
            $sql="UPDATE phong
            SET id_phong = '$id', name_phong = '$tenphong', price = $gia, price_sale = '$giasale', sokhach = '$sokhach', img = '$img', mota = '$mota' , id_loaiphong = $idlp
            WHERE id_phong = $id ";
        }else{
            $sql="UPDATE phong
            SET id_phong = '$id', name_phong = '$tenphong', price = $gia, price_sale = '$giasale', sokhach = '$sokhach', mota = '$mota' , id_loaiphong = $idlp
            WHERE id_phong = $id ";
        }
        pdo_execute($sql);
    }

    function count_phong() {
        $sql = "SELECT COUNT(*) AS total FROM phong";
        $countAcc = pdo_query_one($sql);
        return $countAcc['total'];
    }
    
    function load_phong_for_page($startFrom, $accountsPerPage) {
        $sql = "SELECT * FROM phong";
        $sql .= " LIMIT $startFrom, $accountsPerPage";
        $listlp = pdo_query($sql);
        return $listlp;
        }
    
        //thay act = page khac
    function display_phong_pagination($currentPage, $totalPages) {
            $visiblePages = 5;
        
            $startPage = max(1, $currentPage - floor($visiblePages / 2));
            $endPage = min($totalPages, $startPage + $visiblePages - 1);
        
            if ($startPage > 1) {
                echo '<a href="index.php?act=listp&page=1">Trang đầu</a>';
            }
        
            if ($startPage > 2) {
                echo '<span>...</span>';
            }
        
            for ($i = $startPage; $i <= $endPage; $i++) {
                echo '<a href="index.php?act=listp&page=' . $i . '">' . $i . '</a>';
            }
        
            if ($endPage < $totalPages - 1) {
                echo '<span>...</span>';
            }
        
            if ($endPage < $totalPages) {
                echo '<a href="index.php?act=listp&page=' . $totalPages . '">Trang cuối</a>';
            }
    }

    function setup__phong_pagination($accountsPerPage) {
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $startFrom = ($currentPage - 1) * $accountsPerPage;
        $listp = load_phong_for_page($startFrom, $accountsPerPage);
        $totalCount = count_phong();
        $totalPages = ceil($totalCount / $accountsPerPage);
        
        return array(
            'currentPage' => $currentPage,
            'listp' => $listp,
            'totalCount' => $totalCount,
            'totalPages' => $totalPages
        );
    }
