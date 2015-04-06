<?php namespace FHIR\Common;

use FHIR\Common\Exception\InvalidCollectionValueException;
use FHIR\Common\Exception\InvalidPropertyNameException;
use FHIR\Common\Exception\InvalidPropertyValueTypeException;

/**
 * Class AbstractFHIRObject
 * @package FHIR
 */
abstract class AbstractFHIRObject implements FHIRObjectInterface
{
    /**
     * @param string $param
     * @return InvalidPropertyNameException
     */
    protected function createInvalidPropertyNameException($param)
    {
        return new InvalidPropertyNameException(
            sprintf('Property "%s" does not exist on %s',
                $param,
                get_class($this)
            )
        );
    }

    /**
     * @param string $property
     * @param string $expected
     * @param mixed $actual
     * @return InvalidPropertyValueTypeException
     */
    protected function createInvalidPropertyValueTypeException($property, $expected, $actual)
    {
        return new InvalidPropertyValueTypeException(
            sprintf('Property %s::%s expected to be of type %s, %s seen.',
                get_class($this),
                $property,
                $expected,
                is_object($actual) ? get_class($actual) : gettype($actual)
            )
        );
    }

    /**
     * @param string $collection
     * @param string $expected
     * @param mixed $actual
     * @return InvalidCollectionValueException
     */
    protected function createInvalidCollectionValueException($collection, $expected, $actual)
    {
        return new InvalidCollectionValueException(
            sprintf('Collection %s::%s accepts values of type %s, %s seen.',
                get_class($this),
                $collection,
                $expected,
                is_object($actual) ? get_class($actual) : gettype($actual)
            )
        );
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        // TODO: Implement this...
    }

    /**
     * (PHP 5 >= 5.1.0)
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(get_object_vars($this));
    }

    /**
     * (PHP 5 >= 5.1.0)
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized The string representation of the object.
     * @return void
     */
    public function unserialize($serialized)
    {
        foreach(unserialize($serialized) as $k=>$v)
        {
            $this->$k = $v;
        }
    }

    /**
     * @return null|string
     */
    public function __toString()
    {
        return get_class($this);
    }
}