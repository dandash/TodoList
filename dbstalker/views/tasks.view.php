<?php
class users_view extends Stalker_View
{
    public function view_query()
    {
        return "SELECT `tasks`.`id`,
                    `tasks`.`id` AS `#`,
                    `tasks`.`taskname` AS `Task`,
                    `tasks`.`priority` AS `Priorty`,
                   FROM `tasks`
                  ORDER BY `tasks`.`tasks`";
    }
}
