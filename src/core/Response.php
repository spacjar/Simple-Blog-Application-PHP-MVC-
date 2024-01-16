<?php
    /**
         * The Response class handles HTTP responses.
         */
        class Response {
            /**
             * Sets the HTTP status code for the response.
             *
             * @param int $code The HTTP status code.
             * @return void
             */
            public function setStatusCode(int $code) {
                http_response_code($code);
            }

            /**
             * Sets a header for the HTTP response.
             *
             * @param string $header The header to be set.
             * @return void
             */
            public function setHeader(string $header) {
                header($header);
            }

            /**
             * Redirects the user to the specified URL.
             *
             * @param string $url The URL to redirect to.
             * @return void
             */
            public function redirect(string $url) {
                header("Location: ".$url);
            }

            /**
             * Writes the given data as a JSON response.
             *
             * @param array $data The data to be encoded as JSON.
             * @return void
             */
            public function writeJson(array $data) {
                echo json_encode($data);
            }
        }
?>