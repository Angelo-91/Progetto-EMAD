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
use Doctrine\Tests\Common\Cache\RedisCacheTest;


/**
 * Class ManagerSquadra
 * @package AppBundle\Manager
 */
class ManagerSquadra
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
     * ManagerSquadra constructor.
     */
    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    /**
     * @param $squadra
     */
    public function insert(Squadra $squadra)
    {
        $query="INSERT INTO squadre (nome, annoFondazione, presidente, sedeLegale, urlScudetto) VALUES ('".$squadra->getNome()."', '".$squadra->getAnnoFondazione()."', '".$squadra->getPresidente()."', '".$squadra->getSedeLegale()."', '".$squadra->geturlScudetto()."')";
        if (!$this->conn->query($query)) {
            return null;
        }
        else return $squadra;


    }

    /**
     * @return array|null
     */
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

    /**
     * @param $id
     * @return Squadra|null
     */
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
            return FALSE;
        }

    }

    /**
     * @param $name
     * @return Squadra|null
     */
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

    /**
     * @param $id
     * @return null|string
     */
    public function delete($id){

        $squadra=$this->getById($id);
        if($squadra!=null){
            $query="DELETE FROM squadre WHERE 	idSquadre='$id'";
            $this->conn->query($query);
            $url="../web/immaginiApp/Scudetti/".$squadra->getUrlScudetto();
            unlink($url);
            return $url;
            }
        else return null;






    }


    public function aggiornaSquadra(Squadra $s){

        $id=$s->getIdSquadre();
        $a=$s->getAnnoFondazione();
        $n=$s->getNome();
        $p=$s->getPresidente();
        $se=$s->getSedeLegale();
        $u=$s->getUrlScudetto();





        $sql = "UPDATE squadre SET nome='$n' , annoFondazione='$a' , urlScudetto='$u', presidente='$p', sedeLegale='$se'  WHERE idSquadre='$id'";
        if (!$this->conn->query($sql)) {
            die($this->conn->error);
            return null;
        }
        else  return $s;

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