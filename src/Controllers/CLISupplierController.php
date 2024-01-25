<?php

namespace Goldfinch\CLISupplier\Controllers;

use Exception;
use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Config;
use SilverStripe\Control\HTTPRequest;
use Goldfinch\CLISupplier\CLISupplier;
use SilverStripe\Control\HTTPResponse;
use Goldfinch\CLISupplier\Controllers\SupplierController;

class CLISupplierController extends Controller
{
    private static $url_handlers = [
        '' => 'index',
        '$Supply!' => 'runRegisteredSupplies',
    ];

    private static $allowed_actions = [
        'index',
        'runRegisteredSupplies',
    ];

    private static $registered_supplies = [];

    protected function init()
    {
        parent::init();

        if (!Director::is_cli()) {
            return $this->httpError(404);
        }
    }

    public function index(HTTPRequest $request)
    {
        exit;
    }

    public function runRegisteredSupplies(HTTPRequest $request)
    {
        $controllerClass = null;
        $supply = $request->param('Supply');

        $suppliers = Config::inst()->get(static::class, 'registered_supplies');

        if (isset($suppliers[$supply])) {
            $supplier = $suppliers[$supply];
        }

        if (isset($supplier) && is_string($supplier) && is_subclass_of($supplier, CLISupplier::class)) {
            return json_encode($supplier::run());
        }

        $msg = 'Error: no supplier registered in ' . static::class . ' for: ' . $supply;

        throw new Exception($msg);
    }
}
