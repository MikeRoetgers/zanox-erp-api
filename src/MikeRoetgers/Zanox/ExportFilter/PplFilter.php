<?php

namespace MikeRoetgers\Zanox\ExportFilter;

use MikeRoetgers\Zanox\FilterOption\CategoryIdFilter;
use MikeRoetgers\Zanox\FilterOption\PeriodFilter;
use MikeRoetgers\Zanox\FilterOption\ReviewStateFilter;

class PplFilter
{
    use PeriodFilter, ReviewStateFilter, CategoryIdFilter;

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
        $xml = '<' . $ns . 'pplfilter>';
        $xml .= $this->getPeriodFilterXml($ns);
        $xml .= $this->getCategoryIdXml($ns);
        $xml .= $this->getReviewStateXml($ns);
        $xml .= '</' . $ns . 'pplfilter>';
        return new \SoapVar($xml, XSD_ANYXML);
    }
}