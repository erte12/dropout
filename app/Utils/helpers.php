<?php

use App\Category;
use App\Subcategory;

/**
 * Returns how many websites contains given category
 * @return int
 */
function websites_number_in_category($category_id)
{
    $websites = Category::findOrFail($category_id)->websites;
    return $websites->count();
}

/**
 * Returns how many websites contains given subcategory
 * @return int
 */
function websites_number_in_subcategory($category_id)
{
    $websites = Subcategory::findOrFail($category_id)->websites;
    return $websites->count();
}
