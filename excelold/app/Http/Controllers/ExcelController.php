<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PHPExcel_Worksheet_Drawing;
use Maatwebsite\Excel\Facades\Excel;
use App\Usuarios; 

class ExcelController extends Controller
{
	public function export()
    	{
        /** Fuente de Datos Eloquent */
        $data = Usuarios::all();
        /** Creamos nuestro archivo Excel */
        Excel::create('usuarios', function ($excel) use ($data) {
            /** Creamos una hoja */
            $excel->sheet('Hoja Uno', function ($sheet) use ($data) {
                /**
                 * Insertamos los datos en la hoja con el método with/fromArray
                 * Parametros: (
                 * Datos,
                 * Valores del encabezado de la columna,
                 * Celda de Inicio,
                 * Comparación estricta de los valores del encabezado
                 * Impresión de los encabezados
                 * )*/
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setName('Logo_UTVT');
                $objDrawing->setDescription('Logotipo .png');
                $objDrawing->setPath(public_path('images/logo.png'));
                $objDrawing->setHeight(94);
                $objDrawing->setCoordinates('A1');
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('A1:M1');
                $sheet->setSize('A1', 10, 70);  
                $sheet->row(1, ['Reporte de Usuarios UTVT']);
                $sheet->row(2, ['User1','User2','User3','User4','User5']);
				$sheet->fromArray($data, null, 'A3', false, false);

				$sheet->cell('A1', function($cell) 
                {
				$cell->setAlignment('center');
				$cell->setValignment('center');
				});

            });
            /** Descargamos nuestro archivo pasandole la extensión deseada (xls, xlsx) */
        })->download('xlsx');
    }
}
