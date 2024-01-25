<?php

namespace Goldfinch\CLISupplier\Controllers;

use Exception;
use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Config;

class CLISupplierController extends Controller
{
    private static $url_handlers = [
        '$Action' => 'runRegisteredSupplies',
    ];

    private static $allowed_actions = [
        'runRegisteredSupplies',
    ];

    private static $registered_supplies = [];

    // private static $deny_non_cli = true;

    protected function init()
    {
        parent::init();

        if (!Director::is_cli()) {
            return $this->httpError(404);
        }

        $routes = Director::config()->get('rules');

        print_r(json_encode($routes));
        exit;
        // return 11;
    }

    public function runRegisteredSupplies(HTTPRequest $request)
    {
        $controllerClass = null;

        $baseUrlPart = $request->param('Action');
        $reg = Config::inst()->get(static::class, 'registered_supplies');
        if (isset($reg[$baseUrlPart])) {
            $controllerClass = $reg[$baseUrlPart]['controller'];
        }

        if ($controllerClass && class_exists($controllerClass ?? '')) {
            return $controllerClass::create();
        }

        $msg = 'Error: no controller registered in ' . static::class . ' for: ' . $request->param('Action');

        throw new Exception($msg);
    }
}
