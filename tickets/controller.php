<?php 
require_once 'core/init.php';

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);
//$db = DB::getInstance();

$base = new Base();

$method = $_REQUEST['m'];




switch ($method) {
  case 'getTickets':
    echo json_encode($base->listItems('tickets'));
    break;
  case 'addTicket':
    $base->insert('tickets', array(
      'Name' => $decoded['name'],
      'Description' => $decoded['description'],
      'Company' => $decoded['company'],
      'DueDate' => $decoded['date'],
    ));

    echo json_encode('Inserted');
 
    break;
  case 'getCompanies';
    echo json_encode($base->baseQuery("SELECT DISTINCT Company FROM tickets WHERE Deleted = 0"));
    break;
  case 'deleteTicket':

    //var_dump($decoded);

    $base->delete('tickets', $decoded);

    echo json_encode('Deleted');

    break;
  default:
    # code...
    break;
}