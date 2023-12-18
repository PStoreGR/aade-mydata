<?php

namespace Pstoregr\Myaade\Models;

use Firebed\AadeMyData\Enums\IncomeClassificationCategory;
use Firebed\AadeMyData\Enums\IncomeClassificationType;
use Firebed\AadeMyData\Enums\InvoiceType;
use Firebed\AadeMyData\Enums\MovePurpose;
use Firebed\AadeMyData\Enums\PaymentMethod;
use Firebed\AadeMyData\Enums\VatCategory;

use Firebed\AadeMyData\Models\Issuer;
use Firebed\AadeMyData\Models\Address;
use Firebed\AadeMyData\Models\Counterpart;
use Firebed\AadeMyData\Models\InvoiceHeader;
use Firebed\AadeMyData\Models\PaymentMethodDetail;
use Firebed\AadeMyData\Models\IncomeClassification;
use Firebed\AadeMyData\Models\InvoiceDetails;
use Firebed\AadeMyData\Models\InvoiceSummary;
use Firebed\AadeMyData\Models\Invoice;

/**
 * SendInvoiceModel class 
 * 
 * Invoice skeleton
 */
class SendInvoiceModel
{
    /**
     *  @var Issuer $issuer
     */
    private Issuer $issuer;

    /**
     *  @var Address $address
     */
    private Address $address;

    /**
     *  @var Counterpart $counterpart
     */
    private Counterpart $counterpart;

    /**
     *  @var InvoiceHeader $invoiceHeader
     */
    private InvoiceHeader $invoiceHeader;

    /**
     *  @var PaymentMethodDetail $paymentMethodDetail
     */
    private PaymentMethodDetail $paymentMethodDetail;

    /**
     *  @var IncomeClassification $incomeClassification
     */
    private IncomeClassification $incomeClassification;

    /**
     *  @var InvoiceDetails $invoiceDetails
     */
    private InvoiceDetails $invoiceDetails;

    /**
     *  @var InvoiceSummary $invoiceSummary
     */
    private InvoiceSummary $invoiceSummary;

    /**
     *  @var Invoice $invoice
     */
    private Invoice $invoice;

    /**
     *  @var InvoiceType $invoiceType
     */
    private InvoiceType $invoiceType = InvoiceType::TYPE_1_4;

    /**
     * @var MovePurpose $movePurpose
     */
    private MovePurpose $movePurpose = MovePurpose::TYPE_1;

    /**
     * @var PaymentMethod $paymentMethod
     */
    private PaymentMethod $paymentMethod = PaymentMethod::METHOD_3;

    /**
     * @var VatCategory $vatCategory
     */
    private VatCategory $vatCategory = VatCategory::VAT_1;

    /**
     * @var IncomeClassificationType $incomeClassificationType
     */
    private IncomeClassificationType $incomeClassificationType = IncomeClassificationType::E3_881_001;

    /**
     * @var IncomeClassificationCategory $incomeClassificationCategory 
     */
    private IncomeClassificationCategory $incomeClassificationCategory = IncomeClassificationCategory::CATEGORY_1_7;


    /**
     * Set Issuer
     * 
     * @param string $vatNumber
     * @param string $country
     * @param int $branch
     * 
     * @var Issuer $issuer
     * 
     * @return void
     */
    public function setIssuer($vatNumber, $country, $branch): void
    {
        $this->issuer = new Issuer();
        $this->issuer->setVatNumber($vatNumber);
        $this->issuer->setCountry($country);
        $this->issuer->setBranch($branch);
    }

    /**
     * Set Address
     * 
     * @param string $postalCode
     * @param string $city
     * 
     * @var Address $address
     * 
     * @return void
     */
    public function setAddress($postalCode, $city): void
    {
        $this->address = new Address();
        $this->address->setPostalCode($postalCode);
        $this->address->setCity($city);
    }

    /**
     * Set Counterpart
     * 
     * @param string $vatNumber
     * @param string $country
     * @param int $branch
     * 
     * @var Counterpart $counterpart
     * @var Address $address
     * 
     * @return void
     */
    public function setCounterPart($vatNumber, $country, $branch): void
    {
        $this->counterpart = new Counterpart();
        $this->counterpart->setVatNumber($vatNumber);
        $this->counterpart->setCountry($country);
        $this->counterpart->setBranch($branch);
        $this->counterpart->setAddress($this->address);
    }

    /**
     * Set Invoice Header
     * 
     * @param string $series
     * @param string $aa
     * @param string $issueDate
     * @param string $currency
     * @param string $dispatchDate
     * @param string $dispatchTime
     * @param string $vehicleNumber
     * 
     * @var InvoiceHeader $invoiceHeader
     * @var InvoiceType|string $invoiceType
     * @var MovePurpose|string $movePurpose
     * 
     * @return void
     */
    public function setInvoiceHeader($series, $aa, $issueDate, $currency, $dispatchDate, $dispatchTime, $vehicleNumber): void
    {
        $this->invoiceHeader = new InvoiceHeader();
        $this->invoiceHeader->setSeries($series);
        $this->invoiceHeader->setAa($aa);
        $this->invoiceHeader->setIssueDate($issueDate);
        $this->invoiceHeader->setInvoiceType($this->invoiceType->value);
        $this->invoiceHeader->setCurrency($currency);
        $this->invoiceHeader->setDispatchDate($dispatchDate);
        $this->invoiceHeader->setDispatchTime($dispatchTime);
        $this->invoiceHeader->setVehicleNumber($vehicleNumber);
        $this->invoiceHeader->setMovePurpose($this->movePurpose->value);
    }

    /**
     * Set Payment Method Detail
     * 
     * @param float $amount
     * @param string $paymentMethodInfo
     * 
     * @var PaymentMethodDetail $paymentMethodDetail
     * @var PaymentMethod|string $paymentMethod
     * 
     * @return void
     */
    public function setPaymentMethodDetail($amount, $paymentMethodInfo): void
    {
        $this->paymentMethodDetail = new PaymentMethodDetail();
        $this->paymentMethodDetail->setType($this->paymentMethod->value);
        $this->paymentMethodDetail->setAmount($amount);
        $this->paymentMethodDetail->setPaymentMethodInfo($paymentMethodInfo);
    }

    /**
     * Set Invoice Details
     * 
     * @param int $lineNumber
     * @param float $netValue
     * @param float $vatAmount
     * @param bool $discountOption
     * 
     * @var InvoiceDetails $invoiceDetails
     * @var VatCategory|string $vatCategory
     * @var IncomeClassification $incomeClassification
     * 
     * @return void
     */
    public function setInvoicedetail($lineNumber, $netValue, $vatAmount, $discountOption): void
    {
        $this->invoiceDetails = new InvoiceDetails();
        $this->invoiceDetails->setLineNumber($lineNumber);
        $this->invoiceDetails->setNetValue($netValue);
        $this->invoiceDetails->setVatCategory($this->vatCategory->value);
        $this->invoiceDetails->setVatAmount($vatAmount);
        $this->invoiceDetails->setDiscountOption($discountOption);
        $this->invoiceDetails->addIncomeClassification($this->incomeClassification);
    }

    /**
     * Set Income Classification
     * 
     * @param float $amount
     * 
     * @var IncomeClassification $incomeClassification
     * @var IncomeClassificationType|string $incomeClassificationType
     * @var IncomeClassificationCategory|string $classificationCategory
     * 
     * @return void
     */
    public function setIncomeClassification($amount): void
    {
        $this->incomeClassification = new IncomeClassification();
        $this->incomeClassification->setClassificationType($this->incomeClassificationType->value);
        $this->incomeClassification->setClassificationCategory($this->incomeClassificationCategory->value);
        $this->incomeClassification->setAmount($amount);
    }

    /**
     * Set Invoice Summary
     * 
     * @param float $totalNetValue
     * @param float $totalVatAmount
     * @param float $totalWithheldAmount
     * @param float $totalFeesAmount
     * @param float $totalStampDutyAmount
     * @param float $totalOtherTaxesAmount
     * @param float $totalDeductionsAmount
     * @param float $totalGrossValue
     * 
     * @var InvoiceSummary $invoiceSummary
     * @var IncomeClassification $incomeClassification
     * 
     * @return void
     */
    public function setInvoiceSummary(
        $totalNetValue,
        $totalVatAmount,
        $totalWithheldAmount,
        $totalFeesAmount,
        $totalStampDutyAmount,
        $totalOtherTaxesAmount,
        $totalDeductionsAmount,
        $totalGrossValue
    ): void {
        $this->invoiceSummary = new InvoiceSummary();
        $this->invoiceSummary->setTotalNetValue($totalNetValue);
        $this->invoiceSummary->setTotalVatAmount($totalVatAmount);
        $this->invoiceSummary->setTotalWithheldAmount($totalWithheldAmount);
        $this->invoiceSummary->setTotalFeesAmount($totalFeesAmount);
        $this->invoiceSummary->setTotalStampDutyAmount($totalStampDutyAmount);
        $this->invoiceSummary->setTotalOtherTaxesAmount($totalOtherTaxesAmount);
        $this->invoiceSummary->setTotalDeductionsAmount($totalDeductionsAmount);
        $this->invoiceSummary->setTotalGrossValue($totalGrossValue);
        $this->invoiceSummary->addIncomeClassification($this->incomeClassification);
    }

    /**
     * Set Invoice 
     * 
     * @var Issuer $issuer
     * @var Counterpart $counterpart
     * @var InvoiceHeader $invoiceHeader
     * @var PaymentMethodDetail $paymentMethod
     * @var InvoiceDetails $invoiceDetails
     * @var InvoiceSummary $invoiceSummary
     * 
     * @return Invoice $invoice
     */
    public function setInvoice(): Invoice
    {
        $this->invoice = new Invoice();
        $this->invoice->setIssuer($this->issuer);
        $this->invoice->setCounterpart($this->counterpart);
        $this->invoice->setInvoiceHeader($this->invoiceHeader);
        $this->invoice->addPaymentMethod($this->paymentMethodDetail);
        $this->invoice->addInvoiceDetails($this->invoiceDetails);
        $this->invoice->setInvoiceSummary($this->invoiceSummary);
        return $this->invoice;
    }
}
