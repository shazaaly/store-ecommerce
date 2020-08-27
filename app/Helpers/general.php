<?php

    function getFolder(){

        if (app()->getLocale() === 'ar')
             return 'css-rtl';
        else
            return 'css';

    }
