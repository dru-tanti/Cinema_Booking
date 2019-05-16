<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Before creating new functions, always check if they already exist.
if(!function_exists('build_nav'))
{
    function build_nav($items = NULL)
    {
        // If no items exist, stop the code here.
        if ($items === NULL) return '';

        // Start with a blank string.
        $result = '';

        foreach ($items as $item)
        {
            // Creates a dropdown menu if a submenu is found
            if (array_key_exists('submenu', $item))
            {
                $result .= '<li class="nav-item dropright">';
                $result .= '<a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $result .= '<i class="icon '. $item['icon'] .'"></i>';
                $result .= '<span>' . $item['title'] . '</span>';
                $result .= '</a>';
                $result .= '<div class="dropdown-menu">';
                $result .= '<ul class="nav">';
                $result .= build_nav($item['submenu']);
                $result .= '</ul>';
                $result .= '</div>';
                $result .= '</li>';
            }
            else // Otherwise it creates a regular link
            {
                $result .= '<li class="nav-item">';
                $result .= '<a href="' . site_url($item['url']) . '" class="nav-link">';
                $result .= '<i class="icon ' . $item['icon'] . '"></i>';
                $result .= '<span>' . $item['title']. '</span>';
                $result .= '</a>';
                $result .= '</li>';
            }
        }

        // Give back the compiled string.
        return $result;
    }
}
