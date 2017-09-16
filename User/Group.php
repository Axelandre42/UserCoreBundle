<?php
namespace Axelandre42\User\CoreBundle\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group
{
	/**
	 * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="array")
	 */
	private $roles;
	
	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $name;
	
	/**
     * @ManyToMany(targetEntity="Group")
     * @JoinTable(name="permissions",
     *      joinColumns={@JoinColumn(name="group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="permission_id", referencedColumnName="id")}
     *      )
     */
	private $permissions;
	
	/**
	 * @ORM\Column(type="text")
	 */
	private $description;

	// ID, getter.
	public function getId()
	{
		return $this->id;
	}
	
	// Group-specific roles, getter.
	public function getRoles()
	{
		return $this->roles;
	}

	// Adds group-specific role, pseudo-setter.
	public function addRole($role)
	{
		array_push($this->roles, $role);
	}

	// Removes group-specific role, pseudo-setter.
	public function removeRole($role)
	{
		if(($key = array_search($role, $this->roles)) !== false) {
			unset($this->roles[$key]);
		}
	}

	// Group-specific permissions, getter.
	public function getPermissions()
	{
		return $this->permissions;
	}

	// Adds group-specific permission, pseudo-setter.
	public function addPermission($permission)
	{
		array_push($this->permissions, $permission);
	}

	// Removes group-specific permission, pseudo-setter.
	public function removePermission($permission)
	{
		if(($key = array_search($permission, $this->permissions)) !== false) {
			unset($this->permissions[$key]);
		}
	}

	// Name, getter.
	public function getName()
	{
		return $this->name;
	}

	// Name, setter.
	public function setName($name)
	{
		$this->name = $name;
	}
	
	// Description, getter.
	public function getDescription()
	{
		return $this->description;
	}

	// Description, setter.
	public function setDescription($description)
	{
		$this->description = $description;
	}
}