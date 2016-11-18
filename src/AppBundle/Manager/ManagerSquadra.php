<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 17/11/2016
 * Time: 18:39
 */

namespace AppBundle\Manager;
use AppBundle\Model\Squadra;
use AppBundle\Utility\DB;


class ManagerSquadra
{

    private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    public function insert($idSquadre,$nome,$annoFondazione,$presidente,$sedeLegale,$urlScudetto)
    {

        $query="INSERT INTO squadre (idSquadre, nome, annoFondazione, presidente, sedeLegale, urlScudetto) VALUES ('$idSquadre', '$nome', '$annoFondazione', '$presidente', '$sedeLegale', '$urlScudetto')";
        if (!$this->conn->query($query)) {
            die($this->conn->error);
        }


    }
    /*ci*/
    public function get(){

        $squadre=array();
        $sql="SELECT * from squadre";
        $result = $this->conn->query($sql);
        $res="";
        $i=0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $s=new Squadra();
                $s->setNome($row["nome"]);
                $s->setIdSquadre($row["idSquadre"]);
                $s->setAnnoFondazione($row["annoFondazione"]);
                $s->setPresidente($row["presidente"]);
                $s->setSedeLegale($row["sedeLegale"]);
                $s->setUrlScudetto($row["urlScudetto"]);
                $squadre[$i]=$s;
                $i++;
                //$res=$res. "id: " . $row["idSquadre"]. " - Name: " . $row["nome"]. "<br>";
            }
            return $squadre;
        } else {
            return null;
        }


    }

    public function getById($id){

        $sql="SELECT * FROM squadre WHERE idSquadre='$id'";
        $result = $this->conn->query($sql);
        $s=new Squadra();
        if ($result->num_rows > 0) {
            // output data of each row
            if($row = $result->fetch_assoc()) {
                $s=new Squadra();
                $s->setNome($row["nome"]);
                $s->setIdSquadre($row["idSquadre"]);
                $s->setAnnoFondazione($row["annoFondazione"]);
                $s->setPresidente($row["presidente"]);
                $s->setSedeLegale($row["sedeLegale"]);
                $s->setUrlScudetto($row["urlScudetto"]);

                //$res=$res. "id: " . $row["idSquadre"]. " - Name: " . $row["nome"]. "<br>";
            }
            return $s;
        } else {
            return null;
        }

    }

    public function  getByName($name){
        $sql="SELECT * FROM squadre WHERE nome='$name'";
        $result = $this->conn->query($sql);
        $s=new Squadra();
        if ($result->num_rows > 0) {
            // output data of each row
            if($row = $result->fetch_assoc()) {
                $s=new Squadra();
                $s->setNome($row["nome"]);
                $s->setIdSquadre($row["idSquadre"]);
                $s->setAnnoFondazione($row["annoFondazione"]);
                $s->setPresidente($row["presidente"]);
                $s->setSedeLegale($row["sedeLegale"]);
                $s->setUrlScudetto($row["urlScudetto"]);

                //$res=$res. "id: " . $row["idSquadre"]. " - Name: " . $row["nome"]. "<br>";
            }
            return $s;
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