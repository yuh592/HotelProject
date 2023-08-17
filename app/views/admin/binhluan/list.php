<div class="row">
    <div class="row mb headeradmin" style="width:148%;">
        <h1 style="padding: 15px 0;">DANH SÁCH BÌNH LUẬN </h1>
    </div>
    <div class="row formcontent" style="width:1040px;">
        <form action="index.php?act=listbl" method="post">
            <div class="tk" style="display:flex;">
            <input type="text" name="kyw" placeholder="Tìm kiếm nội dung bình luận" style="width:100%;">
            <input type="submit" name="gui" value="Tìm Kiếm" style="margin-left:20px;">
            </div><br><br>
            <div class="row mb10 formdshanghoa" style="width:104%">
                <table>
                    <tr>
                        <th>MÃ BÌNH LUẬN</th>
                        <th>NỘI DUNG</th>
                        <th>MÃ KHÁCH HÀNG</th>
                        <th>NGÀY BÌNH LUẬN</th>
                        <th>MÃ PHÒNG</th>
                        <th>ACTION</th>
                    </tr>
                    <?php foreach ($listbl as $binhluan) {?>
                        <?php extract($binhluan);?>
                        <?php $xoabl = "index.php?act=xoabl&id=" . $id_comment;?>
                        <tr>
                                        <td><?php echo  $id_comment ?></td>
                                        <td><?php echo   $noidung ?></td>
                                        <td><?php echo   $id_user ?></td>
                                        <td><?php echo   $ngaybinhluan ?></td>
                                        <td><?php echo   $id_phong ?></td>
                                        <td>
                                            <a onclick="return confirm('Bạn có thực sự muốn xóa không?');" href="<?php echo $xoabl ?>">
                                                <input type="button" value="Xóa">
                                            </a>
                                        </td>
                                    </tr>
                   <?php } ?>      
                </table>
            </div>
            <div class="row pagination">
            <?php
            $countAcc = count_binhluan();
            $totalPages = ceil($countAcc / $accountsPerPage); 
            display_binhluan_pagination($currentPage, $totalPages); // Call the pagination function here
            ?>
            </div>
        </form>
      
    </div>
</div>
</div>