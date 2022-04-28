<?php
namespace App\Repositories\MobileSettings\phones;

trait Accessor
{

    public function getEncryptedIdAttribute()
    {

        return encryptGdprData($this->id);
    }
}
