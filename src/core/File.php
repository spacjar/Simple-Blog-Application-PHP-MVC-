<?php
    class File {
        public static function uploadImage($image) {
            // Generate a unique file name
            $fileName = time() . '_' . rand() . '.' . $image['name'];
            $imagePath = './uploads/' . $fileName;

            // Move the image to the uploads directory
            move_uploaded_file($image['tmp_name'], "./uploads/".$fileName);

            // Check if the file has been created
            if (!file_exists($imagePath)) {
                // If the file has not been created, return false
                return false;
            }

            // Return the unique file name
            return $imagePath;
        }
    }
?>