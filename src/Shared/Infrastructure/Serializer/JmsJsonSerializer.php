<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Serializer;

use JMS\Serializer\SerializerInterface;

class JmsJsonSerializer implements Serializer
{
    private const FORMAT = 'json';

    /** @var SerializerInterface  */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize($data): string
    {
        return $this->serializer->serialize($data, self::FORMAT);
    }

    public function deserialize(string $json, string $type): string
    {
        return $this->serializer->deserialize($json, $type, self::FORMAT);
    }
}