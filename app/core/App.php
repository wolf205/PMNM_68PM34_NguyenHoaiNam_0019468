<?php
class App
{
    protected $controller = 'home';
    protected $action = 'index';
    protected $params = [];

    public function __construct()
    {
        $urlProcessed = $this->UrlProcess();   //marng url đã đước xử lý
        // var_dump($urlProcessed);
        if (isset($urlProcessed[0])) {
            if (file_exists('../app/controllers/' . $urlProcessed[0] . '.controller.php')) {
                $this->controller = $urlProcessed[0];
                unset($urlProcessed[0]);
            }
        }
        require_once '../app/controllers/' . $this->controller . '.controller.php';
        $this->controller = new $this->controller;   //tạo đối tượng controller
        if (isset($urlProcessed[1])) {
            if (method_exists($this->controller, $urlProcessed[1])) {
                $this->action = $urlProcessed[1];
                unset($urlProcessed[1]);
            }
        }

        $this->params = $urlProcessed ? array_values($urlProcessed) : [];
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    public function urlProcess()
    {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
