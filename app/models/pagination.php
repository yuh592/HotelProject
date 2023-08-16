<?php
function display_pagination($currentPage, $totalPages) {
    $visiblePages = 5;

    $startPage = max(1, $currentPage - floor($visiblePages / 2));
    $endPage = min($totalPages, $startPage + $visiblePages - 1);

    if ($startPage > 1) {
        echo '<a href="index.php?act=dskh&page=1">First</a>';
    }

    if ($startPage > 2) {
        echo '<span>...</span>';
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        echo '<a href="index.php?act=dskh&page=' . $i . '">' . $i . '</a>';
    }

    if ($endPage < $totalPages - 1) {
        echo '<span>...</span>';
    }

    if ($endPage < $totalPages) {
        echo '<a href="index.php?act=dskh&page=' . $totalPages . '">Last</a>';
    }
}
?>