<?php
namespace App\Controller;

use App\Repository\FibonacciSetRepository;

class FibonacciSetsController
{

    public function __construct($db, $requestMethod, $fibonacciSetId)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->fibonacciSetId = $fibonacciSetId;
    }

    public function processRequest()
    {
        $repository = new FibonacciSetRepository($this->db);
        switch ($this->requestMethod) {
            case 'GET':                         /** GET method returs the appropriate fibonacci set if the number is already in the DB */
                if ($this->fibonacciSetId) {   /** if not, $repository->getFibonacciSet calculates the fibonacci using the helper and inserts it to DB */
                    $response = $repository->getFibonacciSet($this->fibonacciSetId);
                } else {
                    $response = $repository->getAllFibonacciSets();
                };
                break;
            case 'POST':
                $response = $repository->createFibonacciSet();
                break;
            case 'PUT':
                $response = $repository->updateFibonacciSet($this->fibonacciSetId);
                break;
            case 'DELETE':
                $response = $repository->deleteFibonacciSet($this->fibonacciSetId);
                break;
            default:
                $response = $repository->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

}