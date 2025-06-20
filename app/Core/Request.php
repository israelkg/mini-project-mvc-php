<?php

namespace App\Core;

class Request{
    /**
     *
     * @return string 
     */
    public function getPath(): string{
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     *
     * @return string O método HTTP.
     */
    public function getMethod(): string{
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     *
     * @return array 
     */
    public function getBody(): array{
        $body = [];
        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {            
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

}