<?php

namespace Pstoregr\Myaade\Requests;

use Firebed\AadeMyData\Http\RequestDocs;
use Firebed\AadeMyData\Models\RequestedDoc;

/**
 * RetrieveInvoiceRequest class
 */
class RetrieveInvoiceRequest
{
    /**
     * @var RequestedDoc $response
     */
    private RequestedDoc $response;

    /**
     * @var RequestDocs $requestDocs
     */
    private RequestDocs $requestDocs;

    /**
     * Sends the cancelation request
     * 
     * @param string $mark
     * 
     * @var RequestDocs $requestDocs
     * @var RequestedDoc $response
     *
     * @return self
     */
    public function send($mark): self
    {
        /**
         * TODO: fix handle params
         * 
         * public function handle(
         * string $mark = '',
         * ?string $dateFrom = null,
         * ?string $dateTo = null,
         * ?string $receiverVatNumber = null,
         * ?string $entityVatNumber = null,
         * ?string $invType = null,
         * ?string $maxMark = null,
         * ?string $nextPartitionKey = null,
         * ?string $nextRowKey = null
         * ): RequestedDoc { }
         */
        $this->response = $this->requestDocs->handle($mark);
        return $this;
    }

    /**
     * @param bool $print
     * 
     * @var RequestedDoc $response
     * @var array $errors
     * 
     * @return RequestedDoc | void
     */
    public function response($print = false): RequestedDoc
    {
        // TODO: fix response
        $response = $this->response;
        var_dump($response);
        die;
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
