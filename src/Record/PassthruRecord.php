<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015-2021 Christoph Kappestein <christoph.kappestein@gmail.com>
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

namespace Fusio\Engine\Record;

use PSX\Record\Record;
use PSX\Record\RecordInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * This record is used if a route has specified the passthru schema that means that we redirect the result from the
 * reader to the action. I.e. in case of json this contains a stdClass and for xml a DOMDocument
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 * @extends Record<mixed>
 */
class PassthruRecord extends Record
{
    private mixed $payload;
    private PropertyAccessor $accessor;

    public function __construct(mixed $payload)
    {
        parent::__construct($this->toIterable($payload));

        $this->payload  = $payload;
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getProperty(string $name): mixed
    {
        return $this->accessor->getValue($this->payload, $name);
    }

    public function setProperty(string $name, mixed $value): void
    {
        $this->accessor->setValue($this->payload, $name, $value);
    }

    public function removeProperty(string $name): void
    {
    }

    public function hasProperty(string $name): bool
    {
        return $this->accessor->isReadable($this->payload, $name);
    }

    private function toIterable(mixed $payload): iterable
    {
        if (!is_iterable($payload)) {
            return [];
        }

        return $payload;
    }
}
