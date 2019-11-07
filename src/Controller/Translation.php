<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\GraphQL\Translations\Controller;

use OxidEsales\GraphQL\Base\Service\LegacyServiceInterface;
use OxidEsales\GraphQL\Translations\Dao\TranslationDaoInterface;
use OxidEsales\GraphQL\Translations\DataObject\Translation as TranslationDataObject;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Right;

class Translation
{
    /** @var TranslationDaoInterface */
    protected $translationDao;

    /** @var LegacyServiceInterface */
    private $legacyService = null;

    public function __construct(
        TranslationDaoInterface $translationDao,
        LegacyServiceInterface $legacyService
    ) {
        $this->translationDao = $translationDao;
        $this->legacyService = $legacyService;
    }

    /**
     * @Query
     */
    public function translation(string $languageId, string $key): ?TranslationDataObject
    {
        return $this->translationDao->getTranslationByKey(
            $languageId,
            $key,
            $this->legacyService->getShopId()
        );
    }

    /**
     * @Query
     * @return TranslationDataObject[]
     */
    public function translations(string $languageId): array
    {
        return $this->translationDao->getTranslations(
            $languageId,
            $this->legacyService->getShopId()
        );
    }

    /**
     * @Mutation
     * @Logged
     * @Right("TRANSLATION_CREATE")
     */
    public function translationCreate(TranslationDataObject $translation): TranslationDataObject
    {
        return $this->translationDao->createTranslation(
            $translation,
            $this->legacyService->getShopId()
        );
    }
}