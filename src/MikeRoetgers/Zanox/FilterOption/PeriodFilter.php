<?php

namespace MikeRoetgers\Zanox\FilterOption;

trait PeriodFilter
{
    private $period = array(
        'from' => null,
        'to' => null
    );

    public function setPeriod($from, $to)
    {
        $this->period['from'] = $from;
        $this->period['to'] = $to;
    }

    public function getPeriodFilterXml($ns = 'ns1:')
    {
        if ($this->period['from'] === null || $this->period['to'] === null) {
            return '';
        }
        return '<' . $ns . 'period from="' . $this->period['from'] . '" to="' . $this->period['to'] . '" />';
    }
}