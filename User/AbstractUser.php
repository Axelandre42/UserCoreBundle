<?php
namespace Axelandre42\User\CoreBundle\User;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractUser implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    protected $email;

	/**
	 * @ORM\Column(type="array")
	 */
	protected $roles;

	/**
     * @ManyToMany(targetEntity="Group")
     * @JoinTable(name="users_groups",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     */
    protected $groups;
	
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    public function __construct()
    {
        $this->isActive = true;
		$this->groups = new ArrayCollection();
    }

	// Username, getter.
    public function getUsername()
    {
        return $this->username;
    }

	
	// Password, getter.
    public function getPassword()
    {
        return $this->password;
    }

	// User-specific roles, getter.
	public function getUserRoles()
    {
		return $this->roles;
    }

	
	// All roles inherited from groups, getter.
	public function getGroupsRoles()
    {
		$array = $this->groups->toArray();
		$roles = array();
		
		foreach ($array as $value)
		{
			$roles = array_merge($roles, $value->getRoles());
		}
		
		return $roles;
    }

	// All roles including groups roles and user roles, getter.
    public function getRoles()
    {
		return array_merge($this->getUserRoles(), $this->getGroupsRoles());
    }

	// Adds user-specific role, pseudo-setter.
	public function addRole($role)
	{
		array_push($this->roles, $role);
	}

	// Removes user-specific role, pseudo-setter.
	public function removeRole($role)
	{
		if(($key = array_search($role, $this->roles)) !== false) {
			unset($this->roles[$key]);
		}
	}

	// Groups, getter.
	public function getGroups()
    {
        return $this->groups;
    }

	// Salt (unused), getter.
	public function getSalt()
	{
		return null;
	}

	// Erase password.
    public function eraseCredentials()
    {
		$this->password = "";
    }

	// Serialize.
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->roles
        ));
    }

	// Unserialize.
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->roles
        ) = unserialize($serialized);
    }
}