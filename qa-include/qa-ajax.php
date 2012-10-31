<?php


//	Output this header as early as possible

	header('Content-Type: text/plain; charset=utf-8');


//	Ensure no PHP errors are shown in the Ajax response

	@ini_set('display_errors', 0);


//	Load the Q2A base file which sets up a bunch of crucial functions

	require 'qa-base.php';

	qa_report_process_stage('init_ajax');
		

//	Get general Ajax parameters from the POST payload, and clear $_GET

	qa_set_request(qa_post_text('qa_request'), qa_post_text('qa_root'));

	$_GET=array(); // for qa_self_html()
	

//	Database failure handler

	function qa_ajax_db_fail_handler()
	{
		echo "QA_AJAX_RESPONSE\n0\nA database error occurred.";
		qa_exit('error');
	}


//	Perform the appropriate Ajax operation

	$routing=array(
		'notice' => 'qa-ajax-notice.php',
		'favorite' => 'qa-ajax-favorite.php',
		'vote' => 'qa-ajax-vote.php',
		'recalc' => 'qa-ajax-recalc.php',
		'mailing' => 'qa-ajax-mailing.php',
		'version' => 'qa-ajax-version.php',
		'category' => 'qa-ajax-category.php',
		'asktitle' => 'qa-ajax-asktitle.php',
		'answer' => 'qa-ajax-answer.php',
		'comment' => 'qa-ajax-comment.php',
		'click_a' => 'qa-ajax-click-answer.php',
		'click_c' => 'qa-ajax-click-comment.php',
		'click_admin' => 'qa-ajax-click-admin.php',
		'show_cs' => 'qa-ajax-show-comments.php',
	);
	
	$operation=qa_post_text('qa_operation');
	
	if (isset($routing[$operation])) {
		qa_db_connect('qa_ajax_db_fail_handler');

		require QA_INCLUDE_DIR.$routing[$operation];
		
		qa_db_disconnect();
	}


/*
	Omit PHP closing tag to help avoid accidental output
*/