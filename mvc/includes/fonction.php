<?php
function cleanString(string $value)
{
    return trim(htmlspecialchars($value, ENT_QUOTES));
}