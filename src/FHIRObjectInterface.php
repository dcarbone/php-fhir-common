<?php namespace FHIR\Common;

use DCarbone\CollectionPlus\JsonSerializable;

/**
 * Interface FHIRObjectInterface
 * @package FHIR
 */
interface FHIRObjectInterface extends \Serializable, JsonSerializable
{
    /**
     * @return string
     */
    public function __toString();
}