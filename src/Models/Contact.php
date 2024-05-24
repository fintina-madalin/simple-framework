<?php

namespace App\Models;

use App\Core\Model;

class Contact extends Model
{
    protected static string $table = 'contacts';
    public int $city_id;

    public  function city()
    {
        return City::find($this->city_id);
    }
}