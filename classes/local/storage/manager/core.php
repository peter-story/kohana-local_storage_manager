<?php defined('SYSPATH') or die('No direct script access.');

class Local_Storage_Manager_Core {
    const KEY = 'local_storage_manager';

    static protected $cookie = array();

    protected static function get_delete_key() {
        return Local_Storage_Manager::KEY.'_delete';
    }

    static function delete($key) {
        if (is_string($key)) {
            $key           = array($key);
        }

        $delete_key        = Local_Storage_Manager::get_delete_key();

        $all_deletes       = json_decode(Cookie::get($delete_key), TRUE);

        foreach ($key as $k) {
            $all_deletes[$k] = $k;
        }

        // have to handle like this or will only retain final cookie set attempt
        Local_Storage_Manager::$cookie      = array_merge(Local_Storage_Manager::$cookie, $all_deletes);

        Cookie::set($delete_key, json_encode(Local_Storage_Manager::$cookie));
    }
}