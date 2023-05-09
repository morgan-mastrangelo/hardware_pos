<?php

class LinkGenerator
{
    static $root;
    private static function loadRoot()
    {
        self::$root  = $_SERVER["DOCUMENT_ROOT"];
    }
    private static function loadPaths($which_one)
    {
        $file = "";
        if ($which_one == "file_paths") {
            $file = self::$root . "/hardware_pos_system/util/path_config/file_paths.json";
        }

        if ($which_one == "directory_paths") {
            $file = self::$root . "/hardware_pos_system/util/path_config/directory_paths.json";
        }
        return $file;
    }
    public static function getFilePath($path_name) 
    {

        $generated_path = "";
        if (self::$root == null) {
            self::loadRoot();
        }
        $json_file = self::loadPaths("file_paths");
        $unparsed_json_file = file_get_contents($json_file);
        $object = json_decode($unparsed_json_file);
        foreach ($object->paths as $key => $value) {
            if ($value->path_name == $path_name) {
                $generated_path = $value->actual_path;
                break;
            }
        }
        return $_SERVER['DOCUMENT_ROOT'] .$generated_path;
    }
    public static function getRelativePath($path_name)
    {
        $generated_path = "";
        if (self::$root == null) {
            self::loadRoot();
        }
        $json_file = self::loadPaths("file_paths");
        $unparsed_json_file = file_get_contents($json_file);
        $object = json_decode($unparsed_json_file);
        foreach ($object->paths as $key => $value) {
            if ($value->path_name == $path_name) {
                $generated_path = $value->actual_path;
                break;
            }
        }
        return $generated_path;
    }
    public static function getDirectoryPath($directory_name)
    {
        $generated_path = "";
        if (self::$root == null) {
            self::loadRoot();
        }
        $json_file = self::loadPaths("file_paths");
        $unparsed_json_file = file_get_contents($json_file);
        $object = json_decode($unparsed_json_file);
        foreach ($object->paths as $key => $value) {
            if ($value->path_name == $directory_name) {
                $generated_path = $value->actual_path;
                break;
            }
        }
        require_once $generated_path;
    }
}
require_once LinkGenerator::getFilePath("db");
