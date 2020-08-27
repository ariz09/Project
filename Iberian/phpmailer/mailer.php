
<?php

use PHPMailer\PHPMailer\PHPMailer;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// require 'vendor/autoload.php';

function sendEMAIL($sector,$email)
{
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  // Gmail ID which you want to use as SMTP server
  $mail->Username = 'trymailer@gmail.com';
  // Gmail Password
  $mail->Password = 'GooglePass';
  // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  // Email ID from which you want to send the email
  $mail->setFrom('trymailer@gmail.com');
  // Recipient Email ID where you want to receive emails
  $mail->addAddress('luis@ibventur.es');

  $mail->isHTML(true);
  $mail->Subject = 'Iberian';
  $mail->Body = "<h3>Please see the attached file for the result</h3><br>
                Name: ".$sector." <br> 
                Email: ".$email;

  $mail->AddAttachment('../IberianValidation.xlsx');
  $mail->send();
}

require '../PHPSpreadSheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

function createTemplate($sector,$email,$revenue, $yearsofgrowth, $ebitda, $averageNet, $positiveResult, $netDebt, $fixedAssets, $biggestShareholder, $fromBiggestClient, $audited, $transaction, $sellCompany)
//  function createTemplate(revenue, yearsofgrowth, ebitda, averageNet, positiveResult, netDebt, fixedAssets, biggestShareholder, fromBiggestClient, audited, transaction, sellCompany)
{
  $reader = IOFactory::createReader('Xlsx');
  $reader->setReadDataOnly(FALSE);
  $spreadsheet = $reader->load("../IberianValidation.xlsx");

  $sheet = $spreadsheet->getSheetByName('Iberian');

  $sheet->setCellValue('C2', $revenue);
  $sheet->setCellValue('C3', $yearsofgrowth);
  $sheet->setCellValue('C4', $ebitda);
  $sheet->setCellValue('C5', $averageNet);
  $sheet->setCellValue('C6', $positiveResult);
  $sheet->setCellValue('C7', $netDebt);
  $sheet->setCellValue('C8', $fixedAssets);
  $sheet->setCellValue('E9', $biggestShareholder);
  $sheet->setCellValue('E10', $fromBiggestClient);
  $sheet->setCellValue('E11', $audited);
  $sheet->setCellValue('E12', $transaction);
  $sheet->setCellValue('E13', $sellCompany);

  //set the header first, so the result will be treated as an xlsx file.
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  //make it an attachment so we can define filename
  header('Content-Disposition: attachment;filename="IberianValidation.xlsx"');

  //create IOFactory object
  $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
  //save into php output
  $writer->save('../IberianValidation.xlsx');
  // $writer->save('php://output');

  sendEMAIL($sector,$email);
}


try {
  $revenue = $_POST['revenue'];
  $yearsofgrowth = $_POST['yearsofgrowth'];
  $ebitda = $_POST['ebitda'];
  $averageNet = $_POST['averageNet'];
  $positiveResult = $_POST['positiveResult'];
  $netDebt = $_POST['netDebt'];
  $fixedAssets = $_POST['fixedAssets'];
  $biggestShareholder = $_POST['biggestShareholder'];
  $fromBiggestClient = $_POST['fromBiggestClient'];
  $audited = $_POST['audited'];
  $transaction = $_POST['transaction'];
  $sellCompany = $_POST['sellCompany'];
  $sector = $_POST['sector'];
  $email = $_POST['email'];

  createTemplate($sector,$email,$revenue, $yearsofgrowth, $ebitda, $averageNet, $positiveResult, $netDebt, $fixedAssets, $biggestShareholder, $fromBiggestClient, $audited, $transaction, $sellCompany);
} catch (Exception $e) {
  echo "Message: " . $e->getMessage();
}
