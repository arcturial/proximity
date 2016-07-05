<?php
namespace Arcturial\FormBuilder;

class Element
{
    public function __construct($type, $attrs)
    {
        $this->type = $type;
        $this->attrs = $attrs;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getAttrs()
    {
        return $this->attrs;
    }
}