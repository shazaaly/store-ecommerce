<?php

define('PAGINATION_COUNT', 15);
function getFolder()
{

    if (app()->getLocale() === 'ar')
        return 'css-rtl';
    else
        return 'css';

}

//    Method to upload image: uploadImage://
function uploadImage($folder, $image)
{
    $image->store('/', $folder);
   return $filename = $image->hashName();

}


