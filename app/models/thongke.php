<?php
    function loadall_thongke_loaiphong(){
        $sql= "select loaiphong.id_loaiphong as malp,loaiphong.name_loaiphong as tenlp, count(phong.id_phong) as countp, min(phong.price) as minprice, max(phong.price) as maxprice, avg(phong.price) as avgprice";
        $sql.=" from phong left join loaiphong on loaiphong.id_loaiphong=phong.id_loaiphong";
        $sql.=" group by loaiphong.id_loaiphong order by loaiphong.id_loaiphong desc";
        $listthongke=pdo_query($sql);
        return $listthongke;
    }
    function loadall_thongke_phong(){
        $sql= "select phong.id_phong as map,phong.name_phong as tenp, phong.price as price, phong.sokhach as sokhach,phong.id_loaiphong as id_loaiphong";
        $sql.=" from phong left join loaiphong on loaiphong.id_loaiphong=phong.id_loaiphong";
        $sql.=" group by phong.id_phong order by phong.id_phong desc";
        $listthongkep=pdo_query($sql);
        return $listthongkep;
    }
    function loadall_thongke_datphong(){
        $sql= "select u.id_user,u.username,u.email,u.tel,u.address,u.role,od.id_order,od.id_phong,od.sokhach,od.ngayden,od.ngaytra,od.tongtien,od.giaodich,od.tinhtrang";
        $sql.=" from datphong od join taikhoan u ON od.id_user = u.id_user";
        $sql.=" where od.giaodich = 1;";
        $listthongkedp=pdo_query($sql);
        return $listthongkedp;
    }
?>