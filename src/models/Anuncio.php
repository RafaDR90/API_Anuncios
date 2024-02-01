<?php
namespace models;

use utils\ValidationUtils;

class Anuncio
{
    private int|null $id;
    private string $titulo;
    private string $descripcion;
    private string $precio;
    private string $img_url;
    private string|null $fecha;
    private int|null $usuario_id;

    public function __construct($id=null, $titulo='', $descripcion='', $precio='', $img_url='', $fecha='', $usuario_id=null)
    {
        $this->id=$id;
        $this->titulo=$titulo;
        $this->descripcion=$descripcion;
        $this->precio=$precio;
        $this->img_url=$img_url;
        $this->fecha=$fecha;
        $this->usuario_id=$usuario_id;
    }

    public function validaAnuncio()
    {
        if (isset($this->id)){
            $this->setId(ValidationUtils::SVNumero($this->getId()));
            if (!isset($this->id)){
                return ['error'=>'El id no es un numero'];
            }
        }
        $this->setTitulo(ValidationUtils::sanidarStringFiltro($this->getTitulo()));
        $this->setDescripcion(ValidationUtils::sanidarStringFiltro($this->getDescripcion()));
        $this->setImgUrl(ValidationUtils::sanidarStringFiltro($this->getImgUrl()));
        $this->setPrecio(ValidationUtils::SVNumeroFloat($this->getPrecio()));
        if (!isset($this->precio)){
            return ['error'=>'El precio no es un numero'];
        }
        if (!ValidationUtils::TextoNoEsMayorQue($this->getTitulo(),100)){
            return ['error'=>'El titulo no puede tener mas de 100 caracteres'];
        }
        if(!ValidationUtils::noEstaVacio($this->getTitulo())){
            return ['error'=>'El titulo no puede estar vacio'];
        }
        if(!ValidationUtils::son_letras_y_numeros($this->getTitulo())){
            return ['error'=>'El titulo solo puede contener letras y numeros'];
        }
        if(!ValidationUtils::noEstaVacio($this->getDescripcion())){
            return ['error'=>'La descripcion no puede estar vacia'];
        }
        if(!ValidationUtils::son_letras_y_numeros($this->getDescripcion())){
            return ['error'=>'La descripcion solo puede contener letras y numeros'];
        }
        if(!ValidationUtils::TextoNoEsMayorQue($this->getDescripcion(),255)){
            return ['error'=>'La descripcion no puede tener mas de 255 caracteres'];
        }
        if(!ValidationUtils::noEstaVacio($this->getImgUrl())){
            return ['error'=>'La imagen no puede estar vacia'];
        }
        if(!ValidationUtils::TextoNoEsMayorQue($this->getImgUrl(),255)){
            return ['error'=>'La imagen no puede tener mas de 255 caracteres'];
        }
        return true;
    }

    public static function fromArray()
    {
        $anuncios=[];
        foreach ($anuncios as $anuncio){
            $anuncios[]=new Anuncio(
                $anuncio['id'],
                $anuncio['titulo'],
                $anuncio['descripcion'],
                $anuncio['precio'],
                $anuncio['img_url'],
                $anuncio['fecha'],
                $anuncio['usuario_id']);
        }
        return $anuncios;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio(): string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): void
    {
        $this->precio = $precio;
    }

    public function getImgUrl(): string
    {
        return $this->img_url;
    }

    public function setImgUrl(string $img_url): void
    {
        $this->img_url = $img_url;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getUsuarioId(): ?int
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(?int $usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }


}
