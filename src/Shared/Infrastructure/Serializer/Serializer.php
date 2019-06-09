<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Serializer;

interface Serializer
{
    public function serialize($data): string;

    public function deserialize(string $json, string $type): string;
}