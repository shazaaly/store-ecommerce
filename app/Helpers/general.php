<?php

define('PAGINATION_COUNT', 15) ;
function getFolder(){

        if (app()->getLocale() === 'ar')
             return 'css-rtl';
        else
            return 'css';

    }


