<?php

header("Content-Type: text/html;charset=utf-8");

$connections = new MongoClient(); // connect
$db = $connections->localz;

$type = $_GET["type"];

if ($type == 1) {

  $customers = $db->customers;
  $customers->remove(array('customerId' => $_GET["id"]));
    echo "test";

  echo "deleted";

} else {


  $events = $db->events;
  $events->remove(array('eventId' => $_GET["id"]));

  echo "deleted";
}
?>
