<?php

class Functions
{
    //get active page
    public function activePage($current_page) {
        //request url
        $url_array = explode('/', $_SERVER['REQUEST_URI']);
        $url =  end($url_array);

        //check if current page equals $url and display active class in <li> tag
        if($current_page == $url) {
            echo 'active'; //class name in css
        }
    }


    //redirect to a page
    public function redirect($url) {
        ob_start();

        //redirect to
        header('Location: '.$url);

        ob_end_flush();

        exit();
    }
}