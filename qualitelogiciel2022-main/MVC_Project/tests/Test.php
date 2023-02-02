<?php
require './vendor/autoload.php';
use PHPUnit\Framework\TestCase;
require 'sitenews\modeles\modeles\ModelMateriel.php';
require 'sitenews\config\Connection.php';
require 'sitenews\modeles\gateways\GatewayAdmin.php';
require 'sitenews\modeles\gateways\GatewayMateriel.php';
class testCreationMateriel extends TestCase  
{

    public function testExistenceCompte() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $gtwAdmin = new GatewayAdmin($con);
        $result=$gtwAdmin->CheckVerifCompte("theo.souchon@gmail.com","theo1234");
        $this->assertEquals(1,$result);
    }

    public function testAccesDetailMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $gtwMateriel = new GatewayMateriel($con);
        $result=$gtwMateriel->getDetailMateriel("CLAV52");
        $resultNom=$result[0]["Name"];
        $this->assertEquals("Blackwidow",$resultNom);
    }

    public function testAccesDetailUser() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $gtwAdmin = new GatewayAdmin($con);
        $result=$gtwAdmin->getUserFromId("theo.souchon@gmail.com");
        $resultNom=$result[0]["Firstname"];
        $this->assertEquals("Theo",$resultNom);
    }

    public function testCaracSpeciauxNomMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTYUIOPQSDFGHJK_","azvcer","QQCHOSE","ADIDAS","MANETTE","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testNomVideMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("","azvcer","QQCHOSE","ADIDAS","MANETTE","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testNom30CaracMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTYUIOPQSDFGHJKLMWXCVBNAZE","azvcer","QQCHOSE","ADIDAS","MANETTE","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testNomPlus30CaracMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTYUIOPQSDFGHJKLMWXCVBNAZEAA","azvcer","QQCHOSE","ADIDAS","MANETTE","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testTypeCaractMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","ADIDAS","MANETTE_","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testTypeVideMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","ADIDAS","","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testType30CaracMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","ADIDAS","AZERTYUIOPQSDFGHJKLMWXCVBNAZE","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testType1CaracMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","ADIDAS","A","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testTypePlusDe30CaracMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","ADIDAS","AZERTYUIOPQSDFGHJKLMWXCVBNAZEAB","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testMarqueTypeCaracMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","ADIDAS_","AZERTY","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testMarqueVideMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","","AZERTY","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testMarque30CaractMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testMarque1CaractMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","A","AZERTY","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testMarquePlusDe30CaracMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEAb","AZERTY","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testVersionTypeCractMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","azvcer_","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testVersionVideMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testVersion30CaractMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEAb","AZERTY","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testVersion3CaractMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","AZR","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testVersionPlusDe15CaractMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","AZERTYUIOPQSDFGHJKLM","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","0606060606");
        $this->assertEquals(false,$result);
    }

    public function testNumeroVideMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","AZERTYUIOPQSDF","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","");
        $this->assertEquals(false,$result);
    }

    public function testNumero10CractVideMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","AZERTYUIOPQSDF","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","0606060606");
        $this->assertEquals(true,$result);
    }

    public function testNumeroPlus10CractVideMateriel() {
        $user= 'root';
        $pass='';
        $dsn='mysql:host=localhost;dbname=locamat;charset=utf8';
        $con=new Connection($dsn,$user,$pass);
        $MdlMateriel = new modelMateriel($con);
        $result=$MdlMateriel->checkCreationMateriel("AZERTY","AZERTYUIOPQSDF","QQCHOSE","AZERTYUIOPQSDFGHJKLMWXCVBNAZEA","AZERTY","060606060678");
        $this->assertEquals(false,$result);
    }
}