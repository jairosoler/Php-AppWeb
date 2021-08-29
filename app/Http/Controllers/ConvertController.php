<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class ConvertController extends Controller{


    protected $cliente;

    public function __construct(Client $client)
    {

        $this->cliente = $client;

    }

    public function convertDocx()
    {

        $rutaImagen =  public_path("prueba.docx");
        $contenidoBinario = file_get_contents($rutaImagen);
        $imagenComoBase64 = base64_encode($contenidoBinario);


       $response = $this->cliente->request('POST', 'convertir',
            ['json' =>
               [
                   'base64' => $imagenComoBase64,
                   'extencionDestino' => "ODT",
                   'extencionFuente' => "DOCX",
                   'nombreArchivo' => "prueba.docx"
               ]
           ]
        );

       $data = json_decode($response->getBody()->getContents());

       $pdf_b64 = base64_decode($data->base64);


        if(file_put_contents(storage_path('public'), $pdf_b64)){
            //just to force download by the browser
            header("Content-type: application/pdf");

            //print base64 decoded
            echo $pdf_b64;
        }

    }




}
