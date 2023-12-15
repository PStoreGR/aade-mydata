<?php

namespace Pstoregr\Myaade\Requests;

use Firebed\AadeMyData\Http\CancelInvoice;
use Firebed\AadeMyData\Models\ResponseDoc;

/**
 * CancelInvoiceRequest class
 * 
 * Send cancellation request && get the response
 */
class CancelInvoiceRequest
{
    /**
     * @var ResponseDoc $response
     */
    private ResponseDoc $response;

    /**
     * @var CancelInvoice $cancelInvoice
     */
    private CancelInvoice $cancelInvoice;

    /** 
     * @param string $mark
     * 
     * @var CancelInvoice $cancelInvoice
     * @var ResponseDoc $response
     *
     * @return self
     */
    public function send($mark): self
    {
        /**
         * TODO: fix handle params
         * 
         * public function handle(
         *       string $mark, ?string $entityVatNumber = null
         * ): ResponseDoc { }         * 
         */
        $this->response = $this->cancelInvoice->handle($mark);
        return $this;
    }

    /** 
     * @param bool $print
     * 
     * @var ResponseDoc $response
     * @var array $errors
     * 
     * @return ResponseDoc | void
     */
    public function response($print = false): ResponseDoc
    {
        // TODO: fix response

        $response = $this->response;
        if ($print) {
            $errors = [];
            foreach ($response as $responseType) {
                if ($responseType->isSuccessful()) {
                    print("Success! \n");
                    print("\n");
                    // This invoice was successfully registered. Typically, you should have an invoice object of your
                    // own and an invoice reference from myDATA, and you will have to relate these together. 
                    // Each responseType has an index value which corresponds to the index of the invoice in 
                    // the $invoicesDoc object, you can use this index value to find the invoice it is referred to.
                    // Afterwards, get the invoice's uid and mark values from the responseType,
                    // relate them with your local invoice and save them in your database.
                    $index = $responseType->getIndex();
                    $uid = $responseType->getInvoiceUid();
                    $mark = $responseType->getInvoiceMark();
                    $cancelledByMark = $responseType->getCancellationMark();

                    print("Index: $index \n");
                    print("Uid: $uid \n");
                    print("Mark: $mark \n");
                    print("CancelledByMark: $cancelledByMark \n");
                    print("\n");
                } else {
                    // There were some errors for this specific invoice. See errors for details.
                    foreach ($responseType->getErrors() as $error) {
                        $errors[$responseType->getIndex()][] = $error->getCode() . ': ' . $error->getMessage();
                        print("\n");
                        print("Error!! : " . $error->getMessage);
                        print("\n");
                    }
                }
            }

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    foreach ($error as $e) {
                        print('error: ' . $e);
                        print("\n");
                    }
                }
            }
        }

        return $response;
    }
}
