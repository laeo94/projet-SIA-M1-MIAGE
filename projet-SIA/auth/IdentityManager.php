<?php
/**
 * Created by PhpStorm.
 * User: ver
 * Date: 02/02/2017
 * Time: 17:55
 */

namespace Pw\Auth\Identity;


//use ArrayAccess;
//use RuntimeException;

class IdentityManager implements \ArrayAccess
{

//    const GUEST = "guest";
    protected $storage;

    const IDKEY = "identity";

    /**
     * Authenticate constructor.
     * @param null $storage
     */
    public function __construct(&$storage = null)
    {

        if (is_array($storage)) {
            $this->storage = &$storage;
        } elseif ($storage instanceof ArrayAccess) {
            $this->storage = $storage;
        } else {
            if (!isset($_SESSION)) {
                throw new RuntimeException('Authentication failed. Session not found.');
            }
            $this->storage = &$_SESSION;
        }
    }


    public function hasIdentity()
    {
        return isset($this->storage[self::IDKEY]) && isset($this->storage[self::IDKEY]['identity']);
    }

    public function getIdentity()
    {
        if (!$this->hasIdentity()) {
            return null;
        }
        return $this->storage[self::IDKEY]['identity'];
    }

    public function setIdentity($identity)
    {
        $this->storage[self::IDKEY]['identity'] = $identity;
    }

    public function clear()
    {
        unset($this->storage[self::IDKEY]);
    }

    public function hasrole()
    {
        return $this->hasIdentity() && isset($this->storage[self::IDKEY]['role']);
    }

    public function getrole()
    {
        if (!$this->hasId()) {
            return null;
        }
        return $this->storage[self::IDKEY]['role'];
    }

    public function setrole($role)
    {
        $this->storage[self::IDKEY]['role'] = $role;
    }
    public function hasId()
    {
        return $this->hasIdentity() && isset($this->storage[self::IDKEY]['id']);
    }

    public function getId()
    {
        if (!$this->hasId()) {
            return null;
        }
        return $this->storage[self::IDKEY]['id'];
    }

    public function setId($id)
    {
        $this->storage[self::IDKEY]['id'] = $id;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->storage[self::IDKEY][$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->storage[self::IDKEY][$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        // forbid if $offset in [identity,uid,roles]?
        $this->storage[self::IDKEY][$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        // forbid if $offset in [identity,uid,roles]?
        unset($this->storage[self::IDKEY][$offset]);
    }
}