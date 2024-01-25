<?php

namespace Goldfinch\CLISupplier\Controllers;

use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;

class CLISupplierController extends Controller
{
    private static $url_handlers = [];

    private static $allowed_actions = [];

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
}
