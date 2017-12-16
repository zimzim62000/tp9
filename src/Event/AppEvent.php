<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 21:25
 */

namespace App\Event;

class AppEvent{
	const USER_CARD_ADD = "user_card_add";
	const USER_CARD_EDIT = "user_card_edit";
	const USER_CARD_DELETE = "user_card_delete";
	
	const LOG_USER_CARD_ADD = "log_user_card_add";
	const LOG_USER_CARD_EDIT = "log_user_card_edit";
	const LOG_USER_CARD_DELETE = "log_user_card_delete";
	const LOG_USER_CARD_SHOW = "log_user_card_show";
}