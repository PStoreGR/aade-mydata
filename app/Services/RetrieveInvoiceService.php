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
     * @param string $mark
     * 
     * @return string
     */
    public function withMark($mark): string
    {
        $this->mark = $mark;
        return $this->mark;
    }
}
