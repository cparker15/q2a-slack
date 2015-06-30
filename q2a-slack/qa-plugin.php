<?php
/*
        q2a-slack by Leonard Challis
        http://www.leonardchallis.com/

        for
            
        Question2Answer by Gideon Greenspan and contributors
	http://www.question2answer.org/
        
        Plugin Name: q2a-slack
	Plugin URI:
	Plugin Description: Post question events to Slack
	Plugin Version: 1.0
	Plugin Date: 2015-06-20
	Plugin Author: Leonard Challis
	Plugin Author URI: http://www.leonardchallis.com/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) {
	header('Location: ../../');
	exit;
}
qa_register_plugin_module('event', 'qa-slack.php', 'qa_slack', 'Slack');
