<?php


use Pyromn\PdfGiftCard\GiftCardPrinter;

//include 'src/GiftCardPrinter.php';
/* include 'vendor/setasign/tfpdf/tfpdf.php'; */
/* include 'vendor/setasign/tfpdf/font/unifont/ttfonts.php'; */

$giftCard = new GiftCardPrinter();
  /* Header Settings */
  $giftCard->setLogo('images/example.jpg');
  $giftCard->setColor('#CC0000');
  $giftCard->setType('Gift Card');

  $giftCard->setReference('INV-55033645');
  $giftCard->setDate(date('M dS ,Y', time()));
  $giftCard->setTime(date('h:i:s A', time()));
  $giftCard->setDue(date('M dS ,Y', strtotime('+3 months')));

  $giftCard->setTo(['Purchaser Name', 'Sample Company Name', '128 AA Juanita Ave', 'Glendora , CA 91740', 'United States of America']);
  /* Adding Items in table */
  $giftCard->addItem('AMD Athlon X2DC-7450', '2.4GHz/1GB/160GB/SMP-DVD/VB', 6, 0, 580, 0, 3480);
  $giftCard->addItem('PDC-E5300', '2.6GHz/1GB/320GB/SMP-DVD/FDD/VB', 4, 0, 645, 0, 2580);
  $giftCard->addItem('LG 18.5" WLCD', '', 10, 0, 230, 0, 2300);
  $giftCard->addItem('HP LaserJet 5200', '', 1, 0, 1100, 0, 1100);
  /* Set totals alignment */
  $giftCard->setTotalsAlignment('horizontal');
  /* Add totals */
  $giftCard->addTotal('Total', 9460);
  $giftCard->addTotal('VAT 21%', 1986.6);
  $giftCard->addTotal('Shipping costs', 5400);
  $giftCard->addTotal('Total due', 16846.6, true);
  /* Set badge */
  $giftCard->addBadge('Payment Paid');
  /* Add title */
  $giftCard->addTitle('Important Notice');
  /* Add Paragraph */
  $giftCard->addParagraph("No item will be replaced or refunded if you don't have the invoice with you. You can refund within 2 days of purchase.");
  /* Set footer note */
  $giftCard->setFooternote('My Company Name Here');
  /* Render */
  $giftCard->render('example1.pdf', 'I'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
