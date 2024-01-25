<?php

namespace Goldfinch\CLISupplier;

class SupplyHelper
{
    public static function supply($supplier, $args = [])
    {
        $response = shell_exec(
            'php vendor/silverstripe/framework/cli-script.php dev/cli-supplier/' . $supplier . ' "args='.addslashes(json_encode($args)).'"',
        );

        return json_decode($response, true);
    }
}
