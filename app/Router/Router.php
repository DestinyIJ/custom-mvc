<?php
    
    class Router
    {
        private array $handlers;
        private const METHOD_POST = "POST";
        private const METHOD_GET = "GET";
        private array $_GET_params;
        private array $_POST_params;
        private $notFoundHandler;

        public function get(string $path, $handler):void 
        {
            $this->_GET_params = $_GET;
            $this->addHandler(method: self::METHOD_GET, path: $path, handler: $handler);
        }

        public function post(string $path, $handler):void 
        {
            $this->_POST_params = $_POST;
            $this->addHandler(method: self::METHOD_POST, path: $path, handler: $handler);
        }

        private function addHandler(string $method, string $path, $handler):void 
        {
            $this->handlers[$method . '_' . $path] = [
                'path' => $path,
                'method' => $method,
                'handler' => $handler
            ];
        }

        public function addNotFoundHandler($handler): void
        {
            $this->notFoundHandler = $handler;
        }

        protected function getParam($handler_path, $request_path) {
            $exploded_handler_path = explode('{', $handler_path);

            $handlerpath = $exploded_handler_path[0];
            $exploded_request_path = explode('/', $request_path);
            
            $param = end($exploded_request_path); 

            $_exploded_request_path = explode($param, $request_path);
            $_requestpath = $_exploded_request_path[0];

            if($handlerpath === $_requestpath) {
                return $param;
            }

            return null;
        }

        public function run() 
        {
            $requestUri = parse_url($_SERVER['REQUEST_URI']);
            $requestPath = $requestUri['path'];
            $method = $_SERVER['REQUEST_METHOD']; 
            $controller_method = null;
            $requestParams = null;
            
            foreach($this->handlers as $handler) {
                 if($handler['path'] === $requestPath && $handler['method'] === $method) {
                    $controller_method = $handler['handler'];
                    break;
                } else if(str_contains($handler['path'], '/{') && $handler['method'] === $method) {
                    $requestParams = $this->getParam($handler['path'], $requestPath);
                    if($requestParams) {
                        $controller_method = $handler['handler'];
                        break;
                    } 
                }
            }

            if (!$controller_method) {
                header(header: "HTTP/1.0 404 Not Found");
                if (!empty($this->notFoundHandler)) {
                    $controller_method = $this->notFoundHandler;
                }
            }
            
            if (!isset($requestParams)) {
                if($method === 'GET') {
                    $requestParams = $this->_GET_params;
                } else if ($method === 'POST') {
                    $requestParams = $this->_POST_params;
                }
            }

            call_user_func_array($controller_method, [$requestParams]);
        }
    }