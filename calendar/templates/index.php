<?php
require '../vendor/autoload.php';
include '../../server.php';



$app = new \Slim\Slim(array(
    'templates.path' => '../templates'
));


$app->get('/api', function () use ($app) {
// Get the start and end timestamps from request query parameters
$startTimestamp = $app->request->get('start');
$endTimestamp = $app->request->get('end');

try {
// Open database connection
$conn = new \PDO('mysql:host=127.0.0.1;dbname=calendar', 'root', 'root123');

// Query database for events in range
if ($_SESSION['userID']==1){
$stmt = $conn->prepare('SELECT * FROM events WHERE user = 1 ORDER BY start ASC');
}
else{
	$stmt = $conn->prepare('SELECT * FROM events WHERE user = 2 ORDER BY start ASC');
}
$stmt->bindParam(':start', $startTimestamp, \PDO::PARAM_INT);
$stmt->bindParam(':end', $endTimestamp, \PDO::PARAM_INT);
$stmt->execute();

// Fetch query results
$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

// Return query results as JSON
echo json_encode($results);
} catch (\PDOException $e) {
$app->halt(500, $e->getMessage());
}
});

$app->get('/', function () use ($app) {
    $app->render('calendar.php');
});

$app->run();

if (isset($_GET["url"])){
	echo "<script type='text/javascript'>window.open('" . $_GET['url'] . "')</script>";
}