<?php

namespace Pw\Auth;

use Pw\Auth\Identity\IdentityManager;


// todo: password_hash

class Authenticate
{
    protected $authenticator;
    protected $identityManager;

    /**
     * Authenticate constructor.
     * @param AuthenticatorInterface $authenticator
     * @param IdentityManager $identityManager
     */
    public function __construct(AuthenticatorInterface $authenticator, IdentityManager $identityManager)
    {
        $this->authenticator = $authenticator;
        $this->identityManager = $identityManager;
    }



    public function clear()
    {
        $this->authenticator->clear();
    }


    public function authenticate($identity, $credential)
    {
        $user = $this->authenticator->authenticate($identity, $credential);

        if (!$user) {
            return false;
        }
        $this->identityManager->setIdentity($identity);
        if (isset($user['id']) ){
            $this->identityManager->setId($user['id']);
        }
        return true;
    }


    public function existIdentity($identity)
    {
        return $this->authenticator->existIdentity($identity);
    }


}
