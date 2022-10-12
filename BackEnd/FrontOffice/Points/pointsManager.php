<?php
function getRemainPoints($userId) {
    $db = new DataBase(DataBaseEnum::MAIN_READ);
    $pointsLeft = $db->selectQueryAndFetch('SELECT S.DEFAULT_POINTS - IFNULL(SUM(EP.NB_POINTS),0)
                                                    FROM SEASONS S,
                                                    EVENTS_POINTS EP,
                                                    EVENTS E
                                                    WHERE S.SEASON_ID = E.SEASON_ID
                                                    AND E.EVENT_ID = EP.EVENT_ID
                                                    AND S.SEASON_ID = (SELECT MAX(SEASON_ID) FROM SEASONS)
                                                    AND EP.USER_ID = ?',array($userId),'i');
    return $pointsLeft[0][0];
}