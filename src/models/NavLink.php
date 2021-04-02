<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="nav_links")
 */
class NavLink
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** 
     * @ORM\Column(type="string")
     */
    private $linkName;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of linkName
     */
    public function getLinkName()
    {
        return $this->linkName;
    }

    /**
     * Set the value of linkName
     *
     * @return  self
     */
    public function setLinkName($linkName)
    {
        $this->linkName = $linkName;

        return $this;
    }
}
