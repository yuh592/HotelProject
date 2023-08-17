<div class="row">
    <div class="row mb headeradmin" style="width:143%;">
        <h1 style="padding: 15px 0;">DANH SÁCH HỖ TRỢ </h1>
    </div>
    <div class="row formcontent">
        <form action="index.php?act=dsht" method="post">
            <div class="tk" style="display:flex;">
            <input type="text" name="kyw" placeholder="Tìm kiếm tên khách hàng" style="width:100%;">
            <input type="submit" name="gui" value="Tìm Kiếm" style="margin-left:20px;">
            </div><br><br>
            <div class="row mb10 formdshanghoa" style="width:1050px;">
                <table>
                    <tr>
                        <th>MÃ HỖ TRỢ</th>
                        <th>TÊN KHÁCH HÀNG</th>
                        <th>SỐ ĐIỆN THOẠI</th>
                        <th>GHI CHÚ</th>
                        <th>HÀNH ĐỘNG</th>
                    </tr>
                    <?php
                    foreach ($listhotro as $hotro) {
                        extract($hotro);
                        $xoaht = "index.php?act=xoaht&id=" . $id_hotro;
                        echo '<tr>
                                        <td>' . $id_hotro . '</td>
                                        <td>' . $name_user . '</td>
                                        <td>0' . $tel . '</td>
                                        <td>' . $ghichu . '</td>
                                        <td><a onclick="return DELETE()" href="' . $xoaht . '"><input type="button" value="Xóa"></a></td>
                                    </tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="row pagination">
                <?php
                $countAcc = count_hotro();
                $totalPages = ceil($countAcc / $accountsPerPage); 
                display_hotro_pagination($currentPage, $totalPages);
                ?>
            </div>
        </form>
        <script>
            function DELETE() {
                return confirm("Bạn có chắc muốn xóa " + "?");
            }
        </script>
    </div>
</div>
</div>