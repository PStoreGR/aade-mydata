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
     * @param string $afm
     * @param string $country
     * @param int $branch
     * 
     * @var Issuer $issuer
     * 
     * @return void
     */
    public function setIssuer($afm, $country, $branch): void
    {
        $issuer = new Issuer();
        $issuer->setVatNumber($afm);
        $issuer->setCountry($country);
        $issuer->setBranch($branch);
        $this->issuer = $issuer;
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
        $address = new Address();
        $address->setPostalCode($postalCode);
        $address->setCity($city);
        $this->address = $address;
    }

    /**
     * Set Counterpart
     * 
     * @param string $afm
     * @param string $country
     * @param int $branch
     * 
     * @var Counterpart $counterpart
     * @var Address $address
     * 
     * @return void
     */
    public function setCounterPart($afm, $country, $branch): void
    {
        $counterpart = new Counterpart();
        $counterpart->setVatNumber($afm);
        $counterpart->setCountry($country);
        $counterpart->setBranch($branch);
        $counterpart->setAddress($this->address);
        $this->counterpart = $counterpart;
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
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->setSeries($series);
        $invoiceHeader->setAa($aa);
        $invoiceHeader->setIssueDate($issueDate);
        $invoiceHeader->setInvoiceType($this->invoiceType->value);
        $invoiceHeader->setCurrency($currency);
        $invoiceHeader->setDispatchDate($dispatchDate);
        $invoiceHeader->setDispatchTime($dispatchTime);
        $invoiceHeader->setVehicleNumber($vehicleNumber);
        $invoiceHeader->setMovePurpose($this->movePurpose->value);
        $this->invoiceHeader = $invoiceHeader;
    }

    /**
     * Set Payment Method Detail
     * 
     * @param float $amount
     * @param string $paymentMethodInfo
     * 
     * @var PaymentMethodDetail $paymentMethodDetail
     * @var PaymentMethod|string $type
     * 
     * @return void
     */
    public function setPaymentMethodDetail($amount, $paymentMethodInfo): void
    {
        $paymentMethodDetail = new PaymentMethodDetail();
        $paymentMethodDetail->setType($this->paymentMethod->value);
        $paymentMethodDetail->setAmount($amount);
        $paymentMethodDetail->setPaymentMethodInfo($paymentMethodInfo);
        $this->paymentMethodDetail = $paymentMethodDetail;
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
     * @var VatCategory $vatCategory
     * @var IncomeClassification $incomeClassification
     * 
     * @return void
     */
    public function setInvoicedetail($lineNumber, $netValue, $vatAmount, $discountOption): void
    {
        $invoiceDetails = new InvoiceDetails();
        $invoiceDetails->setLineNumber($lineNumber);
        $invoiceDetails->setNetValue($netValue);
        $invoiceDetails->setVatCategory($this->vatCategory->value);
        $invoiceDetails->setVatAmount($vatAmount);
        $invoiceDetails->setDiscountOption($discountOption);
        $invoiceDetails->addIncomeClassification($this->incomeClassification);
        $this->invoiceDetails = $invoiceDetails;
    }

    /**
     * Set Income Classification
     * 
     * @param float $amount
     * 
     * @var IncomeClassification $incomeClassification
     * @var IncomeClassificationType|string $classificationType
     * @var IncomeClassificationCategory|string $classificationCategory
     * 
     * @return void
     */
    public function setIncomeClassification($amount): void
    {
        $incomeClassification = new IncomeClassification();
        $incomeClassification->setClassificationType($this->incomeClassificationType->value);
        $incomeClassification->setClassificationCategory($this->incomeClassificationCategory->value);
        $incomeClassification->setAmount($amount);
        $this->incomeClassification = $incomeClassification;
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
        $invoiceSummary = new InvoiceSummary();
        $invoiceSummary->setTotalNetValue($totalNetValue);
        $invoiceSummary->setTotalVatAmount($totalVatAmount);
        $invoiceSummary->setTotalWithheldAmount($totalWithheldAmount);
        $invoiceSummary->setTotalFeesAmount($totalFeesAmount);
        $invoiceSummary->setTotalStampDutyAmount($totalStampDutyAmount);
        $invoiceSummary->setTotalOtherTaxesAmount($totalOtherTaxesAmount);
        $invoiceSummary->setTotalDeductionsAmount($totalDeductionsAmount);
        $invoiceSummary->setTotalGrossValue($totalGrossValue);
        $invoiceSummary->addIncomeClassification($this->incomeClassification);
        $this->invoiceSummary = $invoiceSummary;
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
        $invoice = new Invoice();
        $invoice->setIssuer($this->issuer);
        $invoice->setCounterpart($this->counterpart);
        $invoice->setInvoiceHeader($this->invoiceHeader);
        $invoice->addPaymentMethod($this->paymentMethodDetail);
        $invoice->addInvoiceDetails($this->invoiceDetails);
        $invoice->setInvoiceSummary($this->invoiceSummary);
        return $invoice;
    }
}
