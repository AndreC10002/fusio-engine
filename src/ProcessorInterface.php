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

namespace Fusio\Engine;

use Fusio\Engine\Exception\ActionNotFoundException;
use Fusio\Engine\Exception\FactoryResolveException;
use PSX\Dependency\Exception\AutowiredException;
use PSX\Dependency\Exception\NotFoundException;

/**
 * The processor can be used to invoke another action. Normally an action should only contain simple logic but in some
 * cases you may want to invoke an existing action
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    https://www.fusio-project.org
 */
interface ProcessorInterface
{
    /**
     * Executes a specific action using the request and context and returns a response. It is recommended to use the
     * action name but you can also use the actual database id of the action
     *
     * @throws ActionNotFoundException
     * @throws FactoryResolveException
     * @throws AutowiredException
     * @throws NotFoundException
     */
    public function execute(string|int $actionId, RequestInterface $request, ContextInterface $context): mixed;
}
