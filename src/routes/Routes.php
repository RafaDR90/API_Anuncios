<?php
namespace routes;

use lib\ResponseHttp,
    lib\Security,
    controllers\AnuncioController,
    controllers\UsuarioController,
    lib\Pages;

use FontLib\Table\Type\post;
use lib\Router;
class Routes{
    const PATH="/API_Anuncios";


    /**
     * Obtiene las rutas de la aplicacion
     * @return void
     */
    public static function getRoutes(){
    $router=new Router();

    // CREO CONTROLADORES
    $usuarioController=new UsuarioController();
    $anuncioController=new AnuncioController();

    // PAGINA PRINCIPAL
    $router->get(self::PATH, function () {
        $pages=new Pages();
        $pages->render('landingPage/LandingPageView');
        });

    //USUARIO
        $router->get(self::PATH."/registro", function () use ($usuarioController){
            $usuarioController->showRegister();
        });
        $router->post(self::PATH."/registro", function () use ($usuarioController){
            $usuarioController->showRegister();
        });
        $router->get(self::PATH.'/confirmar-cuenta/$token/$email', function (string $token) use ($usuarioController){
            $usuarioController->autentificarToken($token);
        });
        $router->get(self::PATH.'/login', function () use ($usuarioController){
            $usuarioController->showLogin();
        });
        $router->post(self::PATH.'/login', function () use ($usuarioController){
            $usuarioController->showLogin();
        });
        $router->get(self::PATH.'/cierra-sesion', function () use ($usuarioController){
            $usuarioController->logout();
        });
    //CREA TOKEN
        $router->get(self::PATH.'/actualiza-token', function () use ($usuarioController){
            $usuarioController->creaToken();
        });
        $router->get(self::PATH.'/vista-token',function(){
            $pages=new Pages();
            $pages->render('usuario/TokenView');
        });

    //ANUNCIOS CRUD
        //CREAR
        $router->post(self::PATH.'/crea-anuncio', function () use ($anuncioController){
            $anuncioController->creaAnuncio();
        });
        //BORRAR
        $router->delete(self::PATH.'/borra-anuncio', function () use ($anuncioController){
            $anuncioController->borraAnuncio();
        });
        //ACTUALIZAR
        $router->put(self::PATH.'/actualiza-anuncio', function () use ($anuncioController){
            $anuncioController->actualizaAnuncio();
        });
        //LISTAR
        $router->get(self::PATH.'/lista-anuncios', function () use ($anuncioController){
            $anuncioController->listaAnuncios();
        });


    // LA PAGINA NO SE ENCUENTRA
        $router->any('/404', function (){
            header('Location: ' . self::PATH . '/error');
            });
        $router->get(self::PATH.'/error', function (){
            ResponseHttp::statusMessage(404, "La pagina no se encuentra");
            });



        $router->resolve();
        }

}

?>