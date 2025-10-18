<?php namespace App\Libraries;

class Widget
{

    public function recentPost(array $params)
    {
        return view('widgets/recent_post', $params);
    }

}