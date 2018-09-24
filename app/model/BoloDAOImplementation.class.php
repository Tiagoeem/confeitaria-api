<?php

namespace app\model;

use app\classes\Bolo;
use app\model\BoloDAOInterface;
use app\model\ConexaoDB;

class BoloDAOImplementation implements BoloDAOInterface
{

    public function getAllBolos()
    {
        # Pode lançar erro
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("SELECT * FROM tbl_bolos");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $arrayBolos = null;
        if ( $stmt->rowCount() > 0 ) {
            $arrayBolos = array();
            foreach ($result as $row) {
                $boloTemp = new Bolo( $row );
                array_push($arrayBolos, $boloTemp);
            }            
        };

        return $arrayBolos;
    }

    public function getBoloById( $idBolo )
    {
        # Pode lançar erro
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("SELECT * FROM tbl_bolos where id_bolo = :IDBOLO");
        $stmt->bindParam(":IDBOLO", $idBolo);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $boloTemp = null;
        if ( $stmt->rowCount() > 0 ) {
            $boloTemp = new Bolo( $result[0] );
        };

        return $boloTemp;
    }

    public function getBoloByName( string $nome )
    {

    }

    public function createBolo( Bolo $boloInstancia )
    {
        # Pode lançar erro
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("INSERT INTO tbl_bolos (nome, sabor, cobertura, descricao) VALUES (:NOME, :SABOR, :COBERTURA, :DESCRICAO)");

        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":SABOR", $sabor);
        $stmt->bindParam(":COBERTURA", $cobertura);
        $stmt->bindParam(":DESCRICAO", $desc);

        $nome = $boloInstancia->getNome();
        $sabor = $boloInstancia->getSabor();
        $cobertura = $boloInstancia->getCobertura();
        $desc = $boloInstancia->getDescricao();
        $stmt->execute();
    }

    public function deleteBoloById( $idBolo ):bool
    {
        # Pode lançar erro
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("DELETE FROM tbl_bolos where id_bolo = :IDBOLO");
        $stmt->bindParam(":IDBOLO", $idBolo);

        # TRUE: sucesso
        # FALSE: Não existe registro com tal id_bolo
        $stmt->execute();
        return ( $stmt->rowCount() >= 1 );

    }

    public function updateBoloById( $idBolo, Bolo $boloInstancia ):bool
    {
        $connDB = new ConexaoDB();
        $stmt = $connDB->con->prepare("UPDATE tbl_bolos SET nome = :NOME, sabor = :SABOR, cobertura = :COBERTURA, descricao =:DESCRICAO
                                    WHERE id_bolo = $idBolo");

        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":SABOR", $sabor);
        $stmt->bindParam(":COBERTURA", $cobertura);
        $stmt->bindParam(":DESCRICAO", $desc);

        $nome = $boloInstancia->getNome();
        $sabor = $boloInstancia->getSabor();
        $cobertura = $boloInstancia->getCobertura();
        $desc = $boloInstancia->getDescricao();
        # TRUE: sucesso
        # FALSE: Não existe registro com tal id_bolo
        $stmt->execute();
        return ( $stmt->rowCount() >= 1 );        
    }
}