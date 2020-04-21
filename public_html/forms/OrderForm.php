<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: OrderForm.php.
 * Date: 24.04.2018
 * Time: 13:19
 */

class OrderForm
{
    public $cart;
    public $date;

    function __construct(Array $order)
    {
        $this->cart = isset($order['cart']) ? $order['cart'] : null;
        $this->date = isset($order['date']) ? $order['date'] : null;
    }

    public function validate()
    {
        return !empty($this->cart) && !empty($this->date);
    }

    /**
     * @return mixed
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param mixed $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

}