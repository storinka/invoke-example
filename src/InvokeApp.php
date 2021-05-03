<?php

namespace Reflect;

use Invoke\Di\ServiceContainer;
use Invoke\InvokeMachine;

class InvokeApp
{
    public ServiceContainer $container;

    protected array $functions;

    public function __construct(array $functions)
    {
        $this->functions = $functions;

        $this->container = new ServiceContainer();
        $this->container->singleton(InvokeApp::class, $this);
    }

    public function provide(string $provider)
    {
        $provider = $this->container->resolve($provider);
        $provider->boot();
    }

    public function run()
    {
        InvokeMachine::setup($this->functions, [
            "strict" => false,
            "reflection" => true,
        ]);

        $functionName = trim(trim(trim($_SERVER["PATH_INFO"]), "/"));
        $params = $_REQUEST;

        $result = $this->invoke($functionName, $params);

        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode(["result" => $result], JSON_UNESCAPED_UNICODE);
    }

    public function invoke(string $functionName, array $params = [], ?int $version = null)
    {
        if (!$version) {
            $version = InvokeMachine::version();
        }

        $functionClass = InvokeMachine::getFunctionClass($functionName, $version);
        $functionInstance = $this->container->resolve($functionClass);

        return $functionInstance->invoke($params);
    }
}
