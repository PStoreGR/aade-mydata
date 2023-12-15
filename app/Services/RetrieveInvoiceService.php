<?php

namespace Pstoregr\Myaade\Services;

/**
 * RetrieveInvoiceService class
 */
class RetrieveInvoiceService
{
    /**
     * @var string $mark
     */
    private string $mark;

    /** 
     * @return self
     */
    public function retrieve(): self
    {
        return $this;
    }

    /**
     * @param string $mark
     * 
     * @return string
     */
    public function invoice($mark): string
    {
        $this->mark = $mark;
        return $this->mark;
    }
}
