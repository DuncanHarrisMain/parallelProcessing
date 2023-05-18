<?php
require (__DIR__ . '/vendor/autoload.php');

// Libraries
use Amp\Future;
use Amp\Parallel\Worker;
use tasks\randomNum;
use function Amp\async;
//*                   *//

//Worker Pooling and Parallel Processing using AMPHP

$executions = [];

//foreach loop is used to limit the amount of workers generated.
//For this example a range will be used within the foreach loop
//$increment will be used as an identifier for the worker generated.
//This is only for illustration purposes, you are not required to pass any parameters to workers.

foreach(range(1,10) as $increment)
{
    $executions[$increment] = Worker\submit(new randomNum($increment));
}

//Below we will tell the program to wait for all worker to complete their tasks
//All results returned by workers will be mapped to responses.
$responses = Future\await(array_map(
    fn (Worker\Execution $e) => $e->getFuture(),
    $executions
));

//After all worker have returned their results and $responses have been mapped we will display all results
foreach ($responses as $response)
{
    var_dump($response);
}

//After viewing the results we note that the order in which results are mapped to $responses is not in the order the workers were constructed in the foreach loop
// meaning if the process was ran synchronously the output of results would be in ascending order from 1 to 10 but as you can see in the results the order is random
//or lets not say random but not in the order expected
//This is what we were actually expecting
//You would make use of parallel processing when making use of classes or functions that you would want to run on a large scale as the amount of time it
//takes a single thread to process these functions
//Parallel processing helps to reduce overall operational time and allows you to speed up processes that have a large processing time

//My explanation may not be that great but parallel processing is a great asset to reduce processing time and helps to lighten the load on your cpu as you are not relying
//on cpu power and you are rather focusing on IO time.

//This is a basic code illustration of how AMPHP parallel processing works.
//I will be combining parallel processing and the previous web scraper illustration
//to demonstrate a more complex use of those concepts.
//That video will be released soon.

//Thank You for taking the time out of your day to watch this video
//A more in depth explanation of parallel processing will be present in my next video.