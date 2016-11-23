<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 18:31
 */

namespace AppBundle\Manager;
use AppBundle\Model\Partecipazione;
use AppBundle\Utility\DB;

class ManagerPartecipazione
{

    private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    public function getAll(){
        $sql = "SELECT * from partecipazione";
        $result = $this->conn->query($sql);
        if($result->num_rows >0){
            $i=0;
            $partecipazioni = array();
            while($row = $result->fetch_assoc()){
                $s = new Partecipazione();
                $s->setIdSquadre($row["Squadre_idSquadre"]);
                $s->setIdTornei($row["Tornei_idTornei"]);
                $s->setPunteggio($row["punteggio"]);
                $s->setVittorie($row["vittorie"]);
                $s->setPareggi($row["pareggi"]);
                $s->setSconfitte($row["sconfitte"]);
                $partecipazioni[$i] = $s;
                $i++;
            }
            return $partecipazioni;
        }
        else {
            return FALSE;
        }
    }


    public function getPartecipazioniBySquadra($id){
        $managerSquadra = new ManagerSquadra();
        $controllo = $managerSquadra->getById($id);
        if($controllo!=FALSE){
            $sql = "SELECT * FROM partecipazione WHERE Squadre_idSquadre = '$id'";
            $result = $this->conn->query($sql);
            $i=0;
            $partecipazioni = array();
            while($row = $result->fetch_assoc()){
                $s = new Partecipazione();
                $s->setIdSquadre($row["Squadre_idSquadre"]);
                $s->setIdTornei($row["Tornei_idTornei"]);
                $s->setPunteggio($row["punteggio"]);
                $s->setVittorie($row["vittorie"]);
                $s->setPareggi($row["pareggi"]);
                $s->setSconfitte($row["sconfitte"]);
                $partecipazioni[$i] = $s;
                $i++;
            return $partecipazioni;
            }
        } else {
            return FALSE;
        }
    }

    public function getPartecipazioniByTorneo($id){
        $managerTorneo = new ManagerTorneo();
        $controllo = $managerTorneo->getTorneoById($id);
        if($controllo!=FALSE){
            $sql = "SELECT * FROM partecipazione WHERE Tornei_idTornei = '$id'";
            $result = $this->conn->query($sql);
            $i=0;
            $partecipazioni = array();
            while($row = $result->fetch_assoc()){
                $s = new Partecipazione();
                $s->setIdSquadre($row["Squadre_idSquadre"]);
                $s->setIdTornei($row["Tornei_idTornei"]);
                $s->setPunteggio($row["punteggio"]);
                $s->setVittorie($row["vittorie"]);
                $s->setPareggi($row["pareggi"]);
                $s->setSconfitte($row["sconfitte"]);
                $partecipazioni[$i] = $s;
                $i++;
                return $partecipazioni;
            }
        } else {
            return FALSE;
        }
    }

    public function inserisciPartecipazione(Partecipazione $part){
        $idT = $part->getIdTornei();
        $idS = $part->getIdSquadre();
        $manT = new ManagerTorneo();
        $manS = new ManagerSquadra();
        if($manT->getTorneoById($idT) && $manS->getById($idS)) {
            $sql = "INSERT INTO partecipazione (punteggio, vittorie, pareggi, sconfitte, Squadre_idSquadre, Tornei_idTornei) VALUES ('" . $part->getPunteggio() . "','" . $part->getVittorie() . "','" . $part->getPareggi() . "','" . $part->getSconfitte() . "','" . $part->getIdSquadre() . "','" . $part->getIdTornei() . "')";
            $risultato = $this->conn->query($sql);
            return $risultato;
        } else {
            return FALSE;
        }
    }

    public function aggiornaPartecipazione(Partecipazione $part){
        $idT = $part->getIdTornei();
        $idS = $part->getIdSquadre();
        $manT = new ManagerTorneo();
        $manS = new ManagerSquadra();
        if($manT->getTorneoById($idT) && $manS->getById($idS)) {
            $sql = "UPDATE partecipazione SET punteggio='" . $part->getPunteggio() . "', vittorie='" . $part->getVittorie() . "' , pareggi='" . $part->getPareggi() . "' , sconfitte= '" . $part->getSconfitte() . "', Squadre_idSquadre='" . $part->getIdSquadre() . "' , Tornei_idTornei='" . $part->getIdTornei() . "' WHERE Squadre_idSquadre='".$part->getIdSquadre() ."' AND Tornei_idTornei='".$part->getIdTornei()."'";
            $risultato = $this->conn->query($sql);
            return $risultato;
        } else {
            return FALSE;
        }
    }

    public function eliminaPartecipazione(Partecipazione $part){
        $idT = $part->getIdTornei();
        $idS = $part->getIdSquadre();
        $manT = new ManagerTorneo();
        $manS = new ManagerSquadra();
        if($manT->getTorneoById($idT) && $manS->getById($idS)) {
            $sql = "DELETE FROM partecipazione WHERE Squadre_idSquadre='".$part->getIdSquadre() ."' AND Tornei_idTornei='".$part->getIdTornei()."'";
            $risultato = $this->conn->query($sql);
            return $risultato;
        } else {
            return FALSE;
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }
}