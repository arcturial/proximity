<?php
namespace App;

class Paging
{
    const DEFAULT_OFFSET = 1;

    public function __construct($page, $offset = self::DEFAULT_OFFSET)
    {
        $this->page = $page;
        $this->offset = $offset ? : self::DEFAULT_OFFSET;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getOffset()
    {
        return $this->offset;
    }
}