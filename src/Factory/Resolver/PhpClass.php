<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015-2022 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fusio\Engine\Factory\Resolver;

use Fusio\Engine\ActionInterface;
use Fusio\Engine\Exception\FactoryResolveException;
use Fusio\Engine\Factory\ResolverInterface;
use PSX\Dependency\AutowireResolverInterface;

/**
 * PhpClass
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    https://www.fusio-project.org
 */
class PhpClass implements ResolverInterface
{
    private AutowireResolverInterface $autowireResolver;

    public function __construct(AutowireResolverInterface $autowireResolver)
    {
        $this->autowireResolver = $autowireResolver;
    }

    public function resolve(string $className): ActionInterface
    {
        if (!class_exists($className)) {
            throw new FactoryResolveException('Could not resolve class ' . $className);
        }

        return $this->autowireResolver->getObject($className);
    }
}
