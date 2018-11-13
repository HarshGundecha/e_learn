<?php
//incomplete code
	function is_admin_logged_in()
	{
		if (isset($this->session->AdminID))
			return TRUE; 
		else
			return FALSE;
	}
?>