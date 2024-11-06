<?php
ob_start(); // Inicia la captura de la salida, evitando que se muestre de inmediato.

require '../../../vendor/autoload.php';
// include '../tcpdf/tcpdf.php'; --> usando la carpeta tcpdf
// include '../tcpdf/config/tcpdf_config.php'; --> usando la carpeta tcpdf
require_once '../../models/CartaBD.php';

$documento =new TCPDF();
$documento->setPrintHeader(false); // desactivar encabezado y pie de página (por defecto es true)
$documento->setPrintFooter(false);
$documento->AddPage(); // creo una pagina
$documento->SetTitle('Informe de Cartas de VSGAME'); // titulo que no se ve en el PDF sino en el sistema

$rutaLogoJuego= '../../../img/vs.png';
if (file_exists($rutaLogoJuego)) {
    $documento->Image($rutaLogoJuego, 13, 23, 50, 30); // mete la imagen al PDF
} else {
    die('Error: La imagen no encontrada en la ruta especificada.');
}

$documento->Ln(50); // salto de línea después de la imagen

$documento->SetFont('helvetica', 'B', 20);
$documento->Cell(0, 10, 'Informe de Cartas de VSGAME', 0, 0, 'C');
$documento->Ln(10);

$cartaBBDD = new CartaBD();
$listadoCartas = $cartaBBDD->obtenerCartas(); 

if (empty($listadoCartas)) { // verificar si `obtenerCartas` devolvió datos
    die("No se encontraron cartas en la base de datos.");
}

$html = '<table border="1" cellpadding="5">
            <thead>
                <tr style="background-color: #cccccc;">
                    <th>Nombre</th>
                    <th>Ataque</th>
                    <th>Defensa</th>
                    <th>Tipo</th>
                </tr>
            </thead>
        <tbody>';

foreach ($listadoCartas as $carta) {
    $html .= '
    <tr>
        <td>' . $carta['nombre'] . '</td>
        <td>' . $carta['ataque'] . '</td>
        <td>' . $carta['defensa'] . '</td>
        <td>' . $carta['tipo'] . '</td>
    </tr>';
}

$html .= '
    </tbody>
</table>';

// escribir el HTML en el PDF
$documento->SetFont('helvetica', '', 12);
$documento->writeHTML($html, true, false, false, false, '');

$cantidadCartas = count($cartaBBDD->obtenerCartas());

$documento->Cell(0, 10, 'Número de cartas creadas: ' . $cantidadCartas, 0, 0, 'C');
$documento->Ln(10);

$date = date('d/m/Y H:i:s');
$documento->Cell(0, 10, "Fecha y hora de generación: $date", 0, 1, 'C');

ob_end_clean(); // Termina la captura y elimina todo lo almacenado sin mostrarlo.
$documento->Output('Informe_Cartas_VSGAME.pdf', 'I'); // para descargar en el navegador, se guarda con ese nombre que ponemos