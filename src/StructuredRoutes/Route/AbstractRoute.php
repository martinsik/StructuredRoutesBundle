<?php

namespace MS\StructureRoutes\Route;

use MS\StructureRoutes\Target\Target;
use MS\StructureRoutes\Target\TargetInterface;

abstract class AbstractRoute implements RouteInterface
{

    /** @var string */
    private $name;

    /** @var string */
    private $pattern;

    /** @var TargetInterface|string */
    private $target;

    /** @var RouteInterface */
    private $parent;

    /** @var RouteInterface[] */
    private $children = [];


    public function __construct($name, $pattern, $target = null, $children = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPattern(RouteInterface $pattern)
    {
        $this->pattern = $pattern;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function generateStructure()
    {
        $patterns = [];
        $route = $this;
        while ($route != null) {
            $patterns[] = trim($route->getPattern(), '/');
            $route = $route->getParent();
        }

        return implode('/', array_reverse($patterns));
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


    public function getParent()
    {
        return $this->parent;
    }

    public function moveTo(RouteInterface $parent)
    {
        $this->parent->removeChild($this);
        $parent->addChild($this);
    }


    public function addChild(RouteInterface $child)
    {
        $child->setPattern($this);
        $this->children[] = $child;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function removeChild(RouteInterface $child)
    {
        foreach ($this->children as $index => $c) {
            if ($c === $child) {
                unset($this->children[$index]);
                return true;
            }
        }

        return false;
    }

}