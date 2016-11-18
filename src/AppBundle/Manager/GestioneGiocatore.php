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


class GestioneGiocatore
{

   private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    /*public function insert($idSquadre,$nome,$annoFondazione,$presidente,$sedeLegale,$urlScudetto)
    {

        $query="INSERT INTO squadre (idSquadre, nome, annoFondazione, presidente, sedeLegale, urlScudetto) VALUES ('$idSquadre', '$nome', '$annoFondazione', '$presidente', '$sedeLegale', '$urlScudetto')";
        if (!$this->conn->query($query)) {
            die($this->conn->error);
        }


    }*/

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
                $giocatori[$i]=$g;
                $i++;
                //$res=$res. "id: " . $row["idSquadre"]. " - Name: " . $row["nome"]. "<br>";
            }
            return $giocatori;
        } else {
            return null;
        }


    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }


}