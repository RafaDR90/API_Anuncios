<?php
namespace repositoris;
use lib\BaseDeDatos,
    PDO,
    PDOException;
use models\Anuncio;

class AnuncioRepository
{
    private $db;
    public function __construct()
    {
        $this->db=new BaseDeDatos();
    }
    public function creaAnuncio(Anuncio $anuncio)
    {
        $fecha = date('Y-m-d H:i:s');

        try {
            $insert = $this->db->prepara("INSERT INTO anuncio (titulo, descripcion, precio, img_url, fecha, usuario_id) VALUES (:titulo, :descripcion, :precio, :img_url, :fecha, :usuario_id)");
            $insert->bindValue(':titulo', $anuncio->getTitulo());
            $insert->bindValue(':descripcion', $anuncio->getDescripcion());
            $insert->bindValue(':precio', $anuncio->getPrecio());
            $insert->bindValue(':img_url', $anuncio->getImgUrl());
            $insert->bindValue(':fecha', $fecha);
            $insert->bindValue(':usuario_id', $anuncio->getUsuarioId());
            $insert->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        } finally {
            $insert->closeCursor();
            $this->db->cierraConexion();
        }
    }

    public function getAnuncioUid($id)
    {
        try {
            $consulta = $this->db->prepara("SELECT usuario_id FROM anuncio WHERE id=:id");
            $consulta->bindValue(':id', $id);
            $consulta->execute();
            $anuncio = $consulta->fetch(PDO::FETCH_ASSOC);
            return $anuncio;
        } catch (PDOException $e) {
            return false;
        } finally {
            $consulta->closeCursor();
        }
    }

    public function borraAnuncio($id)
    {
        try {
            $delete = $this->db->prepara("DELETE FROM anuncio WHERE id=:id");
            $delete->bindValue(':id', $id);
            $delete->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        } finally {
            $delete->closeCursor();
            $this->db->cierraConexion();
        }
    }
}