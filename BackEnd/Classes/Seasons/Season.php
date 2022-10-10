<?php
class Season
{
    private $id;
    private $dateStart;
    private $dateEnd;

    public function __construct($id = -1, DateTime $dateStart = null, DateTime $dateEnd = null)
    {
        $this->id = $id;

        echo is_null($dateStart);
        if (is_null($dateStart)) {
            $this->dateStart = new DateTime();
        } else {
            $this->dateStart = $dateStart;
        }

        echo is_null($dateEnd);
        if (is_null($dateEnd)) {
            $this->dateEnd = new DateTime();
        } else {
            $this->dateEnd = $dateEnd;
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }
}