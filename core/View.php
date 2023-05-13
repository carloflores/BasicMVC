<?php
class View
{
    protected static $sections = [];
    protected static $yield = null;

    public static function render($view, $data = [], $layout = 'layout')
    {
        // Extract the data to make it available as variables in the view
        extract($data);

        // Start output buffering
        ob_start();

        // Include the view file
        include  "../app/views/{$view}.php";

        // Get the contents of the buffer
        self::$yield = ob_get_clean();

        // Include the layout file
        include  "../app/views/layout/{$layout}.php";
    }

    public static function section($name)
    {
        if (ob_start())
            self::$sections[$name] = '';
    }

    public static function endsection()
    {
        end(self::$sections);
        self::$sections[key(self::$sections)] = ob_get_clean();
    }

    public static function yield ($section = 'default')
    {
        echo $section === 'default' ? self::$yield : self::$sections[$section];
    }
}