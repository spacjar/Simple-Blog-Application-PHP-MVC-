<?php
    /**
     * The File class provides methods for handling files.
     */
    class File {
        /**
         * Uploads an image file to the server.
         *
         * @param array $image The image file to be uploaded.
         * @return string|false The unique file name if the upload is successful, false otherwise.
         */
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