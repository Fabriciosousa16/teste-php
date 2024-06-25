<?php

namespace App\Models;

class UserColor
{
    private $user_id;
    private $color_id = [];

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getColorId()
    {
        return $this->color_id;
    }

    public function setColorId($color_id)
    {
        $this->color_id = $color_id;
    }
}
