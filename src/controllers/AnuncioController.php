<?php
namespace controllers;

use utils\ValidationUtils,
    models\Anuncio,
    repositoris\AnuncioRepository,
    repositoris\UsuarioRepository,
    lib\Security,
    lib\ResponseHttp;
class AnuncioController
{
    public function creaAnuncio(){
        ResponseHttp::getCabeceras('POST');

        //Valido token
        $tokenData=ResponseHttp::validaToken();
        if (!$tokenData){
            ResponseHttp::statusMessage(401, "No autorizado");
            exit();
        }

        $usuarioRepository=new UsuarioRepository();

        //extraigo el usuario con el email del token
        $usuario=$usuarioRepository->getUsuarioPorEmail($tokenData->data->email);

        //Si el email no esta en la BD hace un 401
        if (!$usuario){
            ResponseHttp::statusMessage(401, "No autorizado");
            exit();
        }
        //compruebo que el token no este caducado
        $fechaToken= \DateTime::createFromFormat('Y-m-d H:i:s', $usuario[0]['token_exp']);
        $fechaActual=new \DateTime();
        if($fechaToken->getTimestamp()<$fechaActual->getTimestamp()){
            ResponseHttp::statusMessage(401, "No autorizado");
            exit();
        }
        //expiro el token en la BD
        $usuarioRepository->expiraToken($usuario[0]['id']);

        $data=json_decode(file_get_contents("php://input"));
        if (json_last_error() != JSON_ERROR_NONE) {
            ResponseHttp::statusMessage(400, "Faltan datos");
            exit();
        }
        if (!empty($data->titulo) and !empty($data->descripcion) and !empty($data->precio) and !empty($data->img_url)){
            $anuncio=new Anuncio(null, $data->titulo, $data->descripcion, $data->precio, $data->img_url, null, $usuario[0]['id']);
            $resultado=$anuncio->validaAnuncio();
            if (isset($resultado['error'])){
                ResponseHttp::statusMessage(503, $anuncio['error']);
                exit();
            }
            $anuncioRepository=new AnuncioRepository();
            $res=$anuncioRepository->creaAnuncio($anuncio);
            if (!$res){
                ResponseHttp::statusMessage(503, "No se ha podido crear el anuncio");
                exit();
            }
            ResponseHttp::statusMessage(201, "Anuncio creado");
            exit();
        }
        ResponseHttp::statusMessage(503, "Faltan datos");
    }

    public function borraAnuncio(){
        ResponseHttp::getCabeceras('DELETE');

        $tokenData=ResponseHttp::validaToken();
        if (!$tokenData){
            ResponseHttp::statusMessage(401, "No autorizado");
            exit();
        }

        $usuarioRepository=new UsuarioRepository();

        //extraigo el usuario con el email del token
        $usuario=$usuarioRepository->getUsuarioPorEmail($tokenData->data->email);

        //Si el email no esta en la BD hace un 401
        if (!$usuario){
            ResponseHttp::statusMessage(401, "No autorizado");
            exit();
        }
        //compruebo que el token no este caducado
        $fechaToken= \DateTime::createFromFormat('Y-m-d H:i:s', $usuario[0]['token_exp']);
        $fechaActual=new \DateTime();
        if($fechaToken->getTimestamp()<$fechaActual->getTimestamp()){
            ResponseHttp::statusMessage(401, "No autorizado");
            exit();
        }
        //expiro el token en la BD
        $usuarioRepository->expiraToken($usuario[0]['id']);

        $data=json_decode(file_get_contents("php://input"));
        if (!empty($data->id)){
            $data->id=ValidationUtils::SVNumero($data->id);
            if (!isset($data->id)){
                ResponseHttp::statusMessage(503, "El id no es un numero");
                exit();
            }
            $anuncio=new Anuncio($data->id);

            $anuncioRepository=new AnuncioRepository();
            $anuncioUid=$anuncioRepository->getAnuncioUid($anuncio->getId());
            if (!$anuncioUid){
                ResponseHttp::statusMessage(503, "No se ha podido borrar el anuncio");
                exit();
            }

            if ($usuario[0]['rol']!='admin' and $anuncioUid['usuario_id']!=$usuario[0]['id']){
                ResponseHttp::statusMessage(401, "No autorizado");
                exit();
            }

            if ($anuncioRepository->borraAnuncio($anuncio->getId())){
                ResponseHttp::statusMessage(202, "Ponente borrado");
            }else{
                ResponseHttp::statusMessage(503, "No se ha podido borrar el ponente");
            }
        }else{
            ResponseHttp::statusMessage(503, "Faltan datos");
        }
    }
}