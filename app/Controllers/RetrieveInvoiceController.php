<?php

namespace Pstoregr\Myaade\Controllers;

use Pstoregr\Myaade\Services\RetrieveInvoiceService;

/**
 * SendInvoiceController class 
 * 
 * Handles retrieve invoice
 */
class RetrieveInvoiceController extends RetrieveInvoiceService
{
    /**
     * @param string $mark
     * 
     * @return string
     */
    public function retrieveInvoice(string $mark): string
    {
        return $this->retrieve()->invoice($mark);
    }
}
