<?php
class Validations
{
    public static function filterPrice($value): bool
    {
        $state = true;

        if (!empty($value)) {
            $state = false;
        }
        if (!empty($value)) {
            $state = false;
        }
        return $state;
    }
}
