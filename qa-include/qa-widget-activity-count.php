<?php

/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-include/qa-widget-activity-count.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Widget module class for activity count plugin


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

	class qa_activity_count {
		
		function allow_template($template)
		{
			return true;
		}

		
		function allow_region($region)
		{
			return ($region=='side');
		}

		
		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
			$themeobject->output('<table class="table"><tbody>');
			
			$this->output_count($themeobject, qa_opt('cache_qcount'), 'main/1_question', 'main/x_questions');
			$this->output_count($themeobject, qa_opt('cache_acount'), 'main/1_answer', 'main/x_answers');
			
			if (qa_opt('comment_on_qs') || qa_opt('comment_on_as'))
				$this->output_count($themeobject, qa_opt('cache_ccount'), 'main/1_comment', 'main/x_comments');
			
			$this->output_count($themeobject, qa_opt('cache_userpointscount'), 'main/1_user', 'main/x_users');
			
			$themeobject->output('</tbody></table>');
		}
		

		function output_count($themeobject, $value, $langsingular, $langplural)
		{
			$themeobject->output('<tr>');
			
			if ($value==1) {
				$themeobject->output('<td>');
				$themeobject->output(qa_lang_html_sub($langsingular, '<SPAN CLASS="badge badge-info">1</SPAN>', '1'));
				$themeobject->output('</td>'); }
			else {
				$themeobject->output('<td>');
				$themeobject->output(qa_lang_html_sub($langplural, '<SPAN CLASS="badge badge-info">'.number_format((int)$value).'</SPAN>'));
				$themeobject->output('</td>'); }

			$themeobject->output('</tr>');
		}
	
	}
	

/*
	Omit PHP closing tag to help avoid accidental output
*/