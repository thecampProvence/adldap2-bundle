<?php
/*
 * This file is part of the sigu.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sgomez\Bundle\Adldap2Bundle\DependencyInjection;


use Adldap\Adldap;
use Adldap\Connections\Provider;
use Psr\Log\LoggerInterface;

class Adldap2Factory
{
    public static function createConnection(array $config)//, LoggerInterface $logger
    {
        $ad = new Adldap();
        $ad->addProvider(new Provider($config));
        $ad->connect();

        return $ad;
    }
}