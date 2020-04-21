<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: TourForm.php.
 * Date: 24.04.2018
 * Time: 13:18
 */

class TourForm
{
    private $name;
    private $description;
    private $category;
    private $cost;

    function __construct(Array $tour)
    {
        $this->name = isset($tour['name']) ? $tour['name'] : null;
        $this->description = isset($tour['description']) ? $tour['description'] : null;
        $this->category = isset($tour['category']) ? $tour['category'] : null;
        $this->cost = isset($tour['cost']) ? $tour['cost'] : null;
    }

    public function validate()
    {
        return !empty($this->name) && !empty($this->description) && !empty($this->category) && !empty($this->cost);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

}