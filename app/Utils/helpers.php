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
