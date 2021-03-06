<?php

namespace SimpleStaffList\Taxonomies;

use SimpleStaffList\Taxonomy;

class Group extends Taxonomy
{
    public function __construct()
    {
        $labels = [
            'add_new_item'      => __('Add New Group'),
            'all_items'         => __('All Groups'),
            'edit_item'         => __('Edit Group'),
            'name'              => _x('Groups', 'taxonomy general name'),
            'new_item_name'     => __('New Group Name'),
            'not_found'         => __('No groups found.'),
            'parent_item'       => __('Parent Group'),
            'parent_item_colon' => __('Parent Group:'),
            'search_items'      => __('Search Groups'),
            'singular_name'     => _x('Group', 'taxonomy singular name'),
            'update_item'       => __('Update Group'),
            'view_item'         => __('View Group')
        ];

        parent::__construct('staff-member-group', [
            'hierarchical' => true,
            'labels'       => $labels
        ]);
    }

    /**
     * @param array $messages
     */
    public function termUpdatedMessages($messages)
    {
        $messages[$this->taxonomy] = [
            1 => __('Group added.'),
            2 => __('Group deleted.'),
            3 => __('Group updated.'),
            4 => __('Group not added.'),
            5 => __('Group not updated.'),
            6 => __('Groups deleted.')
        ];

        return $messages;
    }
}
