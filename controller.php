<?php 
require_once 'core/init.php';

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

$base = new Base();

$method = $_REQUEST['m'];

switch ($method) {
  case 'getTickets':
    $base->OrderBy('Completed');
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
  case 'getCompanies':
    echo json_encode($base->baseQuery("SELECT DISTINCT Company FROM tickets WHERE Deleted = 0"));
    break;
  case 'deleteTicket':

    $base->delete('tickets', $decoded);
    
    echo json_encode('Deleted');

    break;
  case 'completeTicket':
    $base->update('tickets', $decoded, array(
      'Completed' => 1,
    ));
    echo json_encode('Updated');
    break;
  case 'incompleteTicket':
    $base->update('tickets', $decoded, array(
      'Completed' => 0,
    ));
    echo json_encode('Updated');
    break;
  default:
    # code...
    break;
}