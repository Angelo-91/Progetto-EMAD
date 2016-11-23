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

    public function getGiocatoreById($id){

        $n=new Giocatore();
        $sql="SELECT * from giocatori WHERE idGiocatori='$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            if($row = $result->fetch_assoc()) {
                $n->setNome($row["nome"]);
                $n->setCognome($row["cognome"]);
                $n->setIdGiocatori($row["idGiocatori"]);
                $n->setGolFatti($row["golFatti"]);
                $n->setGolSubiti($row["golSubiti"]);
                $n->setAssist($row["assist"]);
                $n->setAmmonizioni($row["ammonizioni"]);
                $n->setEspulsioni($row["espulsioni"]);
                $n->setPresenze($row["presenze"]);
                $n->setRuolo($row["ruolo"]);
                $n->setValore($row["valore"]);
                $n->setResidenza($row["residenza"]);
                $n->setNazionalita($row["nazionalita"]);
                $n->setEmail($row["email"]);
                $n->setDataDiNascita($row["dataDiNascita"]);
                $n->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $n->setUrlImmagine($row["urlImmagine"]);
            }
            return $n;
        } else {
            return null;
        }
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
    public function delete($id)
    {

        $g = $this->getGiocatoreById($id);
        if ($g != null) {
            $query = "DELETE FROM giocatori WHERE idGiocatori='$id'";
            $this->conn->query($query);
            $url = "../web/immaginiApp/Giocatori/" . $g->getUrlImmagine();
            unlink($url);
            return $url;
        } else return null;
    }
    public function aggiornaGiocatore(Giocatore $g){

        $n=$g->getNome();
        $c=$g->getCognome();
        $id=$g->getIdGiocatori();
        $gF=$g->getGolFatti();
        $gS=$g->getGolSubiti();
        $a=$g->getAssist();
        $am=$g->getAmmonizioni();
        $esp=$g->getEspulsioni();
        $pre=$g->getPresenze();
        $ru=$g->getRuolo();
        $va=$g->getValore();
        $res=$g->getResidenza();
        $naz=$g->getNazionalita();
        $em=$g->getEmail();
        $dat=$g->getDataDiNascita();
        $url=$g->getUrlImmagine();

        $sql = "UPDATE giocatori SET  golFatti = '$gF', golSubiti = '$gS', assist = '$a',
        ammonizioni = '$am', espulsioni = '$esp', presenze = '$pre', ruolo = '$ru', valore = '$va', nome = '$n',
        cognome = '$c', residenza = '$res', nazionalita = '$naz', email = '$em',
        dataDiNascita = '$dat', urlImmagine = '$url' WHERE idGiocatori = $id";
        if (!$this->conn->query($sql)) {
            die($this->conn->error);
            return null;
        }
        else  return $g;

    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }


}