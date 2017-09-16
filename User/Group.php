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
	
	public function getRoles()
	{
		return $this->roles;
	}
	
	public function addRole($role)
	{
		array_push($this->roles, $role);
	}
	
	public function removeRole($role)
	{
		if(($key = array_search($role, $this->roles)) !== false) {
			unset($this->roles[$key]);
		}
	}
	
	public function getPermissions()
	{
		return $this->permissions;
	}
	
	public function addPermission($permission)
	{
		array_push($this->permissions, $permission);
	}
	
	public function removePermission($permission)
	{
		if(($key = array_search($permission, $this->permissions)) !== false) {
			unset($this->permissions[$key]);
		}
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
}