<?php
/** Displays the most current year (used in copyright) */
function year_shortcode () {
  $year = date_i18n ('Y');
  return $year;
}
add_shortcode ('year', 'year_shortcode');