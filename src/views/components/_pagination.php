<?php
    function generatePagination(int $page, int $totalPages) {
        echo '<div class="pagination">';

        if ($page > 1 && $page <= $totalPages) {
            echo '<a href="?page=' . ($page - 1) . '" class="pagination__btn cta cta__primary">Previous</a>';
        }
    
        if ($page <= $totalPages - 2) {
            $start = max(1, $page - 1);
            $end = min($start + 2, $totalPages);
        } else {
            $start = max(1, $totalPages - 2);
            $end = $totalPages;
        }
    
        if ($start > 1) {
            echo '<a href="?page=1" class="pagination__number cta cta__secondary">1</a>';
            echo '<span class="pagination__ellipsis cta cta__secondary">...</span>';
        }
    
        for ($i = $start; $i <= $end; $i++) {
            echo '<a href="?page=' . $i . '" class="pagination__number cta ' . ($i == $page ? 'cta__primary' : 'cta__secondary') . '">' . $i . '</a>';
        }
    
        if ($end < $totalPages) {
            echo '<span class="pagination__ellipsis cta cta__secondary">...</span>';
            echo '<a href="?page=' . $totalPages . '" class="pagination__number cta cta__secondary">' . $totalPages . '</a>';
        }
    
        if ($page < $totalPages) {
            echo '<a href="?page=' . ($page + 1) . '" class="pagination__btn cta cta__primary">Next</a>';
        }
    
        echo '</div>';
    }
?>