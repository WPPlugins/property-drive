<?php

function jtg_setup_custom_schedules($schedules){
    if(!isset($schedules["5min"])){
        $schedules["5min"] = array(
            'interval' => 5*60,
            'display' => __('Once every 5 minutes'));
    }
    if(!isset($schedules["30min"])){
        $schedules["30min"] = array(
            'interval' => 30*60,
            'display' => __('Once every 30 minutes'));
    }
    return $schedules;
}
add_filter('cron_schedules','jtg_setup_custom_schedules');






function jtg_hourly_ipmorter()
{   
    // Check to see if the Auto Sync is turned on
    // if it has not been set it will not work either
    $options = get_option('pm_importer_options', true);
    if ($options['auto_sync'] === 'true') {
            jtg_process_import();
    }
}
add_action('jtg_run_cron_importer','jtg_hourly_ipmorter');

function jtg_on_activation()
{

  $options = get_option('pm_importer_options');

  if ($options['jtg_importer_schedule']) {
    if (! wp_next_scheduled ( 'jtg_run_cron_importer' )) {
      wp_schedule_event(time(), $options['jtg_importer_schedule'], 'jtg_run_cron_importer');
    }
  } else {

   wp_schedule_event(time(), 'hourly', 'jtg_run_cron_importer');
  }
   
}

function jtg_on_deactivation()
{
    // Unset schedule
    wp_clear_scheduled_hook('jtg_run_cron_importer');
}