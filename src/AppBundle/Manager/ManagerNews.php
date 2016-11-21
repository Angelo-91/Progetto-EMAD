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


class ManagerNews
{

   private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

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
                $n->setTitolo($row["titolo"]);
                $news[$i]=$n;
                $i++;
            }
            return $news;
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