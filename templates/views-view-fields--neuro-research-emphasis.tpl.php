<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
//dpm($row);
global $user;
$node = node_load($row->nid);
if (node_access("update", $node, $user) === TRUE) {
  $node_acces = TRUE;
}
else {
  $node_acces = FALSE;
}
$node_path = drupal_lookup_path('alias','node/'.$row->nid);
?>
<?php
switch ($row->node_type) {
  case 'stanford_event':
    $output = '<div class="masonry-event">';
    if (isset($row->field_field_stanford_event_image[0])) {
      $output .= '<div>' . drupal_render($row->field_field_stanford_event_image[0]['rendered']) . '</div>';
    }
    $output .= '<div class="postcard-left">';
    $output .= '<div class="date-stacked">';
    $output .= '<div class="date-month">' . drupal_render($row->field_field_stanford_event_datetime_2[0]['rendered']) . '</div>';
    $output .= '<div class="date-day">' . drupal_render($row->field_field_stanford_event_datetime_3[0]['rendered']) . '</div>';
    $output .= '</div>'; //end date-stacked
    $output .= '<div class="well">';
    $output .= '<div>'; //undocumented div
    $output .= '<div class="type-event">Event</div>';
    $output .= '<div class="event-date-long descriptor">' . drupal_render($row->field_field_stanford_event_datetime[0]['rendered']) . ' ' . drupal_render($row->field_field_stanford_event_datetime_1[0]['rendered']) . '</div>';
    $output .= '<div class="event-title normal-link"><h3>' . $row->node_title . '</h3></div>';
    $output .= '</div>'; //end undocumented div
    $output .= '</div>'; //end well
    $output .= '</div>';  //end postcard-left
    if ($node_acces) {
      $output .= '<div class="edit-link"><a href="/node/' . $row->nid . '/edit?destination=' . $node_path . '">Edit</a></div>';
    }
    $output .= '</div>'; //end masonry-event
    break;
  case 'stanford_news_item':
    $output = '<div class="masonry-news">';
    if (isset($row->field_field_s_image_info[0])) {
      $output .= '<div>' . drupal_render($row->field_field_s_image_info[0]['rendered']) . '</div>';
    }
    $output .= '<div class="well">';
    $output .= '<div class="type-event">News - ' . drupal_render($row->field_field_s_news_date[0]['rendered'])  . '</div>';
    $output .= '<div class="descriptor">' . drupal_render($row->field_field_s_news_source[0]['rendered']) . '</div>';
    $output .= '<div class="normal-link"><h3>' . $row->node_title . '</h3></div>';
    $output .= '</div>'; //end well
    if ($node_acces) {
      $output .= '<div class="edit-link"><a href="/node/' . $row->nid . '/edit?destination=' . $node_path . '">Edit</a></div>';
    }
    $output .= '</div>'; //end masonry-news
    break;
  case 'stanford_announcement':
    if ($row->field_field_s_announce_tweet[0]['raw']['value'] == 1) {
      //This is a tweet
      $output = '<div class="masonry-tweet">';
      $output .= '<div>' . drupal_render($row->field_body[0]['rendered']) . '</div>';
      if ($node_acces) {
        $output .= '<div class="edit-link"><a href="/node/' . $row->nid . '/edit?destination=' . $node_path . '">Edit</a></div>';
      }
      $output .= '</div>'; //end masonry-tweet
    }
    else {
      $output = '<div class="masonry-announcement">';
      if (isset($row->field_field_s_image_info[0])) {
        $output .= '<div>' . drupal_render($row->field_field_s_image_info[0]['rendered']) . '</div>';
      }
      $output .= '<div class="well">';
      $output .= '<div class="descriptor">Announcement ' . drupal_render($row->field_field_s_announcement_date[0]['rendered']) . '</div>';
      $output .= '<div class="normal-link"><h3>' . $row->node_title . '</h3></div>';
      $output .= '<div>' . drupal_render($row->field_body[0]['rendered']) . '</div>';
      $output .= '</div>'; //end well
      if ($node_acces) {
        $output .= '<div class="edit-link"><a href="/node/' . $row->nid . '/edit?destination=' . $node_path . '">Edit</a></div>';
      }
      $output .= '</div>'; //end masonry-announcement
    }
    break;
  case 'stanford_funded_research':
    $output = '<div class="masonry-research">';
    if (isset($row->field_field_s_image_info[0])) {
      $output .= '<div>' . drupal_render($row->field_field_s_image_info[0]['rendered']) . '</div>';
    }
    $output .= '<div class="well">';
    $output .= '<div class="descriptor">Funded Research ' . drupal_render($row->field_field_s_fund_research_type[0]['rendered']) . '</div>';
    $output .= '<div class="normal-link"><h3>' . $row->node_title . '</h3></div>';
    $output .= '</div>'; //end well
    if ($node_acces) {
      $output .= '<div class="edit-link"><a href="/node/' . $row->nid . '/edit?destination=' . $node_path . '">Edit</a></div>';
    }
    $output .= '</div>'; //end masonry-research
}
print $output;
?>
