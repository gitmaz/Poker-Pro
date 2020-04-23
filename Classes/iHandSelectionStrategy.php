<?php

namespace Classes;
/**
 * This is used for decoupling of Player on its dependency on different strategies that is used to choose a set of hands
 * (ex: random  vs known straight set), used typically to test if the system is working properly by passing a known set
 * interface iHandSelectionStrategy
 *
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
interface iHandSelectionStrategy
{
    public function getSample($shouldReturnHigh);
}
