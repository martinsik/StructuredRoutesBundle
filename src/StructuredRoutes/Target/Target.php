<?php

namespace MS\StructureRoutes\Target;

class Target implements TargetInterface
{

    private $statusCode;

    private $resource;


    public function __construct($resource, $statusCode)
    {
        $this->statusCode = $statusCode;
        $this->resource = $resource;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function getResource()
    {
        return $this->resource;
    }

}