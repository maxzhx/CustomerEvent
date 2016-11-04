<?php
header("Content-Type: text/html;charset=utf-8");

$connections = new MongoClient("mongodb://mongodb:27017"); // connect
$db = $connections->customerevent;

$type = $_GET["type"];

if ($type == 1) {

  $customers = $db->customers;
  // $cus = $customers->findOne();
  // var_dump( $cus );

  $customerId = $_GET["customerId"];
  echo $custmerId;
  $data = array("customerId" => $_GET["customerId"],
      "firstName" => $_GET["firstName"],
      "lastName" => $_GET["lastName"],
      "email" => $_GET["email"],
      "mobile" => $_GET["mobile"],
      "location" => $_GET["location"]
  );

  $customers->update(array("customerId"=>$customerId), $data, array("upsert"=>"true"));
  echo "updated";

  // echo json_encode($result);

} else {

  $events = $db->events;
  // $cus = $customers->findOne();
  // var_dump( $cus );

  $eventId = $_GET["eventId"];
  echo $custmerId;
  $data = array("eventId" => $_GET["eventId"],
      "customerId" => $_GET["customerId"],
      "eventDateTime" => $_GET["eventDateTime"],
      "triggeredLocation" => $_GET["triggeredLocation"],
      "triggerType" => $_GET["triggerType"],
  );

  $events->update(array("eventId"=>$eventId), $data, array("upsert"=>"true"));
  echo "updated";

}
?>
