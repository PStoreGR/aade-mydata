<?php

namespace Pstoregr\Myaade\Controllers;

use Pstoregr\Myaade\Services\RetrieveInvoiceService;

/**
 * SendInvoiceController class 
 * 
 * Handles retrieve invoice
 */
class RetrieveInvoiceController
{
    /**
     * @var RetrieveInvoiceService $retrieveInvoiceService
     */
    private RetrieveInvoiceService $retrieveInvoiceService;

    /**
     * @param string $mark
     * 
     * @var RetrieveInvoiceService $retrieveInvoiceService
     * 
     * @return string
     */
    public function retrieveInvoice($mark): string
    {
        return $this->retrieveInvoiceService->withMark($mark);
    }
}
