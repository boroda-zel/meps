<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo 'test';
function __autoload($class_name) {
    include_once '../inc/class.' . $class_name . '.inc.php';
}

echo DBconnect::connect();
$type = $_POST['type'];
$period = $_POST['period'];
$group = $_POST['group'];
$date = date(Y) . '-' . date(m) . '-' . date(d);
//echo $date;
$date1 = new DateTime();
$i = 1;
$final = array();

while ($i <= $period) {
    $i++;
    $date = $date1->format("Y-m-d");
    $date1->modify('-1' . $group);
    $pins = pg_query("SELECT card_types.name, count(status) as cnt
FROM public.cards
INNER JOIN operations.master ON (cards.id_operation=master.id_operation)
INNER JOIN public.card_types ON (cards.id_card_type=card_types.id_card_type)
WHERE card_types.id_service=$type and master.oper_day < '$date' and master.oper_day > (date '$date' - interval '1 $group')
GROUP BY card_types.id_card_type
ORDER BY card_types.id_card_type");
    //$pins = pg_fetch_array($pins);
    //$test = $pins['sold'];
    $array = array("Date from" => $date, "Date to" => $date1->format("Y-m-d"));
    while ($record = pg_fetch_array($pins)) {
        $array = $array + array($record['name'] => $record['cnt']);
        echo $record['name'];
        echo ' ';
        echo $record['cnt'];
        echo ' ';
        echo $date;
        echo '<br>';
    }
    $final = $final + array($array);
}
$names_array=array();

$name = pg_query("Select card_types.name from public.card_types WHERE card_types.id_service=$type ORDER BY id_card_type ");
while ($record = pg_fetch_array($name)) {
    $names_array = $names_array + array($record['name']);
}
print"<table>";
print"<tr><td>Name</td><td>Date from/to</td>";
for ($i=0; $i < count($names_array); $i++) {
    print"<tr><td>".$names_array[$i]."</td>";
}