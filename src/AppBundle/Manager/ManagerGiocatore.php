<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 17/11/2016
 * Time: 18:39
 */

namespace AppBundle\Manager;
use AppBundle\Model\Giocatore;
use AppBundle\Utility\DB;


/**
 * Class ManagerGiocatore
 * @package AppBundle\Manager
 */
class ManagerGiocatore
{

    /**
     * @var \mysqli
     */
    private $conn;
    /**
     * @var DB
     */
    private $db;

    /**
     * ManagerGiocatore constructor.
     */
    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }


    /**
     * @param $idSquadra
     * @return array|null
     */
    public function getGiocatoriByIdSquadra($idSquadra){

        $giocatori=array();
        $sql="SELECT * from giocatori WHERE Squadre_idSquadre='$idSquadra'";
        $result = $this->conn->query($sql);
        $res="";
        $i=0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $g=new Giocatore();

                $g->setNome($row["nome"]);
                $g->setCognome($row["cognome"]);
                $g->setIdGiocatori($row["idGiocatori"]);
                $g->setGolFatti($row["golFatti"]);
                $g->setGolSubiti($row["golSubiti"]);
                $g->setAssist($row["assist"]);
                $g->setAmmonizioni($row["ammonizioni"]);
                $g->setEspulsioni($row["espulsioni"]);
                $g->setPresenze($row["presenze"]);
                $g->setRuolo($row["ruolo"]);
                $g->setValore($row["valore"]);
                $g->setResidenza($row["residenza"]);
                $g->setNazionalita($row["nazionalita"]);
                $g->setEmail($row["email"]);
                $g->setDataDiNascita($row["dataDiNascita"]);
                $g->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $g->setUrlImmagine($row["urlImmagine"]);
                $giocatori[$i]=$g;
                $i++;
                //$res=$res. "id: " . $row["idSquadre"]. " - Name: " . $row["nome"]. "<br>";
            }
            return $giocatori;
        } else {
            return null;
        }


    }

    public function insert(Giocatore $g)
    {

        $query="INSERT INTO giocatori (ruolo, valore,nome, cognome, residenza, nazionalita, email, dataDiNascita,Squadre_idSquadre, urlImmagine) 
                  VALUES ('".$g->getRuolo()."', '".$g->getValore()."', '".$g->getNome()."', '".$g->getCognome()."', '".$g->getResidenza()."', '".$g->getNazionalita()."','".$g->getEmail()."','".$g->getDataDiNascita()."','".$g->getSquadreIdSquadre()."','".$g->getUrlImmagine()."')";
        if (!$this->conn->query($query)) {
            die($this->conn->error);
        }

    }
    /**
     *
     */
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }


}