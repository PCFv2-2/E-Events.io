<?php
function getRemainPoints($userId) {
    $db = new DataBase(DataBaseEnum::MAIN_READ);
    $pointsLeft = $db->selectQueryAndFetch('SELECT IFNULL(S.DEFAULT_POINTS - IFNULL(SUM(EP.NB_POINTS),0),-1)
                                                    FROM SEASONS S,
                                                    EVENTS_POINTS EP,
                                                    EVENTS E
                                                    WHERE S.SEASON_ID = E.SEASON_ID
                                                    AND E.EVENT_ID = EP.EVENT_ID
                                                    AND S.SEASON_ID = (SELECT SEASON_ID FROM SEASONS S WHERE NOW() BETWEEN S.DATE_START AND S.DATE_END)
                                                    AND EP.USER_ID = ?',array($userId),'i');
    return $pointsLeft[0][0];
}