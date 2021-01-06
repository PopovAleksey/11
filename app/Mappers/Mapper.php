<?php

namespace App\Mappers;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class Mapper
 * @package App\Mappers
 */
class Mapper
{
    /**
     * @return array|Collection
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        return $this->getByClass($this);
    }

    /**
     * @param Mapper $classObject
     * @return array
     * @throws ReflectionException
     */
    private function getByClass(Mapper $classObject): array
    {
        $className  = get_class($classObject);
        $properties = (new ReflectionClass($className))->getProperties(ReflectionProperty::IS_PRIVATE);

        return collect($properties)->mapWithKeys(function (ReflectionProperty $property) use ($classObject) {
            $propertyName     = $property->getName();
            $propertyType     = $property->getType()->getName();
            $propertyComment  = $property->getDocComment();
            $getterMethodName = 'get' . ucfirst($propertyName);

            if (method_exists($classObject, $getterMethodName) === false) {
                return null;
            }

            $value = $classObject->$getterMethodName();

            if (class_exists($propertyType) && app($propertyType) instanceof Mapper) {
                $value = $this->getByClass($value);
            }

            if ($propertyType == 'array') {
                $value = $this->collectionArray($value, $propertyComment, false);
            }

            return [$propertyName => $value];
        })->reject(function ($item) {

            return $item === null;
        })->toArray();
    }

    /**
     * @param array $data
     * @return $this
     * @throws ReflectionException
     */
    public function handler(array $data): self
    {
        $className  = get_class($this);
        $properties = (new ReflectionClass($className))->getProperties(ReflectionProperty::IS_PRIVATE);

        $properties = collect($properties)->map(function ($property) {
            return [
                'name'    => $property->getName(),
                'type'    => $property->getType()->getName(),
                'comment' => $property->getDocComment(),
            ];
        })->keyBy('name');

        collect($data)->each(function ($value, $field) use ($properties) {
            $property         = $properties->get($field);
            $propertyType     = data_get($property, 'type');
            $propertyComment  = data_get($property, 'comment');
            $setterMethodName = 'set' . ucfirst($field);

            if (method_exists($this, $setterMethodName) === false) {
                return;
            }

            if ($propertyType === null) {
                return;
            }

            if (class_exists($propertyType) && app($propertyType) instanceof Mapper) {
                $value = app($propertyType)->handler($value);
                $this->$setterMethodName($value);

                return;
            }

            if ($propertyType == 'array') {
                $value = $this->collectionArray($value, $propertyComment);
            }

            settype($value, $propertyType);
            $this->$setterMethodName($value);
        });

        return $this;
    }

    /**
     * @param array $value
     * @param string $comment
     * @param bool $handler
     * @return array
     */
    private function collectionArray(array $value, string $comment, bool $handler = true): array
    {
        preg_match("/@var (.+)\[](.+)?/", $comment, $match);

        $classIntoArray = data_get($match, 1);

        if (!class_exists($classIntoArray)) {
            return $value;
        }

        return collect($value)->map(function ($arrayItem) use ($classIntoArray, $handler) {
            if ($handler === true) {
                return app($classIntoArray)->handler($arrayItem);
            }

            return $this->getByClass($arrayItem);
        })->toArray();
    }
}
