<?php

trait StringPad
{
    protected function pad($string, $length = 4, $padString = ' ', $strPAD = STR_PAD_LEFT)
    {
        return str_pad($string, $length, $padString, $strPAD);
    }
}