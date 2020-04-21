<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: CartForm.php.
 * Date: 24.04.2018
 * Time: 13:19
 */

class CartForm
{
    private $user;
    private $tour;
    private $count;

    function __construct(Array $cart)
    {
        $this->user = isset($cart['user']) ? $cart['user'] : null;
        $this->tour = isset($cart['tour']) ? $cart['tour'] : null;
        $this->count = isset($cart['count']) ? $cart['count'] : null;
    }

    public function validate()
    {
        return !empty($this->user) && !empty($this->tour) && !empty($this->count);
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * @param mixed $tour
     */
    public function setTour($tour)
    {
        $this->tour = $tour;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }


}