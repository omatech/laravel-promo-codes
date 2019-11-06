<?php

namespace Omatech\LaravelPromoCodes\Values;

class Relation
{

    /**
     * @var int
     */
    private $promoCodeId;
    /**
     * @var int
     */
    private $modelId;
    /**
     * @var string
     */
    private $modelType;

    /**
     * Relation constructor.
     * @param int $promoCodeId
     * @param int $modelId
     * @param string $modelType
     * @throws \Exception
     */
    public function __construct(
        int $promoCodeId,
        int $modelId,
        string $modelType)
    {
        if (empty($modelType)) {
            throw new \Exception(); //TODO
        }

        if ($promoCodeId === 0 || $modelId === 0) {
            throw new \Exception(); //TODO
        }

        $this->promoCodeId = $promoCodeId;
        $this->modelId = $modelId;
        $this->modelType = $modelType;
    }

    /**
     * @return int
     */
    public function getPromoCodeId(): int
    {
        return $this->promoCodeId;
    }

    /**
     * @return int
     */
    public function getModelId(): int
    {
        return $this->modelId;
    }

    /**
     * @return string
     */
    public function getModelType(): string
    {
        return $this->modelType;
    }

}