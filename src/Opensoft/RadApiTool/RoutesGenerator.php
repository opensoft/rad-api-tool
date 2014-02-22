<?php

/**
 * This file is part of the Rad Api Tool.
 *
 * Copyright (c) OpenSoft (http://www.opensoftdev.ru)
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Opensoft\RadApiTool;

use Opensoft\RadApiTool\Utils;
use Opensoft\RadApiTool\Command\RoutesGeneratorCommand;

/**
 * @author Anton Volkov <anton.volkov@opensoftdev.ru>
 */
class RoutesGenerator
{
    /**
     * @param $vendorName
     * @param $bundleName
     * @param $entityName
     * @param $baseUrl
     */
    public function generator($vendorName, $bundleName, $entityName, $baseUrl)
    {
        $bundleNameUnderscore = Utils::toUnderscore($bundleName);
        $bundleNameCamelCase = Utils::toCamelCase($bundleName);
        $vendorNameUnderscore = Utils::toUnderscore($vendorName);
        $vendorNameCamelCase = Utils::toCamelCase($vendorName);
        
        $result =
            "########## Automated generated route for $entityName ##########\n" .
            strtolower($vendorNameUnderscore) . "_api_" . $bundleNameUnderscore . "_" . $entityName . "_cget:\n" .
            "   path: /" . $baseUrl . "/{id}.{format}\n" .
            "   defaults: { _controller: " . $vendorNameCamelCase . $bundleNameCamelCase . "Bundle:Api\\" . ucfirst($entityName) . ":cget, _format: json }\n" .
            "   methods: [GET]\n" .
            "   requirments:\n" .
            "   options:\n" .
            "       expose: true\n\n" .
            strtolower($vendorNameUnderscore) . "_api_" . $bundleNameUnderscore . "_" . $entityName . "_delete:\n" .
            "   path: /" . $baseUrl . "/{id}.{format}\n" .
            "   defaults: { _controller: " . $vendorNameCamelCase . $bundleNameCamelCase . "Bundle:Api\\" . ucfirst($entityName) . ":delete, _format: json }\n" .
            "   methods: [DELETE]\n" .
            "   requirments:\n" .
            "       id: \d+\n" .
            "   options:\n" .
            "       expose: true\n\n" .
            strtolower($vendorNameUnderscore) . "_api_" . $bundleNameUnderscore . "_" . $entityName . "_get:\n" .
            "   path: /" . $baseUrl . "/{id}.{format}\n" .
            "   defaults: { _controller: " . $vendorNameCamelCase . $bundleNameCamelCase . "Bundle:Api\\" . ucfirst($entityName) . ":get, _format: json }\n" .
            "   methods: [GET]\n" .
            "   requirments:\n" .
            "       id: \d+\n" .
            "   options:\n" .
            "       expose: true\n\n" .
            strtolower($vendorNameUnderscore) . "_api_" . $bundleNameUnderscore . "_" . $entityName . "_patch:\n" .
            "   path: /" . $baseUrl . "/{id}.{format}\n" .
            "   defaults: { _controller: " . $vendorNameCamelCase . $bundleNameCamelCase . "Bundle:Api\\" . ucfirst($entityName) . ":patch, _format: json }\n" .
            "   methods: [PATCH, POST]\n" .
            "   requirments:\n" .
            "       id: \d+\n" .
            "   options:\n" .
            "       expose: true\n\n" .
            strtolower($vendorNameUnderscore) . "_api_" . $bundleNameUnderscore . "_" . $entityName . "_post:\n" .
            "   path: /" . $baseUrl . "/{id}.{format}\n" .
            "   defaults: { _controller: " . $vendorNameCamelCase . $bundleNameCamelCase . "Bundle:Api\\" . ucfirst($entityName) . ":post, _format: json }\n" .
            "   methods: [POST]\n" .
            "   requirments:\n" .
            "       id: \d+\n" .
            "   options:\n" .
            "       expose: true\n" .
            "########## " . ucfirst($entityName) . " ##########"
        ;
        $entityForFileName = Utils::toUnderscore($entityName);
        file_put_contents("routing_for_$entityForFileName.yml", $result);
    }

    /**
     * @param $className
     * @param $properties
     * @return string
     */
    public function dtoGenerator($className, $properties)
    {
        $result = $className . ":\n\tproperties:\n";
        foreach ($properties as $property => $type) {
            $result .= "\t\t$property:\n";
            $result .= "\t\t\ttype: $type\n";
            $result .= "\t\t\texpose: true\n";
            $result .= sprintf(
                "\t\t\tserialized_name: %s\n",
                Utils::toUnderscore($property)
            );
        }

        return $result;
    }
}
