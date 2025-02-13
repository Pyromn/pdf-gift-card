# PDF Gift Card

[![GPL Software License](https://img.shields.io/badge/license-GPL-blue.svg?style=flat-square)](LICENSE)

Changes:
- PHP 8.3 Support
- PSR-4 compatible
- Available as composer package
- Dependencies are coming via composer

## PHP Compatibility

| PHP | PDF Gift Card |
|:----|:--------------|
| 8.3 | 1.0.0.        |


## Introduction

PHP Gift Card is a simple object oriented PHP class to generate beautifully designed gift cards, quotes
or orders with just a few lines of code. Brand it with your own logo and theme color, add unlimited
items and total rows with automatic paging. You can deliver the PDF ouput in the user's browser,
save on the server or force a file download. PHP Gift Card is fully customizable and can be integrated
into any well known CMS.

### Multi-languages & Currencies

PHP Gift Card has built in translations in English, Dutch, French, German, Spanish and Italian (you
can easily add your own if needed) and you can set the currency needed per document.

### Additional Titles, Paragraphs And Badges

Extra content (titles and multi-line paragraphs) can be added to the bottom of the document. You
might use it for payment or shipping information or any other content needed.

## Installation

```bash
composer require pyromn/pdf-gift-card
```

## Examples

There are 3 examples included in the `examples/` folder of this repo:
- simple.php
- example1.php
- example2.php
- change_timezone.php


### Create A New Gift Card

TODO: After code review, update README documentation with new consts.

> Make sure that the default php date timezone is set before using the class.

In this simple example we are generating an card with custom logo and theme color. It will
contain 2 products and a box on the bottom with VAT and total price. Then we add a "Paid" badge
right before the output.

```php
use Pyromn\PdfGiftCard\GiftCardPrinter;

  $giftCard = new GiftCardPrinter();
  
  /* Header settings */
  $giftCard->setLogo("images/example.jpg");   //logo image path
  $giftCard->setColor("#007fff");      // pdf color scheme
  $giftCard->setType("Gift Card");    // Invoice Type
  $giftCard->setReference("INV-55033645");   // Reference
  
  $giftCard->setDate(date('M dS ,Y',time()));   //Billing Date
  $giftCard->setTime(date('h:i:s A',time()));   //Billing Time
  $giftCard->setDue(date('M dS ,Y',strtotime('+3 months')));    // Due Date
  
  $giftCard->setTo(array("Purchaser Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740"));
  
  $giftCard->addItem("AMD Athlon X2DC-7450","2.4GHz/1GB/160GB/SMP-DVD/VB",6,0,580,0,3480);
  $giftCard->addItem("PDC-E5300","2.6GHz/1GB/320GB/SMP-DVD/FDD/VB",4,0,645,0,2580);
  $giftCard->addItem('LG 18.5" WLCD',"",10,0,230,0,2300);
  $giftCard->addItem("HP LaserJet 5200","",1,0,1100,0,1100);
  
  $giftCard->addTotal("Total",9460);
  $giftCard->addTotal("VAT 21%",1986.6);
  $giftCard->addTotal("Total due",11446.6,true);
  
  $giftCard->addBadge("Payment Paid");
  
  $giftCard->addTitle("Important Notice");
  
  $giftCard->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");
  
  $giftCard->setFooternote("My Company Name Here");
  
  $giftCard->render('example1.pdf','I'); 
  /* I => Display on browser, D => Force Download, F => local path save, S => return document as string */
```

## Documentation

### Create Instances

```php
use Pyromn\PdfGiftCard\GiftCardPrinter;

// Default Param: Size: A4, Currency: $, Language: en
$giftCard = new GiftCardPrinter($size, $currency, $language); 
```

| Parameter | Type   | Accepts                          | Note                                                 |
|:----------|:-------|:---------------------------------|:-----------------------------------------------------|
| size      | string | A4 (default)<br>Letter<br>Legal  | Set your document size                               |
| currency  | string | any string (e.g. "$", "£", "€")  | Set the currency that you want to use                |
| language  | string | en (default), nl, fr, de, es, it | A language that exists in the `inc/languages` folder |


### Number Formatting

How do you want to show your numbers?

```php
$giftCard->setNumberFormat($decimalpoint, $seperator, $alignment, $space, $negativeParenthesis);
```

| Parameter    | Type    | Accepts                               | Note                                           |
|:-------------|:--------|:--------------------------------------|:-----------------------------------------------|
| decimalpoint | string  | Commonly used is '.' (default) or ',' | What string to use for decimal point           |
| seperator    | string  | Commonly used is '.' or ',' (default) | What string to use for thousands separator     |
| alignment    | string  | 'left' (default) or 'right'           | Where to show the currency symbol              |
| space        | boolean | true (default) or false               | Show a space between currency symbol and price |
| negativeParenthesis | boolean | true or false (default) | Remove the negative sign and wrap in parenthesis |

### Color

Set a custom color to personalize your cards.

```php
// Hexadecimal color code
$giftCard->setColor($color);
```

### Add Logo

```php
$giftCard->setLogo($image, $maxwidth, $maxheight);
```

| Parameter            | Type   | Accepts                               | Note                                                                     |
|:---------------------|:-------|:--------------------------------------|:-------------------------------------------------------------------------|
| image                | string | Local path or remote url of the image | Preferably a good quality transparant png image                          |
| maxwidth (optional)  | int    |                                       | The width (in mm) of the bounding box where the image will be fitted in  |
| maxheight (optional) | int    |                                       | The height (in mm) of the bounding box where the image will be fitted in |

## Document Title

```php
// A string with the document title, will be displayed
// in the right top corner of the document (e.g. 'Gift Card' or 'Quote')
$giftCard->setType($title);
```

### Order Number

```php
// Document reference number that will be displayed in
// the right top corner of the document (e.g. 'INV29782')
$giftCard->setReference($number);
```

### Date

```php
//A string with the document's date
$giftCard->setDate($date);
```

### Due Date

```php
// A string with the document's due date
$giftCard->setDue($duedate);
```

### Issuer Information

Set your company details.

```php
// An array with your company details. The first value of
// the array will be bold on the document so it's suggested
// to use your company's name. You can add as
// many lines as you need.
/** Example: */
$giftCard->setFrom([
    'My Company',
    'Address line 1',
    'Address line 2',
    'City and zip',
    'Country',
    'VAT number'    
]);
```

### Client Information

```php
// An array with your clients' details. The first value of the
// array will be bold on the document so we suggest you to use
// the company's name. You can add as many lines as you need.
/** Example */
$giftCard->setTo([
   'My Client',
   'Address line 1',
   'Address line 2',
   'City and zip',
   'Country',
   'VAT number'    
]);
```

### Flip Flop

Switch the horizontal positions of your company information and the client information. By default,
your company details are on the left.

```php
$giftCard->flipflop();
```

### Issuer and Client header titles

Hide the issuer and client header row

```php
$giftCard->hideToFromHeaders();
```

### Adding Items

Add a new product or service row to your document below the company and client information. PHP
Invoice has automatic paging so there is absolutely no limit.

```php
$giftCard->addItem(name, description, quantity, vat, price, discount, total);
```

* `name` (string)  
  A string with the product or service name.
* `description` (string|false)  
  A string with the description with multi-line support. Use either `<br>` or `\n` to add a line-break.
* `quantity` (decimal|false)  
  An integer with the quantity for of this line.
* `vat` (string|decimal|false)   
  Pass a string (e.g. "21%", or any other text you may like) or a decimal if you want to show an amount instead (e.g. 124.30).  A numeric value will be formatted as "money" automatically.
* `price` (decimal|false)  
  A decimal for the unit price.
* `discount` (string|decimal|false)  
  Pass a string (e.g. "10%", or any other text you may like) or a decimal if you want to show an amount instead (e.g. 50.00)
  _Note_: the final output will not show a discount column unless any of the products haven't set a discount.
* `total` (decimal|false)  
  A decimal for the total product or service price.

The fields `description`, `quantity`, `vat`, `price`, `discount` and `total` are all optinoal. To disable any of this for an invoice line, pass `false` for the corresponding argument.

### Item line description font size

Change the font size for the product description. Default is 7

```php
$giftCard->setFontSizeProductDescription(9);
```

### Adding Totals

Add a row below the products and services for calculations and totals. You can add unlimited rows.

```php
$giftCard->addTotal(name,value,background);
```

- name {string} A string for the display name of the total field.
- value {decimal} A decimal for the value.
- background {boolean} Optional. Set to true to set the theme color as background color of the row.

### Adding A Badge

Adds a badge to your invoice below the products and services. You can use this for example to
display that the invoice has been payed.

```php
$giftCard->addBadge($badge);
```

badge {string} A string with the text of the badge.

It is possible to set the color of the badge as the second parameter:

```php
$giftCard->addBadge('Paid', '#00ff00');
// Short hex variant is also supported
$giftCard->addBadge('Payment pending', '#f00');
```

> CSS color names ('red', 'cyan', 'fuchsia', etc) are **NOT supported**

### Add Title

You can add titles and paragraphs to display information on the bottom part of your document such as
payment details or shipping information.

```php
$giftCard->addTitle($title);
```

title {string} A string with the title to display in the badge.

### Add Paragraph

You can add titles and paragraphs to display information on the bottom part of your document such as
payment details or shipping information.

```php
$giftCard->addParagraph($paragraph);
```

Paragraph {string} A string with the paragraph text with multi-line support.
Use either `<br>` or `\n` to add a line-break.

### Change a Language Term on the fly

You can change a Language Term with this method. This overwrites the Term from the Language File.

```php
$giftCard->changeLanguageTerm($term, $new);
$giftCard->changeLanguageTerm('date', 'Confirmation Date');
```

### Footer

A small text you want to display on the bottom left corner of the document.

```php
$giftCard->setFooternote($note);
```

note {string} A string with the information you want to display in the footer.

### Rendering The Card

```php
$giftCard->render($name, $output);
```

- name {string} A string with the name of your card. Example: 'card.pdf'
- output {string} Choose how you want the card to be delivered to the user.
  The following options are available:
  - ``I`` (Send the file inline to the browser)
  - ``D`` (Send to the browser and force a file download with the name given by name)
  - ``F`` (Save to a local file. Make sure to set pass the path in the name parameter)
  - ``S`` (Return the document as a string)

## Credits

- [FPDF](http://www.fpdf.org/)
