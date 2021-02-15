<?php
// Create a custom post type
function employees_custom_post_type()
{

  // Set labels for custom post type
  $labels = array(
    'name' => 'Employee',
    'singular_name' => 'Name',
    'salary'    => 'Salary'
  );

  // Set Options for this custom post type
  $args = array(
    'public'          => true,
    'label'           => 'Employee',
    'labels'          => $labels,
    'supports'        => array('title', 'editor'),
    'capability_type' => 'page',
  );

  register_post_type('employee', $args);
}

add_action('init', 'employees_custom_post_type');
// Custom Post Type ends here

// Create Shortcode to Display Employees Post Types
// Should be into your theme’s functions.php
function shortcode_employees_custom_post_type()
{

  $args = array(
    'post_type'       => 'employee',
    'posts_per_page'  => '15',
    'publish_status'  => 'published',
    'order'           => 'ASC',
    'order_by'        => 'meta_value',
    'meta_key'        => 'date_from',
    'meta_query'      => array(
      array(
        'key'         => 'date_from',
        'value'       => date('Ymd'),
        'compare'     => '>='
      ),
    ),
  );

  $query = new WP_Query($args);
  $result = '';

  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

      $result .= '
      <div class="employee-item">
        <div class="employee-name">' . get_the_title() . '</div>
        <div class="employee-salary">' . get_the_content() . '</div>
      </div>
      ';

    endwhile;
    wp_reset_postdata();
  endif;

  return $result;
}

add_shortcode('employees', 'shortcode_employees_custom_post_type'); 
// Shortcode code ends here
