<?php
namespace App;

use \Iterator;

class PaginatedResult implements Iterator
{
    public function __construct($result, Paging $paging, $rows)
    {
        $this->result = $result;
        $this->paging = $paging;
        $this->rows = $rows;
        $this->rewind();
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->result[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->result[$this->position]);
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getPaging()
    {
        return $this->paging;
    }

    public function isPaginated()
    {
        return $this->getRows() > ($this->getPage() * $this->getOffset());
    }

    public function hasPrevious()
    {
        return $this->getPage() > 0;
    }

    public function hasNext()
    {
        return (($this->getPage() * $this->getOffset()) + $this->getOffset()) < $this->getRows();
    }

    public function getPage()
    {
        return $this->getPaging()->getPage();
    }

    public function getPages()
    {
        return ceil($this->getRows() / $this->getOffset());
    }

    public function nextPageNumber()
    {
        return $this->getPage() + 1;
    }

    public function previousPageNumber()
    {
        return $this->getPage() - 1;
    }

    public function getOffset()
    {
        return $this->getPaging()->getOffset();
    }

    public function getRows()
    {
        return $this->rows;
    }
}