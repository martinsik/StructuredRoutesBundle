<?php

namespace MS\StructuredRoutes\Route;

interface RouteInterface
{

    public function setPattern(RouteInterface $pattern);

    public function getPattern();
    
    public function getAbsoluteUrl();


    public function setTarget($target);

    public function getTarget();


    public function setParent($parent);
    
    public function getParent();

    public function moveTo(RouteInterface $parent);


    public function addChild(RouteInterface $child);

    public function getChildren();

    public function getAllChildren();

    public function removeChild(RouteInterface $child);
}
