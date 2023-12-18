<?php

namespace Pstoregr\Myaade\Services;

use Firebed\AadeMyData\Models\Invoice;
use Firebed\AadeMyData\Models\InvoicesDoc;
use Pstoregr\Myaade\Models\SendInvoiceModel;
use Pstoregr\Myaade\Validators\SendInvoiceValidator;

/**
 * SendInvoiceService class
 * 
 * Create && prepare the invoice
 */
class SendInvoiceService extends SendInvoiceValidator
{
    /**
     * @var SendInvoiceModel $sendInvoiceModel
     */
    private SendInvoiceModel $sendInvoiceModel;

    /**
     * @var Invoice $preparedInvoice
     */
    private Invoice $preparedInvoice;

    /**
     * @var InvoicesDoc $invoicesDoc
     */
    private InvoicesDoc $invoicesDoc;

    /**
     * @return self
     */
    public function create(): self
    {
        return $this;
    }

    /**
     * @param array $invoice
     * 
     * @var SendInvoiceModel $sendInvoiceModel
     * @var Invoice $preparedInvoice
     * 
     * @return void
     */
    public function invoice($invoice): void
    {
        /**
         * Validate The Invoice
         */
        $this->validate($invoice)->issuer();
        $this->validate($invoice)->customer();

        /**
         * Set Issuer
         */
        $this->sendInvoiceModel->setIssuer(
            $invoice['issuer']['afm'],
            $invoice['issuer']['country'],
            $invoice['issuer']['branch']
        );

        /**
         * Set Adress
         */
        $this->sendInvoiceModel->setAddress(
            $invoice['customer']['postaCode'],
            $invoice['customer']['city']
        );

        /**
         * Set CounterPart
         */
        $this->sendInvoiceModel->setCounterPart(
            $invoice['customer']['afm'],
            $invoice['customer']['country'],
            $invoice['customer']['branch']
        );

        /**
         * Set Invoice Header
         */
        $this->sendInvoiceModel->setInvoiceHeader(
            $invoice['customer']['series'],
            $invoice['customer']['aa'],
            $invoice['customer']['issueDate'],
            $invoice['customer']['currency'],
            $invoice['customer']['dispatchDate'],
            $invoice['customer']['dispatchTime'],
            $invoice['customer']['vehicleNumber']
        );

        /**
         * Set Payment Info Details
         */
        $this->sendInvoiceModel->setPaymentMethodDetail(
            $invoice['customer']['paymentMethodAmount'],
            $invoice['customer']['paymentMethodInfo']
        );

        /**
         * Set Income Classification
         */
        $this->sendInvoiceModel->setIncomeClassification(
            $invoice['customer']['incomeClassificationAmount']
        );

        /**
         * Set Invoice Details 
         */
        $this->sendInvoiceModel->setInvoicedetail(
            $invoice['customer']['lineNumber'],
            $invoice['customer']['netValue'],
            $invoice['customer']['vatAmount'],
            $invoice['customer']['discountOption']
        );

        /**
         * Set Summary
         */
        $this->sendInvoiceModel->setInvoiceSummary(
            $invoice['customer']['totalNetValue'],
            $invoice['customer']['totalVatAmount'],
            $invoice['customer']['totalWithHeldAmount'],
            $invoice['customer']['totalFeesAmount'],
            $invoice['customer']['totalStampDutyAmount'],
            $invoice['customer']['totalOtherTaxesAmount'],
            $invoice['customer']['totalDeductionsAmount'],
            $invoice['customer']['totalGrossValue']
        );

        $this->preparedInvoice = $this->sendInvoiceModel->setInvoice();
    }

    /**
     * @var InvoicesDoc $invoicesDoc
     * @var Invoice $preparedInvoice
     * 
     * @return InvoicesDoc | null
     */
    public function preparedInvoicesDoc(): InvoicesDoc | null
    {
        $this->invoicesDoc->addInvoice($this->preparedInvoice);
        return $this->invoicesDoc ?? null;
    }
}
