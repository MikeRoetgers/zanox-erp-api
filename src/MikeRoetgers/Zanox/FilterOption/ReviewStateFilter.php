<?php

namespace MikeRoetgers\Zanox\FilterOption;

trait ReviewStateFilter
{
    private $reviewState = array(
        'value' => null,
        'negate' => false
    );

    public function setReviewState($state, $negate = false)
    {
        $this->reviewState['value'] = $state;
        $this->reviewState['negate'] = $negate;
    }

    public function getReviewStateXml($ns = 'ns1:')
    {
        if ($this->reviewState['value'] === null) {
            return '';
        }
        return '<' . $ns . 'reviewstate negate="' . (int)$this->reviewState['negate'] . '">' . $this->reviewState['value'] . '</' . $ns . 'reviewstate>';
    }
}