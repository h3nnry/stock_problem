<?php

declare(strict_types=1);

namespace App\Reader\Interfaces;

/**
 * Interface of Data Transfer Object, that represents external JSON data
 */
interface OfferInterface
{
    public function getOfferId(): ?int;

    public function setOfferId(?int $offerId): void;

    public function getProductTitle(): ?string;

    public function setProductTitle(?string $productTitle): void;

    public function getVendorId(): ?int;

    public function setVendorId(?int $vendorId): void;

    public function getPrice(): ?float;

    public function setPrice(?float $price): void;
}