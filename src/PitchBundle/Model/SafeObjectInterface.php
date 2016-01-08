<?php

namespace PitchBundle\Model;

interface SafeObjectInterface
{

    /**
     * Returns a safe object of this entity
     * @return object safeObject
     */
    public function getSafeObject();
}