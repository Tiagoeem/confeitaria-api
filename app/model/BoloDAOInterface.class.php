<?php

namespace app\model;

use app\classes\Bolo;

Interface BoloDAOInterface {

    public function getAllBolos( );

    public function getBoloByName( string $nome );

    public function getBoloById( $idBolo );

    public function createBolo( Bolo $boloInstancia );

    public function deleteBoloById( $idBolo );

    public function updateBoloById( $idBolo, Bolo $boloInstancia );
}