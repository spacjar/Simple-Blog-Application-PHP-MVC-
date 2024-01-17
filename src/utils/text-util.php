<?php
    function truncateString($str, $maxLength) {
        if (strlen($str) <= $maxLength) {
            return $str;
        }
    
        $truncatedStr = substr($str, 0, $maxLength);
        $lastSpacePos = strrpos($truncatedStr, ' ');
    
        if ($lastSpacePos !== false) {
            $truncatedStr = substr($truncatedStr, 0, $lastSpacePos);
        }
    
        return $truncatedStr . '...';
    }
?>