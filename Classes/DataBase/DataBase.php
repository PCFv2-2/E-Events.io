<?php
require_once '../../Required.php';
require_once Required::getMainDir() . '/Constants/DataBaseConstants.php';

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

    public function selectQueryAndFetch($query, $params, $types)
    {
        try {
//            $dbResult = mysqli_query($this->dbLink, $query);
            $queryPrepared = $this->dbLink->prepare($query);

            if (is_bool($queryPrepared)){
                throw new \http\Exception\RuntimeException('Error during querying');
            }

            $queryPrepared->bind_param($types, ...$params);
            $queryPrepared->execute();

            $index = 0;
            $tab = array();
            while ($dbRow = $queryPrepared->fetch()) {
                $tab[$index] = $dbRow;
                $index += 1;
            }
        } catch (Exception $e) {
            throw new \http\Exception\RuntimeException('Error during querying');
        }

        return $tab;
    }

    public function close()
    {
        try {
            mysqli_close($this->dbLink);
        } catch (Exception $e) {
            throw new \http\Exception\RuntimeException('Error during closing');
        }
    }
}

$db = new DataBase(DataBaseEnum::MAIN_READ);
print_r($db->selectQueryAndFetch('SELECT * FROM `ROLES` WHERE ROLE_ID = ?',array('1'),'i'));