<?php

/**
 * Returns true if authenticated is admin, false otherwise.
 * @return bool
 */
function superuser()
{
    return auth()->user()->role_id === 1;
}
