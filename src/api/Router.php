<?php
class Router {
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    function __construct(IReqeust $request) {
        $this->request = $request;
    }

    function __call($name, $args) {
        list($route, $method) = $args;

        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        $this->{strtoupper($name)}[$this->formatRoute($route)] = $method;
    }

    private function formatRoute($route) {
        $result = rtrim($route, '/');

        if ($result === '') {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler() {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler() {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    function resolve() {
        $methodDictionary = $this->{strtolower($this->request->reqestMethod)};
        $formattedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formattedRoute];

        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, array($this->request));
    }

    function __destruct() {
        $this->resolve();
    }
}
?>