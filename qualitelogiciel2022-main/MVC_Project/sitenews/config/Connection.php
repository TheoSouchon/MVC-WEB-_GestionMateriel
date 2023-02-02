<?php

// Connection class extending PDO to handle database connections and queries
class Connection extends PDO {

    private $stmt;

    /**
     * Summary of __construct
     * @param string $dsn
     * @param string $user
     * @param string $pass
     * This function is the constructor for the Connection class.
     */
    public function __construct(string $dsn, string $user, string $pass) {

        parent::__construct($dsn,$user,$pass);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }




    


    /**
     * Summary of executeQuery
     * @param string $query
     * @param array $parameters
     * @return bool
     */
    public function executeQuery(string $query, array $parameters = []) : bool{
        //echo'datas :'.$query.' param :'.$parameters;
        $this->stmt = parent::prepare($query);
        foreach ($parameters as $name => $value) {
            $this->stmt->bindValue($name, $value[0], $value[1]);
        }

        return $this->stmt->execute();
    }

    /** 
     * Method to get all results from the previously executed query
     * @return array Returns an array containing all of the results from the previously executed query. 
     * If the query was not executed or if it failed, the function will return an empty array.
     */
    public function getResults() : array {
        return $this->stmt->fetchall();

    }

}