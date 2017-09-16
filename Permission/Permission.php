<?php
namespace Axelandre42\User\CoreBundle\Permission;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="permissions")
 */
class Permission
{
	/**
	 * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $name;
	
	/**
	 * @ORM\Column(type="text")
	 */
	private $description;

	// ID, getter.
	public function getId()
	{
		return $this->id;
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