<?php
/**
 * Created by PhpStorm.
 * User: Ростислав
 * Date: 09.03.2018
 * Time: 19:19
 */

class Router
{
    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $method_prefix;
    protected $language;

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));

        // Get defaults
        $routs = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->method_prefix = isset($routs[$this->route]) ? $routs[$this->route] : '';
        $this->language = Config::get('defaukt_language');
        $this->controller = Config::get('defaukt_controller');
        $this->action = Config::get('defaukt_action');

        $uri_parts = explode('?', $this->uri);
//        print_r("Ok! Router was called with uri: ".$uri);

        // Get path like /lng/controller/action/param1/param2/.../...
        $path = $uri_parts[0];

        $path_parts = explode('/', $path);

//        echo "<pre>"; print_r($path_parts);

        if (count($path_parts))
        {
            // Get route or language at first element
            if (in_array(strtolower(current($path_parts)), array_keys($routs)))
            {
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = isset($routs[$this->route]) ? $routs[$this->route] : '';
                array_shift($path_parts);
            } elseif ( in_array(strtolower(current($path_parts)), Config::get('language')) )
            {
                $this->language = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            // Get controller - next element of array
            if ( current($path_parts) )
            {
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            // Get action - next element of array
            if ( current($path_parts) )
            {
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }

            // Get params - all the rest
            $this->params = $path_parts;
        }
    }
}