<?php

namespace MS\StructuredRoutes\Route;

interface RouteInterface
{

    public function setPattern($pattern);

    public function getPattern();

    public function getParameters();

    public function hasParameters();

    public function getPathToRoot();

    public function getAbsoluteUrl();


//    public function setTarget($target);
//
//    public function getTarget();


    public function setParent($parent);
    
    public function getParent();

    public function moveTo(RouteInterface $parent);


    public function addChild(RouteInterface $child);

    public function getChildren();

    public function getAllChildren();

    public function removeChild(RouteInterface $child);
}
