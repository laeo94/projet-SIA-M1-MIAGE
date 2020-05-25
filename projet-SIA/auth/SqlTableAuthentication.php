<?php

namespace Pw\Auth\Providers;

use Pw\Auth\AuthenticatorInterface;


class SqlTableAuthentication implements AuthenticatorInterface
{

    private $db;
    private $table;
    private $id;
    private $nickname;
    private $password;
    private $email;
    private $originCountry;
    private $date;
    private $firstName;
    private $lastName;
    private $gender;
    private $profession;
    private $address;
    private $interests;
    private $nbMsg;
    private $role;
    //todo: add arbitrary password decode function

    public function __construct(\PDO $db, array $args = [])
    {
        $this->db = $db;
        $this->table = $args['table'] ?? 'abonne';
        $this->id = $args['id'] ?? 'id_abonne';
        $this->nickname = $args['nickname'] ?? 'pseudo';
        $this->password = $args['password'] ?? 'mdp';
        $this->email = $args['email'] ?? 'email';
        $this->originCountry = $args['originCountry'] ?? 'pays_origine';
        $this->date = $args['date'] ?? 'date_enreg';
        $this->firstName = $args['firstName'] ?? 'prenom';
        $this->lastName = $args['lastName'] ?? 'nom';
        $this->gender = $args['gender'] ?? 'sexe';
        $this->profession = $args['profession'] ?? 'profession';
        $this->address = $args['address'] ?? 'adresse';
        $this->interests = $args['interests'] ?? 'centre_interet';
        $this->nbMsg = $args['nbMsg'] ?? 'nb_msg';
        $this->role = "invite";
    }

    public function existIdentity($identity)
    {
        $SQL = "SELECT * FROM $this->table WHERE $this->nickname=?";
        $stmt = $this->db->prepare($SQL);
        if (!$stmt->execute([$identity])) return false;
        return $stmt->fetch();
    }

    public function authenticate($identity, $credential)
    {
        $SQL = "SELECT * FROM $this->table WHERE $this->nickname=?";
        $stmt = $this->db->prepare($SQL);
        if (!$stmt->execute([$identity])) return false;

        $row = $stmt->fetch();
        if (!$row) {
            return false;
        }

        $password = $row[$this->password];
        
        if(strcmp($password, $credential) != 0)
        {
            return false;
        }
        /*
        if (!password_verify($credential, $password)) {
            return false;
        }
        */
        if (isset ($row[$this->id])){
            $res['id_abonne'] = $row[$this->id];
        }

        if(!isset($res)){
            return true;
        }

//      Return roles array or true if it does not exist.
        return $res;
    }


    /**
     * Logout

     *
     */
    public function clear()
    {
        // There is nothing to do for the logout.
    }
}