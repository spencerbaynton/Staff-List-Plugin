<?php

namespace SimpleStaffList;

class Taxonomy
{
    /** @var string */
    protected $taxonomy;

    /**
     * @param string $taxonomy
     * @param array  $args
     */
    public function __construct($taxonomy, $args)
    {
        $this->taxonomy = sanitize_key($taxonomy);

        // TODO handle WP_Error
        register_taxonomy($this->taxonomy, [], $args);
    }

    /**
     * @param string $object_type
     */
    public function registerFor($object_type)
    {
        // TODO handle false
        register_taxonomy_for_object_type($this->taxonomy, $object_type);
    }

    public function unregister()
    {
        // TODO handle WP_Error
        unregister_taxonomy($this->taxonomy);
    }

    /**
     * @param string $object_type
     */
    public function unregisterFor($object_type)
    {
        // TODO handle false
        unregister_taxonomy_for_object_type($this->taxonomy, $object_type);
    }
}
