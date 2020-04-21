<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: CategoryForm.php.
 * Date: 24.04.2018
 * Time: 13:18
 */

class CategoryForm
{

    private $namecategory;
    private $description;

    function __construct(Array $category)
    {
        $this->namecategory = isset($category['namecategory']) ? $category['namecategory'] : null;
        $this->description = isset($category['description']) ? $category['description'] : null;
    }

    public function validate()
    {
        return !empty($this->namecategory) && !empty($this->description);
    }

    /**
     * @return mixed
     */
    public function getNamecategory()
    {
        return $this->namecategory;
    }

    /**
     * @param mixed $namecategory
     */
    public function setNamecategory($namecategory)
    {
        $this->namecategory = $namecategory;
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


}