<?php
namespace App\Repository;

use App\Helpers\NthFibonacciCalculator;

class FibonacciSetRepository {

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllFibonacciSets()
    {
        $query = "
            SELECT 
                id, number, nthFibOfNumber
            FROM
                fibonacci_sets;
        ";

        try {
            $statement = $this->db->query($query);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    public function getFibonacciSet($number)
    {
        $result = $this->findByNumber($number);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    public function createFibonacciSet()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validateFibonacciSet($input)) {
            return $this->unprocessableEntityResponse();
        }

        $query = "
            INSERT INTO fibonacci_sets 
                (number, nthFibOfNumber)
            VALUES
                (:number, :nthFibOfNumber);
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array(
                'number' => $input['number'],
                'nthFibOfNumber'  => $input['nthFibOfNumber']
            ));
            $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode(array('message' => 'FibonacciSet Created'));
        return $response;
    }

    public function updateFibonacciSet($id)
    {
        $result = $this->findById($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validateFibonacciSet($input)) {
            return $this->unprocessableEntityResponse();
        }

        $statement = "
            UPDATE fibonacci_sets
            SET 
                number = :number,
                nthFibOfNumber  = :nthFibOfNumber,
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' => (int) $id,
                'number' => $input['number'],
                'nthFibOfNumber'  => $input['nthFibOfNumber'],
            ));
            $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('message' => 'FibonacciSet Updated!'));
        return $response;
    }

    public function deleteFibonacciSet($id)
    {
        $result = $this->findById($id);
        if (! $result) {
            return $this->notFoundResponse();
        }

        $query = "
            DELETE FROM fibonacci_sets
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array('id' => $id));
            $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(array('message' => 'FibonacciSet Deleted!'));
        return $response;
    }

    public function findById($id)
    {
        $query = "
            SELECT 
                id, number, nthFibOfNumber
            FROM
                fibonacci_sets
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array('id' => $id));
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function findByNumber($number)
    {
        $query = "
            SELECT 
                id, number, nthFibOfNumber     
            FROM
                fibonacci_sets
            WHERE number = :number;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array('number' => $number));
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            /** If no corresponsing number/nthFib entry exists, we calulate the nth fibonacci of n and add a new entry */
            if(!$result){
                try {
                    $nthFib = (new NthFibonacciCalculator())->getNumber($number);
                    $statement = $this->db->prepare(" INSERT INTO fibonacci_sets (number, nthFibOfNumber) VALUES(:number, :nthFibOfNumber);");
                    $statement->execute(array(
                        'number' => $number,
                        'nthFibOfNumber'  => $nthFib
                    ));
                    $statement->rowCount();
                    $result = $statement->fetch(\PDO::FETCH_ASSOC);
                } catch (\PDOException $e) {
                    exit($e->getMessage());
                }
            }
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    private function validateFibonacciSet($input)
    {
        if (! isset($input['number'])) {
            return false;
        }
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    public function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}