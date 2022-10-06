<?php
require '../Constants/DataBaseConstants.php';

class DataBase
{
    //Variables de classe
    private $dbLink;

    /**
     * @param $dataBaseType : int
     */
    public function __construct($dataBaseType)
    {
        try {
            switch ($dataBaseType) {
                case 0 :
                    $this->dbLink = mysqli_connect(HOSTNAME, USERNAME_LOGINS_READ, PASSWORD_LOGINS_READ, DATABASE_LOGINS);
                    break;
                case 1:
                    $this->dbLink = mysqli_connect(HOSTNAME, USERNAME_LOGINS_WRITE, PASSWORD_LOGINS_WRITE, DATABASE_LOGINS);
                    break;
                case 2 :
                    $this->dbLink = mysqli_connect(HOSTNAME, USERNAME_MAIN_READ, PASSWORD_MAIN_READ, DATABASE_MAIN);
                    break;
                case 3 :
                    $this->dbLink = mysqli_connect(HOSTNAME, USERNAME_MAIN_WRITE, PASSWORD_MAIN_WRITE, DATABASE_MAIN);
                    break;
                default :
                    throw new RuntimeException('No database type selected !');
            }
        } catch (Exception $e) {
            throw new \http\Exception\RuntimeException('Error during linking');
        }
    }

    public function __destruct()
    {
        mysqli_close($this->dbLink);
    }

    public function queryAndFetch($query)
    {
        try {
            $dbResult = mysqli_query($this->dbLink,$query);

            $index = 0;
            $tab = array();
            while ($dbRow = mysqli_fetch_assoc($dbResult)){
                $tab[$index] = $dbRow;
                $index += 1;
            }
        } catch (Exception $e){
            throw new \http\Exception\RuntimeException('Error during querying');
        }

        return $tab;
    }

    public function close () {
        try {
            mysqli_close($this->dbLink);
        } catch (Exception $e){
            throw new \http\Exception\RuntimeException('Error during closing');
        }
    }
}