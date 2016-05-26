<?php

namespace MS\StructuredRoutes\Target;

interface TargetInterface
{
    public function setStatusCode($code);
    
    public function getStatusCode();
    
    
    public function setResource($resource);
    
    public function getResource();
}