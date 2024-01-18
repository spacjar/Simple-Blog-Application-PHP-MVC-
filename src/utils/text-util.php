<?php
    /**
     * Truncates a string to a specified maximum length, adding ellipsis if necessary.
     *
     * @param string $str The string to truncate.
     * @param int $maxLength The maximum length of the truncated string.
     * @return string The truncated string.
     */
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