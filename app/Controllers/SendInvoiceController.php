<?php

namespace Pstoregr\Myaade\Controllers;

use Firebed\AadeMyData\Models\InvoicesDoc;
use Pstoregr\Myaade\Services\SendInvoiceService;

/**
 * SendInvoiceController class 
 * 
 * Handles create invoice
 */
class SendInvoiceController extends SendInvoiceService
{
    /**
     * @param array $args
     * 
     * @return self
     */
    public function createInvoice(array $args): self
    {
        $this->create()->invoice($args);
        return $this;
    }

    /**
     * @var SendInvoiceService $sendInvoiceService
     * 
     * @return InvoicesDoc
     */
    public function getInvoicesDoc(): InvoicesDoc
    {
        return $this->preparedInvoicesDoc();
    }
}
