<?php

namespace SimpleStaffList;

class Taxonomy
{
    /** @var string */
    protected $name;

    /**
     * @param string $name
     * @param array  $args
     */
    public function __construct($name, $args)
    {
        $this->name = sanitize_key($name);

        // TODO handle WP_Error
        register_taxonomy($this->name, [], $args);
    }

    /**
     * @param string $object_type
     */
    public function registerFor($object_type)
    {
        // TODO handle false
        register_taxonomy_for_object_type($this->name, $object_type);
    }

    public function unregister()
    {
        // TODO handle WP_Error
        unregister_taxonomy($this->name);
    }

    /**
     * @param string $object_type
     */
    public function unregisterFor($object_type)
    {
        // TODO handle false
        unregister_taxonomy_for_object_type($this->name, $object_type);
    }
}
