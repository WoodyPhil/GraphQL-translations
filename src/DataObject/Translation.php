<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Translations\DataObject;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\GraphQL\Translations\Dao\TranslationDaoInterface;
use TheCodingMachine\GraphQLite\Annotations\Factory;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

/**
 * @Type()
 */
class Translation
{

    /** @var  string  */
    private $key;

    /** @var  string  */
    private $value;

    public function __construct(
        string $key,
        string $value

    ) {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @Field(outputType="ID")
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @Field()
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}
