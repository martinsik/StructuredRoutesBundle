<?php

namespace MS\StructuredRoutes\Route;

use MS\StructuredRoutes\Target\Target;
use MS\StructuredRoutes\Target\TargetInterface;

class Route extends AbstractRoute
{

    /** @var TargetInterface|string */
    private $target;

    public function __construct($pattern, $target = null, $parent = null, $children = [])
    {
        parent::__construct($pattern, $parent, $children);
        $this->target = $target;
    }

    public function setTarget($target)
    {
        if ($target instanceof RouteInterface) {
            $this->target = new Target($target, 302);
        } else {
            $this->target = $target;
        }
    }

    public function getTarget()
    {
        return $this->target;
    }
}