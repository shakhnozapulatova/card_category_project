<?php


namespace App\Enums;


class ProductStatus
{
    const DRAFT = 'draft';
    const PENDING = 'pending';
    const PUBLISHED = 'published';

    public static function getStatuses(): array
    {
        return [
           self::DRAFT,
           self::PUBLISHED,
           self::PENDING
        ];
    }
}
