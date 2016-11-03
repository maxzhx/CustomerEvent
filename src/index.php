<?php session_start(); ?>
<html ng-app="app">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, maximum-scale=1, inital-scale=1">
  <link rel="stylesheet" type="text/css" href="mystyle.css">
  <link rel="stylesheet" href="animate.css">
  <title>CustomerEvent</title>
</head>

<body ng-controller="EventsController">
<ng-view></ng-view>
<?php if(!isset($_SESSION["login_user"])){ ?>
  <form method="post" action="login.php">  
    <table id="login_table">
      <tr>
        <td><input class="login_text" type="text" name="username" value="" placeholder="Username"/></td>
      </tr>
      <tr>
        <td><input class="login_text" type="password" name="password" placeholder="Password"/></td>
      </tr>
      <tr>
        <td><input id="login_button" class="my_button" type="submit" value="Log in"/></td>
      </tr>
    </table>
  </form>

<?php }else{ ?>
<table id="control_table">
  <tr align="right">
    <td> </td>
    <td>
      <form action="logout.php">
      Hi, <?php echo $_SESSION["login_user"]?>
      <input id="log_out_btn" class="my_button" type="submit" value="Logout">
      </form>
    </td>
  </tr>

  <tr>
    <td colspan="2">
        HELP POOR CHILDREN IN UGANDA !
    </td>
  </tr>

  <tr>
    <td>
      <div>
        <button class="my_button submit_button" ng-click="show_customer()">Show Customer</button>
      </div>
    </td>

    <td>
      <div>
        <button class="my_button submit_button" ng-click="show_events()">Show Events</button>
      </div>
    </td>
  </tr>
</table>
</br>

<table style="table-layout:fixed;"ng-change="update()" id="result_table" cellspacing="5" cellpadding="5">

  <tr ng-click="show_detail(0)" ng-show="show_type==1">
    <th colspan="2">ID</td>
    <th colspan="4">FirstName</td>
    <th colspan="4">LastName</td>
    <th colspan="2"><button ng-click="add_data(); $event.stopPropagation();" class="my_button add_button">Add</button></th>
  </tr>

<tbody class="animate_whole" ng-repeat="customer in customers" ng-show="show_type==1" >
  <tr ng-click="show_detail(customer.customerId)">
    <td colspan="2">{{customer.customerId}}</td>
    <td colspan="4">{{customer.firstName}}</td>
    <td colspan="4">{{customer.lastName}}</td>
    <td colspan="2"><button ng-click="del_data(customer.customerId); $event.stopPropagation();" class="my_button del_button">Delete</button></td>
  </tr>
  <tr class="normal_tr animate_part" style="background-color: #95a5a6;" ng-show="detail_id==customer.customerId">
    <td colspan="2">FirstName</td>
    <td colspan="4"><input class="myinput" type="text" ng-model="customer.firstName"></td>
    <td colspan="2">LastName</td>
    <td colspan="4"><input class="myinput" type="text" ng-model="customer.lastName"></td>
  </tr>

  <tr class="mobile_tr" style="background-color: #95a5a6;" ng-show="detail_id==customer.customerId">
    <td colspan="4">First Name</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="customer.firstName"></td>
  </tr>
  <tr class="mobile_tr" style="background-color: #95a5a6;" ng-show="detail_id==customer.customerId">
    <td colspan="4">Last Name</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="customer.lastName"></td>
  </tr>

  <tr class="normal_tr animate_part" style="background-color: #95a5a6;" ng-show="detail_id==customer.customerId">
    <td colspan="2">Mobile</td>
    <td colspan="4"><input class="myinput" type="text" ng-model="customer.mobile"></td>
    <td colspan="2">Location</td>
    <td colspan="4"><input class="myinput" type="text" ng-model="customer.location"></td>
  </tr>

  <tr class="mobile_tr" style="background-color: #95a5a6;" ng-show="detail_id==customer.customerId">
    <td colspan="4">Mobile</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="customer.mobile"></td>
  </tr>
  <tr class="mobile_tr" style="background-color: #95a5a6;" ng-show="detail_id==customer.customerId">
    <td colspan="4">Location</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="customer.location"></td>
  </tr>

  <tr class="animate_part" style="background-color: #95a5a6;" ng-show="detail_id==customer.customerId">
    <td colspan="4">Email</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="customer.email"></td>
  </tr>
</tbody>


  <tr ng-click="show_detail(0)" ng-show="show_type==2">
    <th colspan="2">ID</td>
    <th colspan="5">Date</td>
    <th colspan="3">Customer</td>
    <th colspan="2"><button ng-click="add_data(); $event.stopPropagation();" class="my_button add_button">Add</button></th>
  </tr>

<tbody class="animate_whole" ng-repeat="event in events" ng-show="show_type==2">
  <tr ng-click="show_detail(event.eventId)">
    <td colspan="2">{{event.eventId}}</td>
    <td colspan="5">{{event.eventDateTime}}</td>
    <td colspan="3">{{event.customer}}</td>
    <td colspan="2"><button ng-click="del_data(event.eventId); $event.stopPropagation();" class="my_button del_button">Delete</button></td>
  </tr>
  <tr class="normal_tr animate_part" style="background-color: #95a5a6;" ng-show="detail_id==event.eventId">
    <td colspan="2">Customer</td>
    <td colspan="4"><input class="myinput" type="text" ng-model="event.customerId"></td>
    <td colspan="2">Type</td>
    <td colspan="4"><input class="myinput" type="text" ng-model="event.triggerType"></td>
  </tr>

  <tr class="mobile_tr" style="background-color: #95a5a6;" ng-show="detail_id==event.eventId">
    <td colspan="4">Customer</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="event.customerId"></td>
  </tr>
  <tr class="mobile_tr" style="background-color: #95a5a6;" ng-show="detail_id==event.eventId">
    <td colspan="4">Type</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="event.triggerType"></td>
  </tr>

  <tr class="animate_part" style="background-color: #95a5a6;" ng-show="detail_id==event.eventId">
    <td colspan="4">Location</td>
    <td colspan="8"><input class="myinput" type="text" ng-model="event.triggeredLocation"></td>
  </tr>

  <tr class="animate_part" style="background-color: #95a5a6;" ng-show="detail_id==event.eventId">
    <td colspan="4">Date</td>
     <!--<td colspan="8"><input class="myinput" type="text" ng-model="event.eventDateTime"></td>-->
     <td colspan="8"><input id="start_time" class="date_selector" ng-model="event.eventDateTime" type="datetime-local" name="start_time"></td>
  </tr>

</tbody>


<?php } ?>

<!-- Template -->

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.28/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.28/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.28/angular-route.min.js"></script>
<script src = "ngcontroller.js"> </script>
</body>
</html>
