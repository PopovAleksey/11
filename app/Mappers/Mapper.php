<?php

namespace App\Mappers;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class Mapper
{
    private Collection $collection;

    public function get(): Collection
    {
        return $this->getByRecursion($this->collection);
    }

    public function handler(array $data): self
    {
        $this->collection = $this->collection(collect($data));

        return $this;
    }

    private function getByRecursion(Collection $collection): Collection
    {
        return $collection->map(function ($value) {
            if ($value instanceof Mapper) {
                return $this->getByRecursion($value->get());
            }

            return $value;
        });
    }

    private function collection(Collection $data): Collection
    {
        $className = get_class($this);

        try {
            $reflect = new ReflectionClass($className);
            $properties = $reflect->getProperties(ReflectionProperty::IS_PROTECTED);

        } catch (ReflectionException $e) {

            return $data;
        }

        $properties = collect($properties)
            ->map(function ($property) {
                return [
                    'name' => $property->getName(),
                    'type' => $property->getType()->getName(),
                    'comment' => $property->getDocComment()
                ];
            })
            ->keyBy('name');

        return $data->map(function ($value, $field) use ($properties) {
            $type = data_get($properties->get($field), 'type');
            $comment = data_get($properties->get($field), 'comment');

            if ($type === null) {
                return null;
            }

            if (class_exists($type) && app($type) instanceof Mapper) {
                $value = app($type)->handler($value);
                $this->$field = $value;

                return $value;
            }

            if ($type == 'array') {
                $value = $this->collectionArray($value, $field, $comment);
            }

            settype($value, $type);
            $this->$field = $value;

            return $value;

        })->reject(function ($item) {
            return $item === null;
        });
    }

    private function collectionArray(array $value, string $field, string $comment): array
    {
        preg_match("/@var array<(.+)>(.+)?/", $comment, $match);
        $classIntoArray = data_get($match, 1);

        if (!class_exists($classIntoArray)) {
            return $value;
        }

        $valueHandler = [];

        collect($value)->each(function ($arrayItem) use ($classIntoArray, &$valueHandler) {
            $valueHandler[] = app($classIntoArray)->handler($arrayItem)->get();
        });

        $this->$field = $valueHandler;

        return $valueHandler;
    }
}
