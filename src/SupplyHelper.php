<?php

namespace Goldfinch\CLISupplier;

class SupplyHelper
{
    public static function supply($supplier): array
    {
        $response = shell_exec(
            'php vendor/silverstripe/framework/cli-script.php dev/cli-supplier/' . $supplier,
        );

        return json_decode($response, true);
    }
}
