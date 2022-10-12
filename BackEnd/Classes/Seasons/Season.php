<?php
class Season
{
    private $id;
    private $dateStart;
    private $dateEnd;
    private $defaultPoint;

    public function __construct($id = -1, DateTime $dateStart = null, DateTime $dateEnd = null, $defaultPoint = 0)
    {
        $this->id = $id;
        $this->defaultPoint = $defaultPoint;
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

    /**
     * @return mixed
     */
    public function getDefaultPoint()
    {
        return $this->defaultPoint;
    }
}