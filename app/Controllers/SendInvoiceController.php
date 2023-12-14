<?php

namespace Pstoregr\Myaade\Controllers;

use Firebed\AadeMyData\Models\InvoicesDoc;
use Pstoregr\Myaade\Services\SendInvoiceService;

/**
 * SendInvoiceController class 
 * 
 * Handles create invoice
 */
class SendInvoiceController
{
    /**
     * @var private SendInvoiceService $sendInvoiceService
     */
    private SendInvoiceService $sendInvoiceService;

    /**
     * @param array $args
     * 
     * @var SendInvoiceService $sendInvoiceService
     * 
     * @return self
     */
    public function createInvoice(array $args): self
    {
        $this->sendInvoiceService = (new SendInvoiceService);
        $this->sendInvoiceService->create()->invoice($args);
        return $this;
    }

    /**
     * @var SendInvoiceService $sendInvoiceService
     * 
     * @return InvoicesDoc
     */
    public function getInvoicesDoc(): InvoicesDoc
    {
        return $this->sendInvoiceService->preparedInvoicesDoc();
    }
}
