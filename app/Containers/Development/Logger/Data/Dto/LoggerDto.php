<?php

namespace App\Containers\Development\Logger\Data\Dto;

use Illuminate\Contracts\Support\Arrayable;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonException;

/**
 * Class FilterDto
 * @package App\Services\ContactService\Dto
 */
class LoggerDto implements Arrayable
{
    private ?string $hash     = NULL;
    private ?string $request  = NULL;
    private string  $type     = 'sql';
    private ?string $query    = NULL;
    private array   $bindings = [];
    private ?float  $time     = NULL;

    public function getHash(): ?string
    {
        return $this->hash ?? NULL;
    }

    public function setHash(?string $hash): self
    {
        $this->hash = $hash ?? uniqid('', true);

        return $this;
    }

    public function getRequest(): ?string
    {
        return $this->request ?? NULL;
    }

    public function setRequest(string $urlPath): self
    {
        $this->request = $urlPath;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQuery(): ?string
    {
        return $this->query ?? NULL;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getBindings(): string
    {
        try {
            return json_encode($this->bindings ?? [], JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return "";
        }
    }

    public function setBindings(array $bindings): self
    {
        $this->bindings = $bindings;

        return $this;
    }

    public function getMilliseconds(): float
    {
        return $this->time ?? 0.00;
    }

    public function getSeconds(): int
    {
        return (int) (($this->time ?? 0.00) / 1000);
    }

    public function setTime(float $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return array
     */
    #[Pure] #[ArrayShape(['hash' => "null|string", 'request' => "null|string", 'type' => "string", 'query' => "null|string", 'bindings' => "array", 'time' => "float", 'timeSeconds' => "int"])]
    public function toArray(): array
    {
        return [

            'hash'        => $this->getHash(),
            'request'     => $this->getRequest(),
            'type'        => $this->getType(),
            'query'       => $this->getQuery(),
            'bindings'    => $this->getBindings(),
            'time'        => $this->getMilliseconds(),
            'timeSeconds' => $this->getSeconds(),
        ];
    }
}
