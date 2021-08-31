<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Conversor de imagenes </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>

    <link rel="icon" type="image/x-icon" href="{{asset('img/LOGO DOCONVER favicon rojo.png')}}" />

    <!-- Font Awesome icons (free version)-->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/css/uikit.min.css" />

    <link rel="stylesheet" href="{{asset('css/glass.css')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit-icons.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
            crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</head>

<body>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<br>
<div class="container glass-container">

    <div class="container">

        <div class="row justify-content-center">
            <img src="{{asset('img/LOGO_DOCONVER.png')}}" class="img-fluid" alt="..."
                 style="width:50%; padding-top: 10px;">
        </div>

        <div class="row">
            <h1 id="text">Conversor de documentos</h1>

            <form action="{{ route('convertidor') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="js-upload uk-placeholder uk-text-center"
                     style="border:5px dashed #ed3237; color: black;">
                    <span><i class="fas fa-file-upload fa-lg"></i></span>
                    <span class="uk-text-middle" id="text">Adjunte el documento soltándolo aquí o</span>
                    <div uk-form-custom>
                        <input type="file"  name="archivo" multiple class="form-control {{ $errors->has('archivo') ? ' is-invalid' : '' }}">
                        @if ($errors->has('archivo'))
                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('archivo') }}</strong>
                            </span>
                        @endif
                        <span class="uk-link" id="text">seleccione uno</span>
                    </div>
                </div>


                <div class="row">
                <h1 id="text">
                    A que se convierte ...
                </h1>
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="text" name="formato">
                    <option selected>Seleccione el formato</option>
                    <option>ODT</option>
                    <option>ODP</option>
                    <option>ODS</option>
                    <option>PDF</option>
                    <option>DOCX</option>
                    <option>PPTX</option>
                    <option>XLSX</option>
                </select>



                <div id="button">
                    <button class="uk-button uk-button-danger uk-button-small" id="boton" type="submit">Convertir</button>
                </div>



            </div>

        </form>


        </div>
    </div>
</div>


</body>

</html>
