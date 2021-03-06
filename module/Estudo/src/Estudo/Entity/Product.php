<?php

namespace Estudo\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $price;
    
    /**
     * @ORM\OneToOne(targetEntity="Estudo\Entity\Brand", cascade={"persist"})
     */
    protected $brand;
    
    /**
     * @ORM\OneToMany(targetEntity="Estudo\Entity\Category", mappedBy="products", cascade={"persist"})
     */
    protected $categories;
    
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }
    
    public function getId($id)
    {
        return $this->id;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }
    
    public function getBrand()
    {
        return $this->brand;
    }
    
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }
    
    public function getCategories()
    {
        return $this->categories;
    }
}
