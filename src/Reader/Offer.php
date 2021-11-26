<?php

declare(strict_types=1);

namespace App\Reader;

use App\Reader\Interfaces\OfferInterface;

/**
 * Class Offer
 * @package App\Reader
 */
class Offer implements OfferInterface
{
    /**
     * @param int $offerId
     * @param string|null $productTitle
     * @param int|null $vendorId
     * @param float|null $price
     */
    public function __construct(
        private ?int $offerId,
        private ?string $productTitle,
        private ?int $vendorId,
        private ?float $price,
    ){}

    /**
     * @return int|null
     */
    public function getOfferId(): ?int
    {
        return $this->offerId;
    }

    /**
     * @param int|null $offerId
     */
    public function setOfferId(?int $offerId): void
    {
        $this->offerId = $offerId;
    }

    /**
     * @return string|null
     */
    public function getProductTitle(): ?string
    {
        return $this->productTitle;
    }

    /**
     * @param string|null $productTitle
     */
    public function setProductTitle(?string $productTitle): void
    {
        $this->productTitle = $productTitle;
    }

    /**
     * @return int|null
     */
    public function getVendorId(): ?int
    {
        return $this->vendorId;
    }

    /**
     * @param int|null $vendorId
     */
    public function setVendorId(?int $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }
}