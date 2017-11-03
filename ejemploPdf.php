<?php
require('model/pdf/html2pdf.php');


$html_code = "<p>Nostrud reprehenderit esse consequat anim et in in proident in labore excepteur minim elit anim. Eu enim cupidatat ullamco consectetur voluptate officia proident sint adipisicing labore nostrud. Cupidatat mollit in qui duis ut nisi exercitation est occaecat commodo cillum. Excepteur non nisi sit aliqua sunt nostrud sit fugiat reprehenderit minim excepteur. Sit adipisicing proident esse do occaecat tempor quis minim quis velit laborum pariatur sint.</p></p>";

if(isset($html_code))
{
  $pdf=new PDF_HTML();
  $pdf->SetFont('Arial','',12);
  $pdf->AddPage();
  $pdf->WriteHTML($html_code);
  $pdf->Output('files/pedido.pdf', 'F');
  exit;
}

 ?>
