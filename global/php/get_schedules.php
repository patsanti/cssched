<?php

require_once 'connect.php';

$config = array(
    'orderResultBy' => array(
        'professor' => 'professor.prof_lname, subject.subject_name, schedule.day, room.room_id, schedule.start_time',
        'class'     => '',
        'block'     => ''
    ),
    'inputConstraint' => array(
        'unit'       => array('lecture' => array('minValue' => 1, 'step' => 0.01)),
        'time'       => array('step' => 1800),
        'dayLiteral' => array(
            'abbr' => array('Su', 'M', 'T', 'W', 'Th', 'F', 'Sa'),
            'full' => array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')
        )
    )
);

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['year'], $_GET['orderBy'])) {
    //sanitize input
    if(strlen($_GET['year']) !== 4 || intval($_GET['year']) === 0 || !isset($config['orderResultBy'][$_GET['orderBy']])) {
        http_response_code(406);
        exit();
    }

    $query =
    'SELECT '.
        'schedule.sched_no, '.
        'schedule.day, '.
        'DATE_FORMAT(schedule.start_time, "%H:%i") AS start_time, '.
        'DATE_FORMAT(schedule.end_time, "%H:%i") AS end_time, '.
        'schedule.acad_year, '.
        'subject.*, '.
        'professor.*, '.
        'room.*, '.
        'class.* '.
    'FROM '.
        'schedule, '.
        'subject, '.
        'professor, '.
        'room, '.
        'class '.
    'WHERE  '.
        'schedule.subject_id = subject.subject_id AND '.
        'schedule.prof_id = professor.prof_id AND '.
        'schedule.room_id = room.room_id AND '.
        'schedule.class_id = class.class_id AND '.
        'schedule.acad_year = '.$_GET['year'].' '.
    'ORDER BY '.$config['orderResultBy'][$_GET['orderBy']];

    $result = $conn->query($query);
    if(!$result) {
        http_response_code(500);
        exit();
    }

    $schedules = array();
    while($row = $result->fetch_assoc()) {
        array_push($schedules, $row);
    }

    echo json_encode(
        array(
            'scheduleTable'   => $schedules,
            'inputConstraint' => $config['inputConstraint']
        )
    );
}
else http_response_code(405)

?>