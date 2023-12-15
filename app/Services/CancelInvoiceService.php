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
     * @return self
     */
    public function cancel(): self
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
        return $mark;
    }
}
