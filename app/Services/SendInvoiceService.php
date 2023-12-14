<?php

namespace Pstoregr\Myaade\Services;

use Firebed\AadeMyData\Models\Invoice;
use Firebed\AadeMyData\Models\InvoicesDoc;
use Pstoregr\Myaade\Models\SendInvoiceModel;

/**
 * SendInvoiceService class
 * 
 * Create && prepare the invoice
 */
class SendInvoiceService
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
     * @param array $args
     * 
     * @var SendInvoiceModel $sendInvoiceModel
     * @var Invoice $preparedInvoice
     * 
     * @return void
     */
    public function invoice($args): void
    {
        $this->sendInvoiceModel = new SendInvoiceModel();

        /**
         * Set Issuer
         */
        $this->sendInvoiceModel->setIssuer(
            $args['issuer']['afm'],
            $args['issuer']['country'],
            $args['issuer']['branch']
        );

        /**
         * Set Adress
         */
        $this->sendInvoiceModel->setAddress(
            $args['customer']['postaCode'],
            $args['customer']['city']
        );

        /**
         * Set CounterPart
         */
        $this->sendInvoiceModel->setCounterPart(
            $args['customer']['afm'],
            $args['customer']['country'],
            $args['customer']['branch']
        );

        /**
         * Set Invoice Header
         */
        $this->sendInvoiceModel->setInvoiceHeader(
            $args['customer']['series'],
            $args['customer']['aa'],
            $args['customer']['issueDate'],
            $args['customer']['currency'],
            $args['customer']['dispatchDate'],
            $args['customer']['dispatchTime'],
            $args['customer']['vehicleNumber']
        );

        /**
         * Set Payment Info Details
         */
        $this->sendInvoiceModel->setPaymentMethodDetail(
            $args['customer']['paymentMethodAmount'],
            $args['customer']['paymentMethodInfo']
        );

        /**
         * Set Income Classification
         */
        $this->sendInvoiceModel->setIncomeClassification(
            $args['customer']['incomeClassificationAmount']
        );

        /**
         * Set Invoice Details 
         */
        $this->sendInvoiceModel->setInvoicedetail(
            $args['customer']['lineNumber'],
            $args['customer']['netValue'],
            $args['customer']['vatAmount'],
            $args['customer']['discountOption']
        );

        /**
         * Set Summary
         */
        $this->sendInvoiceModel->setInvoiceSummary(
            $args['customer']['totalNetValue'],
            $args['customer']['totalVatAmount'],
            $args['customer']['totalWithHeldAmount'],
            $args['customer']['totalFeesAmount'],
            $args['customer']['totalStampDutyAmount'],
            $args['customer']['totalOtherTaxesAmount'],
            $args['customer']['totalDeductionsAmount'],
            $args['customer']['totalGrossValue']
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
        $this->invoicesDoc = new InvoicesDoc();
        $this->invoicesDoc->addInvoice($this->preparedInvoice);
        return $this->invoicesDoc ?? null;
    }
}
