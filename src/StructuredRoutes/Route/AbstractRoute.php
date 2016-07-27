<?php

namespace MS\StructuredRoutes\Route;

abstract class AbstractRoute implements RouteInterface
{

    /** @var string */
    private $pattern;


    /** @var RouteInterface */
    private $parent;

    /** @var RouteInterface[] */
    private $children = [];


    public function __construct($pattern, $parent = null, $children = [])
    {
        $this->pattern = $pattern;
        $this->children = $children;
        $this->parent = $parent;
    }

    public function setPattern(RouteInterface $pattern)
    {
        $this->pattern = $pattern;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getAbsoluteUrl()
    {
        return implode('/', array_map(function(RouteInterface $route) {
            return trim($route->getPattern(), '/');
        }, $this->getPathToRoot()));
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
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
        $this->children[] = $child;
        $child->setParent($this);
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getAllChildren()
    {
        $queue = $this->getChildren();
        $children = [];

        while (count($queue) > 0) {
            $route = array_shift($queue);
            $children[] = $route;

            $queue = array_merge($queue, $route->getChildren());
        }

        return $children;
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

    public function getParameters()
    {
        if (preg_match_all('#({[a-zA-Z0-9\-_]+})[/|\z]*#', $this->getAbsoluteUrl(), $matches)) {
            return $matches[1];
        } else {
            return [];
        }
    }

    public function hasParameters()
    {
        return count($this->getParameters()) > 0;
    }

    /**
     * @return RouteInterface[]
     */
    public function getPathToRoot()
    {
        $path = [];
        $route = $this;
        while ($route != null) {
            $path[] = $route;
            $route = $route->getParent();
        }

        return array_reverse($path);
    }

}