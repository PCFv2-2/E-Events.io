<?php
//require_once '../../Required.php';
require_once Required::getMainDir() . '/BackEnd/Constants/dataBaseConstants.php';

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
            throw new RuntimeException('Error during linking');
        }
    }

    public function selectQueryAndFetch($query, $params = array(), $types = null): array
    {
        try {
//            $dbResult = mysqli_query($this->dbLink, $query);
            $queryPrepared = $this->dbLink->prepare($query);

            if (is_bool($queryPrepared)) {
                throw new RuntimeException('Error during querying');
            }
            if ($types != null) {
                $queryPrepared->bind_param($types, ...$params);
            }
            $queryPrepared->execute();

            $result = $queryPrepared->get_result();

        } catch (Exception $e) {
            throw $e;
        }

        return $result->fetch_all();
    }

    public function insertQueryAndFetch($query, $params = array(), $types = '')
    {
        try {
            $queryPrepared = $this->dbLink->prepare($query);

            if (is_bool($queryPrepared)) {
                throw new RuntimeException('Error during querying');
            }

            $queryPrepared->bind_param($types, ...$params);
            $queryPrepared->execute();

            return $queryPrepared->insert_id; //retourne l'id que je viens d'inserer
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function close()
    {
        try {
            mysqli_close($this->dbLink);
        } catch (Exception $e) {
            throw new RuntimeException('Error during closing');
        }
    }
}