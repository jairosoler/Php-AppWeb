<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;


class ConvertController extends Controller{


    protected $cliente;

    public function __construct(Client $client)
    {

        $this->cliente = $client;

    }

    public function convertDocx(Request $request)
    {

        $this->validateData($request);

       //OBETENEMOS LA DATA PRINCIPAL DEL ARCHIVO DE ENTRADA
        $ruta_archvio  = $request->file('archivo')->path();
        $nombre_archvio  = $request->file('archivo')->getClientOriginalName();
        $ext_destino = $request->input('formato');
        $ext_origen = $request->file('archivo')->getClientOriginalExtension();


        //CONVERSION DE ARCHIVO A BASE_64
        $contenidoBinario = file_get_contents($ruta_archvio);
        $archivoComoBase64 = base64_encode($contenidoBinario);


        //ENVIO DE PETICION AL SERVIDOR
       $response = $this->cliente->request('POST', 'convertir',
            ['json' =>
               [
                   'base64' => $archivoComoBase64,
                   'extencionDestino' => $ext_destino,
                   'extencionFuente' => $ext_origen,
                   'nombreArchivo' => $nombre_archvio
               ]
           ]
        );

       $data = json_decode($response->getBody()->getContents());
       $this->dowloandFile($data, $ext_destino);

    }

    public function dowloandFile($data, $ext_destino)
    {
        $data_b64 = base64_decode($data->base64);
        $nombre_final = 'salida.' . strtolower($ext_destino);
        file_put_contents($nombre_final, $data_b64);


        if (file_exists($nombre_final)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($nombre_final).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($nombre_final));
            readfile($nombre_final);
            return true;
        }
        return false;

    }

    protected function validateData(Request $request){

        $request->validate([
            'archivo' => 'required|mimes:docx,odt',
        ]);

    }



}
