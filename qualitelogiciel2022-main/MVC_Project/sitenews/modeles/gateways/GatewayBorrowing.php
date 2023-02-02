<?php

class GatewayBorrowing
{
    private $conn;
        /**
         * Summary of __construct
         * @param Connection $connection
         */
        function __construct(Connection $connection) {
            $this->conn = $connection;
        }

        /**
         * Summary of borrowing
         * @param mixed $reference
         * @param mixed $mail
         * @param mixed $borrowingDate
         * @param mixed $deliveryDate
         * @return void
         */
        public function borrowing($reference, $mail, $borrowingDate, $deliveryDate) {
            $request = "insert into borrowing (Reference, Email, BorrowingDate, DeliveryDate)
                    values (:ref, :mail, :bd, :dd);";

            $prepared = $this->conn->prepare($request);
            $prepared->execute([
                'ref' => $reference,
                'mail' => $mail,
                'bd' => $borrowingDate,
                'dd' => $deliveryDate
            ]);


        }
}