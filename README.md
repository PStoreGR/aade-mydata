# pstoregr-myaade

## About the repo

<p>This repo created for our personal uses based on <a href="https://github.com/firebed/aade-mydata">Firebed Aade Mydata</a>.</p>

### Licence

<p>AADE myDATA is licenced under the <a href="https://opensource.org/licenses/MIT">MIT License</a>.</p>

# AADE v1.0.8 pdf

```
https://www.aade.gr/sites/default/files/2023-12/myDATA%20API%20Documentation%20v1.0.8_preofficial_erp_0.pdf
```

## Development

<p>For the development and testing phase, the registration process at
services offered by myDATA RESTAPI, will be done through the application that is
available at URL: </p>

```
https://mydata-dev-register.azurewebsites.net/
```

## Required Headers

<p>aade-user-id String {Username} The username of the account</p>
<p>ocp-apim-subscription-key String {Subscription Key} The user's subscription key</p>
<p>Content-Type: text/xml</p>

## Aade development url

<p>For the development and testing phase, the method is
available at URL: https://mydataapidev.aade.gr/</p>

# How to Use it

## Installation

## Clone from repository

```
git clone https://github.com/PStoreGR/myaade.git
```

## Install with composer

```
composer require pstoregr/myaade
```

## Register The App Settings Array

<p>In the environment pass prod for production and dev for development.</p>

```
$settings = array(
    'environment' => 'dev',
    'credentials' => array(
        'user_id' => '',
        'subscription_key' => ''
    )
);
```
## Register The App Settings

```
\Pstoregr\Myaade\Config\AppConfig::load($settings);
```

## Invoice Args

```
$invoice = array(
    // issuer
    'issuer' => array(
        'afm' => '123435678',
        'country' => 'GR',
        'branch' => 1
    ),
    // customer
    'customer' => array(
        // address
        'postaCode' => '32444',
        'city' => 'CITY',

        // counterpart
        'afm' => '123435678',
        'country' => 'GR',
        'branch' => 1,

        // invoiceHeader
        'series' => 'A',
        'aa' => '101',
        'issueDate' => '2023-01-01',
        'currency' => 'EUR',
        'dispatchDate' => '2023-01-01',
        'dispatchTime' => '13:40:00',
        'vehicleNumber' => 'EKA 5485',

        // paymentMethodDetail
        'paymentMethodAmount' => 1240000.00,
        'paymentMethodInfo' => 'Payment Method Info...',

        // incomeClassification
        'incomeClassificationAmount' => 1000000.00,

        // invoicedetails
        'lineNumber' => 1,
        'netValue' => 1000000.00,
        'vatAmount' => 240000.00,
        'discountOption' => true,

        // invoiceSummary    
        'totalNetValue' => 1000000.00,
        'totalVatAmount' => 240000.00,
        'totalWithHeldAmount' => 0.00,
        'totalFeesAmount' => 0.00,
        'totalStampDutyAmount' => 0.00,
        'totalOtherTaxesAmount' => 0.00,
        'totalDeductionsAmount' => 0.00,
        'totalGrossValue' => 1240000.00,
    )
);
```

## Send Invoice 

```
(new SendInvoiceRequest)->send($invoice)->response(true);
```

## Request Invoice 

```
$mark = "400001921232451";
(new RetrieveInvoiceRequest)->send($mark)->response(true);
```

## Cancel Invoice 

```
$mark = "400001921232451";
(new CancelInvoiceRequest)->send($mark)->response(true);
```

# More Info

<p>Visit the <a href="https://github.com/firebed/aade-mydata">Firebed Aade Mydata</a> repository.</p>