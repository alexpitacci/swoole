<?php
/**
 * @Entity @Table(name="products")
 **/
class Product
{
    /**
     * @var int
     * @Id @Column(type="integer") @GeneratedValue
     */
    public $id;
    /**
     * @var string
     * @Column(type="string")
     */
    public $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}