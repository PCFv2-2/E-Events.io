<?php
function getRemainPoints($userId) {
    $db = new DataBase(DataBaseEnum::MAIN_READ);
    $pointsLeft = $db->selectQueryAndFetch('SELECT R.DEFAULT_POINT - IFNULL(SUM(EP.NB_POINTS),0)
                                                    FROM USERS U,
                                                    ROLES R,
                                                    EVENTS_POINTS EP
                                                    WHERE U.ROLE_ID = R.ROLE_ID
                                                    AND U.USER_ID = EP.USER_ID
                                                    AND U.USER_ID = ?',array($userId),'i');
    return $pointsLeft[0][0];
}