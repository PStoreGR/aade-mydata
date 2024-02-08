<?php

namespace Pstoregr\Myaade\Controllers;

use Pstoregr\Myaade\Services\CancelInvoiceService;

/**
 * CancelInvoiceController class
 * 
 * Handles cancel invoice
 */
class CancelInvoiceController extends CancelInvoiceService
{
    /**
     * @param string $mark
     * 
     * @return string
     */
    public function cancelInvoice(string $mark): string
    {
        return $this->cancel()->invoice($mark);
    }
}
