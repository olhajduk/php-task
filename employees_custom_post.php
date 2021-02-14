<?php

add_action('init', 'employees_custom_taxonomy', 0);

function employees_custom_taxonomy()
{

  $labels = array(
    'name'                => _x('Types', 'taxonomy general name'),
    'singular_name'       => _x('Type', 'taxonomy singular name'),
    'search_items'        => __('Search Types'),
    'all_items'           => __('All Types'),
    'parent_item'         => __('Parent Type'),
    'parent_item_colon'   => __('Parent Type:'),
    'edit_item'           => __('Edit Type'),
    'update_item'         => __('Update Type'),
    'add_new_item'        => __('Add New Type'),
    'new_item_name'       => __('New Type Name'),
    'menu_name'           => __('Types'),
  );

  register_taxonomy('types', array('deals'), array(
    'hierarchical'        => false,
    'labels'              => $labels,
    'show_ui'             => true,
    'show_admin_column'   => true,
    'query_var'           => true,
    'rewrite'             => array('slug' => 'type'),
  ));
}


function employees_custom_post_type()
{

  $labels = array(
    'name'                => __('Employees'),
    'singular_name'       => __('Name'),
    'salary'              => __('Salary')
  );

  $args = array(
    'label'               => $labels['name'],
    'labels'              => $labels,
    'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
    'public'              => false,
    'hierarchical'        => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'has_archive'         => true,
    'can_export'          => true,
    'exclude_from_search' => true,
    'taxonomies'          => array('post_tag'),
    'publicly_queryable'  => false,
    'capability_type'     => 'page'
  );

  register_post_type('employees', $args);
}

add_action('init', 'employees_custom_post_type', 0);
