<?php

namespace Pstoregr\Myaade\Validators;

/**
 * SendInvoiceValidator class
 * 
 * Handles invoice validations
 */
class SendInvoiceValidator
{
    /**
     * @var array $invoice
     */
    private array $invoice;

    /**
     * @param array $invoice
     * @return self
     */
    public function validate($invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * @var array $invoice
     * 
     * @return self
     */
    public function issuer(): self
    {
        $issuer = $this->invoice['issuer'];

        $this->isArray($issuer);

        $this->isEmptyIssuer($issuer);
        echo "validate issuer \n";
        return $this->isString($issuer['afm'])
            ->isString($issuer['country'])
            ->isInt($issuer['branch']);
    }

    /**
     * @var array $invoice
     * 
     * @return self
     */
    public function customer(): self
    {
        $customer = $this->invoice['customer'];

        $this->isArray($customer);

        $this->isEmptyCustomer($customer);
        echo "validate customer \n";
        return $this
            // address
            ->isString($customer['postaCode'])
            ->isString($customer['city'])
            // counterpart
            ->isString($customer['afm'])
            ->isString($customer['country'])
            ->isInt($customer['branch'])
            // invoiceHeader
            ->isString($customer['series'])
            ->isString($customer['aa'])
            ->isString($customer['issueDate'])
            ->isString($customer['currency'])
            ->isString($customer['dispatchDate'])
            ->isString($customer['dispatchTime'])
            ->isString($customer['vehicleNumber'])
            // paymentMethodDetail
            ->isFloat($customer['paymentMethodAmount'])
            ->isString($customer['paymentMethodInfo'])
            // incomeClassification
            ->isFloat($customer['incomeClassificationAmount'])
            // invoicedetails
            ->isInt($customer['lineNumber'])
            ->isFloat($customer['netValue'])
            ->isFloat($customer['vatAmount'])
            ->isBool($customer['discountOption'])
            // invoiceSummary   
            ->isFloat($customer['totalNetValue'])
            ->isFloat($customer['totalVatAmount'])
            ->isFloat($customer['totalWithHeldAmount'])
            ->isFloat($customer['totalFeesAmount'])
            ->isFloat($customer['totalStampDutyAmount'])
            ->isFloat($customer['totalOtherTaxesAmount'])
            ->isFloat($customer['totalDeductionsAmount'])
            ->isFloat($customer['totalGrossValue']);
    }

    /**
     * @param array $issuer
     * 
     * @return void
     */
    public function isEmptyIssuer($issuer): void
    {
        foreach ($issuer as $issuer_key => $issuer_value) {
            if (empty($this->isString($issuer_key)) || strlen($issuer_key) === 0) {
                echo "Error! You missing key on null => $issuer_value ! \n";
                die();
            }

            if (empty($issuer_value)) {
                echo "Error! You missing value on $issuer_key ! \n";
                die();
            }
        }
    }

    /**
     * @param array $customer
     * 
     * @return void
     */
    public function isEmptyCustomer($customer): void
    {
        foreach ($customer as $customer_key => $customer_value) {
            if (empty($this->isString($customer_key)) || strlen($customer_key) === 0) {
                echo "Error! You missing key on null => $customer_value ! \n";
                die();
            }
        }
    }

    /**
     * @param string $field
     * 
     * @return self
     */
    public function isString($field): self
    {
        if (!is_string($field)) {
            echo "Error! $field must be type of string ! \n";
            die();
        }

        return $this;
    }

    /**
     * @param int $field
     * 
     * @return self
     */
    public function isInt($field): self
    {

        if (!is_int($field)) {
            echo "Error! $field must be type of int ! \n";
            die();
        }

        return $this;
    }


    /**
     * @param float $field
     * 
     * @return self
     */
    public function isFloat($field): self
    {

        if (!is_float($field)) {
            echo "Error! $field must be type of float ! \n";
            die();
        }

        return $this;
    }

    /**
     * @param bool $field
     * 
     * @return self
     */
    public function isBool($field): self
    {

        if (!is_bool($field)) {
            echo "Error! $field must be type of boolean ! \n";
            die();
        }

        return $this;
    }

    /**
     * @param array $array
     * 
     * @return self
     */
    public function isArray($array): self
    {

        if (!is_array($array)) {
            echo "Error! Invoice must type of Array! \n";
            die();
        }

        return $this;
    }
}
