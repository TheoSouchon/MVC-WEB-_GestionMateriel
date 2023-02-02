<?php

class GatewayMateriel
{
    private $con;

    /**
     * Summary of __construct
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * Summary of getListMateriel
     * @return array
     */
    public function getListMateriel() {
        $request = "select * from items;";
        $prepared = $this->con->prepare($request);
        $prepared->execute();

        $results = $prepared->fetchAll();
        return $results;
    }

    /**
     * Summary of getDetailMateriel
     * @param mixed $id
     * @return array
     */
    public function getDetailMateriel($id) : array {
        $request = "select * from items where Reference = :id;";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            'id' => $id
        ]);
        $results = $prepared->fetchAll();
        return $results;
    }

    /**
     * Summary of getBorrowInfo
     * @param string $id
     * @return bool
     */
    public function getBorrowInfo(string $id) : bool {
        $request = "select Reference from borrowing where DeliveryDate > CURDATE() and Reference = :id;";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            'id' => $id
        ]);

        $results = $prepared->fetchAll();
        if (count($results) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Summary of getPCItems
     * @param PDO $db
     * @return array
     */
    function getPCItems(PDO $db) : array {
        $request = "select * from items where type='PC';";
        $prepared = $db->prepare($request);
        $prepared->execute();
    
        $results = $prepared->fetchAll();
        return $results;
    }
    
    /**
     * Summary of getTabletItems
     * @param PDO $db
     * @return array
     */
    function getTabletItems(PDO $db) : array {
        $request = "select * from items where type = 'Tablette';";
        $prepared = $db->prepare($request);
        $prepared->execute();
    
        $results = $prepared->fetchAll();
        return $results;
    }
    
    /**
     * Summary of getPhoneItems
     * @param PDO $db
     * @return array
     */
    function getPhoneItems(PDO $db) : array {
        $request = "select * from items where type = 'Telephone';";
        $prepared = $db->prepare($request);
        $prepared->execute();
    
        $results = $prepared->fetchAll();
        return $results;
    }

    /**
     * Summary of deleteItemFromId
     * @param mixed $id
     * @return void
     */
    function deleteItemFromId($id) : void {
        $request = "delete from items where Reference = :id;";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            'id' => $id
        ]);
    }

    /**
     * Summary of changeItemFromId
     * @param mixed $id
     * @param mixed $name
     * @param mixed $version
     * @param mixed $reference
     * @param mixed $type
     * @param mixed $brand
     * @param mixed $picture
     * @param mixed $phoneNumber
     * @return void
     */
    function changeItemFromId($id, $name, $version, $reference, $type, $brand, $picture, $phoneNumber) {
        $request = "update items set 
                 Name = :name, 
                 Version = :version, 
                 Reference = :reference,
                 Type = :type,
                 Brand = :brand, 
                 Picture = :picture, 
                 PhoneNumber = :phoneNumber 
                 where Reference = :id";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            "name" => $name,
            "version" => $version,
            "reference" => $reference,
            "type" => $type,
            "brand" => $brand,
            "picture" => $picture,
            "phoneNumber" => $phoneNumber,
            "id" => $id
        ]);
    }

    /**
     * Summary of addItem
     * @param mixed $name
     * @param mixed $version
     * @param mixed $reference
     * @param mixed $type
     * @param mixed $brand
     * @param mixed $picture
     * @param mixed $phoneNumber
     * @return void
     */
    function addItem($name, $version, $reference, $type, $brand, $picture, $phoneNumber) {
        
        $request = "insert into items (Name, Version, Reference, Type, Brand, Picture, PhoneNumber)
                    values (:name, :version, :ref, :type, :brand, :picture, :phone);";

        $prepared = $this->con->prepare($request);
        $prepared->execute([
            "name" => $name,
            "version" => $version,
            "ref" => $reference,
            "type" => $type,
            "brand" => $brand,
            "picture" => $picture,
            "phone" => $phoneNumber
        ]);
    }

    /**
     * Summary of itemExists
     * @param mixed $id
     * @return bool
     */
    function itemExists($id): bool {
        $request = "select * from items where Reference = :id;";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            "id" => $id
        ]);

        $res = $prepared->fetchAll();

        if (count($res) == 0) {
            return false;
        }
        return true;
    }

    /**
     * Summary of borrowingHistoryUser
     * @param mixed $id
     * @param mixed $reference
     * @return array
     */
    function borrowingHistoryUser($id, $reference) : array {
        $request = "select BorrowingDate, DeliveryDate from borrowing where Reference = :ref and email = :mail order by (BorrowingDate);";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            "ref" => $reference,
            "mail" => $id
        ]);

        $res = $prepared->fetchAll();
        return $res;
    }
}