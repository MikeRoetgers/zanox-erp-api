<?php

namespace MikeRoetgers\Zanox\ExportFilter;

use MikeRoetgers\Zanox\FilterOption\CategoryIdFilter;
use MikeRoetgers\Zanox\FilterOption\OrderIdFilter;
use MikeRoetgers\Zanox\FilterOption\PeriodFilter;
use MikeRoetgers\Zanox\FilterOption\ReviewStateFilter;

class BasketFilter
{
    use PeriodFilter, ReviewStateFilter, CategoryIdFilter, OrderIdFilter;

    /**
     * @param string $from
     * @param string $to
     */
    public function __construct($from, $to)
    {
        $this->setPeriod($from, $to);
    }

    /**
     * @param string $ns
     * @return string
     */
    public function toSoapParam($ns = 'ns1:')
    {
        $xml = '<' . $ns . 'basketfilter>';
        $xml .= $this->getPeriodFilterXml($ns);
        $xml .= $this->getCategoryIdXml($ns);
        $xml .= $this->getReviewStateXml($ns);
        $xml .= $this->getOrderIdXml($ns);
        $xml .= '</' . $ns . 'basketfilter>';
        return new \SoapVar($xml, XSD_ANYXML);
    }
}