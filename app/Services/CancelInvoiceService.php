<?php

namespace Pstoregr\Myaade\Services;

/**
 * CancelInvoiceService class 
 * 
 * Handles cancel invoice
 */
class CancelInvoiceService
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
