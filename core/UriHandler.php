<?php
class UriHandler {

    public $path;

     /**
     * Retrieves the URI path.
     * 
     * This method sets the `$path` property by removing the base path (e.g., `/todo-list`) 
     * from the full request URI. If the path is empty or root ('/'), it defaults to '/'.
     */
    public function getUri()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $basePath = (strpos($requestUri, '/todo-list') === 0) ? '/todo-list' : '/';
        $path = substr_replace($requestUri, '', 0, strlen($basePath));
        if ($path === '' || $path === '/') {
            $this->path = '/';
            return;
        }
        $this->path = ltrim($path, '/');
    }
    
     /**
     * Retrieves the base URL of the application.
     * 
     * This method constructs the base URL using the protocol, host, 
     * and script path, allowing for dynamic linking within the app.
     *
     * @return string The base URL, e.g., 'http://localhost/todo-list'
     */
    public function getBaseUrl(){
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $script_name = dirname($_SERVER['SCRIPT_NAME']); 
        $base_url = $protocol . '://' . $host . $script_name;

        return $base_url;
    }
}
?>