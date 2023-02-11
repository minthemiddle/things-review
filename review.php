<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/activeProjectsQuery.php";

// var_dump($things_absolute_path);
// die;

// FIX: Get DB from config.php not ENV
$thingsDB = new SQLite3(getenv('THINGS'));


foreach ($project_types as $project_type) {
    // Query results
    $sqliteAreasArray = "('" . implode("','", $project_type['area_ids']) . "')";

    $activeProjectsQuery = sprintf($raw, $sqliteAreasArray);
    $activeProjects = $thingsDB->query($activeProjectsQuery);

    $i = 0;
    $current_week_number = idate('W', time());

    $data = array();
    $data['type'] = 'project';
    $data['attributes']['title'] = $project_type['title'] . ' - Week ' . $current_week_number;
    // MOVE TO settings, where review project goes
    $data['attributes']['area-id'] = $project_type['area_id_to_save_review_project'];


    while ($row = $activeProjects->fetchArray()) {
        $data['attributes']['items'][$i]['type'] = 'to-do';
        $data['attributes']['items'][$i]['attributes']['title'] = $row['title'];
        $data['attributes']['items'][$i]['attributes']['notes'] = "[Link](things:///show?id=" . $row['uuid'] . ")";
        $i++;
    }

    $things_json = json_encode($data);
    $things_command = 'open \'things:///json?data=[' . $things_json . ']\'';

    shell_exec($things_command);
}
