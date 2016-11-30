<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 17/11/2016
 * Time: 18:39
 */

namespace AppBundle\Manager;
use AppBundle\Utility\DB;
use AppBundle\Model\Formazione;

/**
 * Class ManagerFormazione
 * @package AppBundle\Manager
 */
class ManagerFormazione
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

    public function insert(Formazione $f)
    {

        $query="INSERT INTO formazioni (golFatti,golSubiti,Partite_idPartita, Giocatori_idGiocatori,assist, ruolo, minutiGiocati,votoPersonale
                ,ammonizioni,espulsioni) 
                  VALUES ('".$f->getGolFatti()."', '".$f->getGolSubiti()."', '".$f->getPartiteIdPartita()."', '".$f->getGiocatoriIdGiocatori()."',
                   '".$f->getAssist()."', '".$f->getRuolo()."','".$f->getMinutiGiocati()."','".$f->getVotoPersonale()."','".$f->getAmmonizioni()."',
                   '".$f->getEspulsioni()."')";
        if (!$this->conn->query($query)) {
            return null;
        }
        else return $f;

    }

    public function aggiornaFormazione(Formazione $f){

        $gio=$f->getGiocatoriIdGiocatori();
        $part=$f->getPartiteIdPartita();
        $amm=$f->getAmmonizioni();
        $ass=$f->getAssist();
        $esp=$f->getEspulsioni();
        $gol=$f->getGolFatti();
        $gS=$f->getGolSubiti();
        $ru=$f->getRuolo();
        $vo=$f->getVotoPersonale();
        $min=$f->getMinutiGiocati();

        $sql = "UPDATE formazioni SET  golFatti='$gol',golSubiti='$gS',assist='$ass', ruolo='$ru', minutiGiocati='$min',
                votoPersonale='$vo'
                ,ammonizioni='$amm',espulsioni='$esp'  WHERE Giocatori_idGiocatori='$gio' AND Partite_idPartita='$part'";
        if (!$this->conn->query($sql)) {
            return null;
        }
        else  return $f;

    }

    public function getFormazioneConDatiGiocatore($idPartita){
        $statistichePerGiocatore=array();
        $sql="SELECT * from formazioni WHERE Partite_idPartita='$idPartita'";
        $result = $this->conn->query($sql);
        $i=0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $f=new Formazione();
                $f->setGiocatoriIdGiocatori($row["Giocatori_idGiocatori"]);
                $f->setPartiteIdPartita($row["Partite_idPartita"]);
                $f->setAmmonizioni($row["ammonizioni"]);
                $f->setAssist($row["assist"]);
                $f->setEspulsioni($row["espulsioni"]);
                $f->setGolFatti($row["golFatti"]);
                $f->setGolSubiti($row["golSubiti"]);
                $f->setRuolo($row["ruolo"]);
                $f->setVotoPersonale($row["votoPersonale"]);
                $f->setMinutiGiocati($row["minutiGiocati"]);
                $statistichePerGiocatore[$i]=$f;
                $i++;

            }
            return $statistichePerGiocatore;
        } else {
            return null;
        }

    }

    public function deleteFormazioniById($id){

        $mP=new ManagerPartita();
        $p=$mP->getPartitaById($id);
        if($p!=false){
            $query="DELETE FROM formazioni WHERE Partite_idPartita='$id'";
            $this->conn->query($query);
            return $p;
        }
        else return null;



    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }


}