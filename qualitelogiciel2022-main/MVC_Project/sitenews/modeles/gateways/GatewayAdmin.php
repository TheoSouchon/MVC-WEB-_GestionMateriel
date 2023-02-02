<?php

class GatewayAdmin
{
    private $con;

    /**
     * __construct
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * CheckVerifCompte
     * @param string $login
     * @param string $mdp
     * @return int
     */
    public function CheckVerifCompte(string $login, string $mdp) {
        $mdpHash = password_hash("paul1234", PASSWORD_BCRYPT );
        echo$mdpHash;
        $query = "SELECT pwd FROM users WHERE Email=:login";
        $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR)));
        $res = $this->con->getResults();
        foreach ($res as $row) {
            //mdp2 : mot de passe de "Email" dans la bdd
            $mdp2 = $row['pwd'];
        }
        if(isset($mdp2)) {
            if(password_verify($mdp,$mdp2)){
                return 1;
            }
        }
        else return 0;
    }

    /**
     * addUser
     * @param mixed $firstName
     * @param mixed $lastName
     * @param mixed $email
     * @param mixed $role
     * @param mixed $passwordHashed
     * @return void
     */
    public function addUser($firstName, $lastName, $email, $role, $passwordHashed) {
        $request = "insert into users (Lastname, Firstname, Email, Role, pwd) values (:ln, :fn, :mail, :role, :pass);";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            "ln" => $lastName,
            "fn" => $firstName,
            "mail" => $email,
            "role" => $role,
            "pass" => $passwordHashed
        ]);
    }

    /**
     * addItem
     * @param mixed $name
     * @param mixed $version
     * @param mixed $reference
     * @param mixed $type
     * @param mixed $brand
     * @param mixed $picture
     * @param mixed $phoneNumber
     * @return void
     */
    public function addItem($name, $version, $reference, $type, $brand, $picture, $phoneNumber) {
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
     * Summary of getAllUsers
     * @return array
     */
    public function getAllUsers(): array {
        $request = "select * from users;";
        $prepared = $this->con->prepare($request);
        $prepared->execute();

        $results = $prepared->fetchAll();

        return $results;
    }

    /**
     * Summary of getUserFromId
     * @param mixed $id
     * @return array
     */
    public function getUserFromId($id) : array {
        $request = "select * from users where Email = :id;";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            "id" => $id
        ]);

        return $prepared->fetchAll();
    }

    /**
     * Summary of changeUserFromId
     * @param mixed $id
     * @param mixed $lastName
     * @param mixed $firstName
     * @param mixed $mail
     * @param mixed $role
     * @return void
     */
    public function changeUserFromId($id, $lastName, $firstName, $mail, $role) : void {
        $request = "update users set 
                 Lastname = :ln, 
                 Firstname = :fn, 
                 Email = :email, 
                 Role = :role,
                 pwd = :pass
                 where Email = :id;";
        $prepared = $this->con->prepare($request);
        $prepared->execute([
            "ln" => $lastName,
            "fn" => $firstName,
            "email" => $mail,
            "role" => $role,
            "id" => $id
        ]);




    }

}