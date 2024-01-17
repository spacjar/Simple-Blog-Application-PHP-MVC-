<?php
    /**
     * Class Session
     * 
     * Represents a session management class that provides methods for managing session data and flash messages.
     */
    class Session {
        protected const FLASH_KEY = 'flash_messages';

        /**
         * Session constructor.
         * 
         * Starts the session and initializes flash messages.
         */
        public function __construct()
        {
            session_start();
            $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
            foreach ($flashMessages as $key => &$flashMessage) {
                $flashMessage['remove'] = true;
            }
            $_SESSION[self::FLASH_KEY] = $flashMessages;
        }

        /**
         * Sets a flash message.
         * 
         * @param string $key The key of the flash message.
         * @param mixed $message The value of the flash message.
         */
        public function setFlash($key, $message)
        {
            $_SESSION[self::FLASH_KEY][$key] = [
                'remove' => false,
                'value' => $message
            ];
        }

        /**
         * Retrieves a flash message.
         * 
         * @param string $key The key of the flash message.
         * @return mixed The value of the flash message if found, false otherwise.
         */
        public function getFlash($key)
        {
            return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
        }

        /**
         * Sets a session value.
         * 
         * @param string $key The key of the session value.
         * @param mixed $value The value to be stored in the session.
         */
        public function set($key, $value)
        {
            $_SESSION[$key] = $value;
        }

        /**
         * Retrieves a session value.
         * 
         * @param string $key The key of the session value.
         * @return mixed The value of the session if found, false otherwise.
         */
        public function get($key)
        {
            return $_SESSION[$key] ?? false;
        }

        /**
         * Removes a session value.
         * 
         * @param string $key The key of the session value to be removed.
         */
        public function remove($key)
        {
            unset($_SESSION[$key]);
        }

        /**
         * Destructor method.
         * 
         * Removes flash messages before the session is destroyed.
         */
        public function __destruct()
        {
            $this->removeFlashMessages();
        }

        /**
         * Removes flash messages marked for removal.
         */
        private function removeFlashMessages()
        {
            $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
            foreach ($flashMessages as $key => $flashMessage) {
                if ($flashMessage['remove']) {
                    unset($flashMessages[$key]);
                }
            }
            $_SESSION[self::FLASH_KEY] = $flashMessages;
        }
    }
?>