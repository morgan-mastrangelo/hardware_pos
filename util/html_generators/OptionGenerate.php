<?php

class OptionGenerate
{
    public static function generate($array, $display, $value)
    {

        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
            $option_value = $array[$i][$value];
            $option_tag = $array[$i][$display];
?>
            <option value="<?php echo $option_value ?>"><?php echo $option_tag ?></option>
<?php
        }
    }
}

?>