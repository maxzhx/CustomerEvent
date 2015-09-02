<?php

header("Content-Type: text/html;charset=utf-8");

$connections = new MongoClient(); // connect
$db = $connections->localz;

$type = $_GET["type"];

if ($type == 1) {

  $customers = $db->customers;
  // $cus = $customers->findOne();
  // var_dump( $cus );
  $cursor = $customers->find();
  $cursor->sort(array('customerId' => -1));
  foreach ( $cursor as $id => $value )
  {
      // echo "$id: ";
      // var_dump( $value );
      $result[] = $value;
  }

  echo json_encode($result);

} else {

  $events = $db->events;
  $customers = $db->customers;
  // $cus = $customers->findOne();
  // var_dump( $cus );
  $cursor = $events->find();
  $cursor->sort(array('eventId' => -1));
  $defaultTimeZone='UTC';
  foreach ( $cursor as $id => $value )
  {
      // echo "$id: ";
      // var_dump( $value );
      // $datetime = $value["eventDateTime"];
      // $c = $customers->findOne(array('customerId'=>$value["customerId"]), array('firstName'));
      // echo $value['customerId'];
      $c = $customers->find(array("customerId"=>$value["customerId"]));

      if($c->count() == 0 ){
          $value['customer'] = "Invalid User";

      } else {
          $cus = $c->getNext();
          $value['customer'] = $cus['firstName'] . " ". $cus['lastName'];
      }
      // echo $c->count();

      $value["eventDateTime"] = date("Y-m-d\TH:i:s", strtotime($value["eventDateTime"]));
      // echo " ";
      $result[] = $value;
  }

  echo json_encode($result);
}
// echo json_encode($cus);


// $con = mysql_connect("localhost","phpmyadmin","max_949422zhx");
// if (!$con) {
    // die('Could not connect: ' . mysql_error());
// }
// mysql_query("SET NAMES 'UTF8'");
// mysql_select_db("phpmyadmin", $con);

// $type = $_GET["type"];

// if ($type == 1) {
    // $sql = "SELECT order_id FROM dm_order WHERE date_paid >='".
           // $_GET["start"]. "'and date_paid <='". $_GET["end"]. "'";
    // // echo $sql;
    // $result = mysql_query($sql);

    // while($row = mysql_fetch_assoc($result)){
        // $row['cash'] = get_amount($row['order_id'], '-1000');
        // $row['credit'] = get_amount($row['order_id'], '-1001');
        // $row['eftpos'] = get_amount($row['order_id'], '-1002');
        // $row['amount'] = $row['cash'] + $row['credit'] + $row['eftpos'];
        // // echo json_encode($row);
        // $rows[] = $row;
    // }
    // echo json_encode($rows);

// } else {

    // $sql = "SELECT product_id, name, quantity, total FROM dm_order_product ".
           // "WHERE date_added >='". $_GET["start"].
           // "'and date_added <='". $_GET["end"]. "'";
    // // echo $sql;
    // $result = mysql_query($sql);

    // $id_array = array();
    // while($row = mysql_fetch_assoc($result)){
        // // echo json_encode($row);
        // if(in_array($row['product_id'], $id_array)){
            // $index = array_search($row['product_id'], $id_array);
            // $rows[$index]['quantity'] += $row['quantity'];
            // $rows[$index]['total'] += $row['total'];
        // } else {
            // $id_array[] = $row['product_id'];
            // $rows[] = $row;
        // }
    // }
    // echo json_encode($rows);
// }

// mysql_close($con);

?>
