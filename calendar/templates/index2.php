<?php
require '../vendor/autoload.php';



$app = new \Slim\Slim(array(
    'templates.path' => '../templates'
));

$app->get('/api', function () use ($app) {
// Get the start and end timestamps from request query parameters
$startTimestamp = $app->request->get('time');

try {
// Open database connection
$conn = new \PDO('mysql:host=127.0.0.1;dbname=ShopBuddy', 'root', 'root123');

// Query database for events in range
$stmt = $conn->prepare('SELECT * FROM Scans ORDER BY time ASC');
$stmt->bindParam(':time', $startTimestamp, \PDO::PARAM_INT);
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
    $app->render('calendar.html');
});

$app->run();

if (isset($_GET["url"])){
	echo "<script type='text/javascript'>window.open('" . $_GET['url'] . "')</script>";
}