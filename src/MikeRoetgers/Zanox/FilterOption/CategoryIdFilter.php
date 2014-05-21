<?php

namespace MikeRoetgers\Zanox\FilterOption;

trait CategoryIdFilter
{
    private $categoryId = array(
        'value' => null,
        'negate' => false
    );

    public function setCategoryId($category, $negate = false)
    {
        $this->categoryId['value'] = $category;
        $this->categoryId['negate'] = $negate;
    }

    public function getCategoryIdXml($ns = 'ns1:')
    {
        if ($this->categoryId['value'] === null) {
            return '';
        }
        return '<' . $ns . 'categoryid negate="' . (int)$this->categoryId['negate'] . '">' . $this->categoryId['value'] . '</' . $ns . 'categoryid>';
    }
}