<?php

class Wpe_Hackday_REST_API
{
    public static function init()
    {
        if (!function_exists('register_rest_route')) {
            return false;
        }

        register_rest_route(
            'wpehack/v1',
            '/test/',
            array(
                'methods' => WP_REST_Server::READABLE,
                'permission_callback' => function () {
                    return true;
                },
                'callback' => array('Wpe_Hackday_REST_API', 'get_a_quote'),
            )
        );
    }

    public static function get_a_quote()
    {
        $quotes = Wpe_Hackday_REST_API::get_quotes();
        $quote  = array_rand($quotes);

        $response = array();
        $response['quote'] = "<p>$quotes[$quote]</p>";

        $result = new WP_REST_Response($response, 200);
        $result->set_headers(array('Cache-Control' => 'no-cache'));

        return $result;
    }

    public static function get_quotes()
    {
        return array(
            'Muesli',
            'I Love Muesli',
            'Why Dont You Love Muesli?',
            'Where is my muesli?',
            'Has anyone seen my muesli?',
            'Can you review this muesli please?',
            'Want to pair on some muesli?',
            'Can anybody get me some muesli?',
        );
    }
}
