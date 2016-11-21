<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 17/11/2016
 * Time: 18:39
 */

namespace AppBundle\Manager;
use AppBundle\Model\News;
use AppBundle\Utility\DB;


/**
 * Class ManagerNews
 * @package AppBundle\Manager
 */
class ManagerNews
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
     * ManagerNews constructor.
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
    public function getNewsByIdSquadra($idSquadra)
    {

        $news=array();
        $sql="SELECT * from news WHERE Squadre_idSquadre='$idSquadra'";
        $result = $this->conn->query($sql);
        $res="";
        $i=0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $n=new News();
                $n->setIdNews($row["idNews"]);
                $n->setTitolo($row["titolo"]);
                $n->setContenuto($row["contenuto"]);
                $n->setData($row["data"]);
                $n->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $n->setUrlImmagine($row["urlImmagine"]);
                $news[$i]=$n;
                $i++;
            }
            return $news;
        } else {
            return null;
        }


    }

    /**
     * @param News $news
     */
    public function insert(News $news)
    {

        $query="INSERT INTO news (titolo,contenuto, data,Squadre_idSquadre,urlImmagine) VALUES
        ('".$news->getTitolo()."', '".$news->getContenuto()."', '".$news->getData()."', '".$news->getSquadreIdSquadre()."', 
            '".$news->getUrlImmagine()."')";
        if (!$this->conn->query($query)) {
            die($this->conn->error);
        }


    }


    /**
     * @param $id
     * @return News|null
     */
    public function getNewsById($id){

        $n=new News();
        $sql="SELECT * from news WHERE idNews='$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            if($row = $result->fetch_assoc()) {
                $n->setIdNews($row["idNews"]);
                $n->setTitolo($row["titolo"]);
                $n->setContenuto($row["contenuto"]);
                $n->setData($row["data"]);
                $n->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $n->setUrlImmagine($row["urlImmagine"]);
            }
            return $n;
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @return null|string
     */
    public function delete($id){

        $n=$this->getNewsById($id);
        if($n!=null){
            $query="DELETE FROM news WHERE 	idNews='$id'";
            $this->conn->query($query);
            $url="../web/immaginiApp/News/".$n->getUrlImmagine();
            unlink($url);
            return $url;
            }
        else return null;



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