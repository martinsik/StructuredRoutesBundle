<?php

namespace MS\StructureRoutes\Route;

interface RouteInterface
{
    public function setName($name);

    public function getName();


    public function setPattern(RouteInterface $pattern);

    public function getPattern();
    
    public function generateStructure();


    public function setTarget($target);

    public function getTarget();


    public function getParent();

    public function moveTo(RouteInterface $parent);


    public function addChild(RouteInterface $child);

    public function getChildren();
    
    public function removeChild(RouteInterface $child);
}
