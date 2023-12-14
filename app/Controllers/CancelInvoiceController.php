<?php

namespace Pstoregr\Myaade\Controllers;

use Pstoregr\Myaade\Services\CancelInvoiceService;

/**
 * CancelInvoiceController class
 * 
 * Handles cancel invoice
 */
class CancelInvoiceController
{
    /**
     * @var CancelInvoiceService $cancelInvoiceService
     */
    private CancelInvoiceService $cancelInvoiceService;

    /**
     * @param string $mark
     * 
     * @var CancelInvoiceService $cancelInvoiceService
     * 
     * @return string
     */
    public function cancelInvoice($mark): string
    {
        return $this->cancelInvoiceService->withMark($mark);
    }
}
