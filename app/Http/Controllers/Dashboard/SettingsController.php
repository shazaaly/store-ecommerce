<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function editShippingsMethods($type)
    {
//        return Setting::all();
        if ($type === 'free')
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();
        elseif ($type === 'inner')
            $shippingMethod = Setting::where('key', 'local_label')->first();

        elseif ($type === 'outer')
            $shippingMethod = Setting::where('key', 'outer_label')->first();

        else
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

//        return $shippingMethod;
              return view('dashboard.settings.shippings.edit', compact('shippingMethod'));
    }


    public function updateShippingsMethods(ShippingsRequest $request, $id){
            return $request;

    }



}
