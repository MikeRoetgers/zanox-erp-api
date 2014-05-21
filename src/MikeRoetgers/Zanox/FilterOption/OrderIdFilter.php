<?php

namespace MikeRoetgers\Zanox\FilterOption;

trait OrderIdFilter
{
    private $orderId = array(
        'value' => null,
        'negate' => false
    );

    public function setCategoryId($order, $negate = false)
    {
        $this->orderId['value'] = $order;
        $this->orderId['negate'] = $negate;
    }

    public function getOrderIdXml($ns = 'ns1:')
    {
        if ($this->orderId['value'] === null) {
            return '';
        }
        return '<' . $ns . 'orderid negate="' . (int)$this->orderId['negate'] . '">' . $this->orderId['value'] . '</' . $ns . 'orderid>';
    }
}