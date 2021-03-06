<?php
// PukiWiki - Yet another WikiWikiWeb clone.
// $Id: unfreeze.inc.php,v 1.14.7 2011/02/05 10:19:00 Logue Exp $
// Copyright (C)
//   2010-2011 PukiWiki Advance Developers Team
//   2004-2007 PukiWiki Plus! Team
//   2003-2004, 2007 PukiWiki Developers Team
// License: GPL v2 or (at your option) any later version
//
// Unfreeze(Unlock) plugin
use PukiWiki\Auth\Auth;
use PukiWiki\Factory;
use PukiWiki\Utility;

// Show edit form when unfreezed
defined('PLUGIN_UNFREEZE_EDIT') or define('PLUGIN_UNFREEZE_EDIT', TRUE);

function plugin_unfreeze_action()
{
	global $vars, $function_freeze, $_string;

	$_title_isunfreezed = T_(' $1 is not frozen');
	$_title_unfreezed   = T_(' $1 has been unfrozen.');
	$_title_unfreeze    = T_('Unfreeze  $1');
	$_msg_invalidpass   = $_string['invalidpass'];
	$_msg_unfreezing    = T_('Please input the password for unfreezing.');
	$_btn_unfreeze      = T_('Unfreeze');

	$page = isset($vars['page']) ? $vars['page'] : '';
	$wiki = Factory::Wiki($page);
	if (! $function_freeze || $wiki->isEditable() || ! $wiki->isValied($page))
		return array('msg' => '', 'body' => '');

	$pass = isset($vars['pass']) ? $vars['pass'] : NULL;
	$msg = $body = '';
	if (! $wiki->isFreezed()) {
		// Unfreezed already
		$msg  = $_title_isunfreezed;
		$body = str_replace('$1', htmlsc(strip_bracket($page)),
			$_title_isunfreezed);

	} else
	if ( (! Auth::check_role('role_contents_admin') ) ||
	     ($pass !== NULL && pkwk_login($pass)) )
	{
		
		// BugTrack2/255
		$wiki->checkReadable();
		// Unfreeze
		$postdata = $wiki->get();
		array_shift($postdata);
		$wiki->set($postdata);

		// Update
		if (PLUGIN_UNFREEZE_EDIT) {
			// BugTrack2/255
			$wiki->checkEditable(true);
//			$vars['cmd'] = 'read'; // To show 'Freeze' link
			$vars['cmd'] = 'edit';
			$msg  = $_title_unfreezed;
			$body = (!IS_AJAX) ? edit_form($page, $postdata) : $_title_unfreezed;
		} else {
			$vars['cmd'] = 'read';
			$msg  = $_title_unfreezed;
			$body = '';
		}

	} else {
		// Show unfreeze form
		$msg    = $_title_unfreeze;
		$s_page = Utility::htmlsc($page);
		$body   = ($pass === NULL) ? '' : '<p class="message_box ui-state-error"><strong>'.$_msg_invalidpass.'</strong></p>'."\n";
		$script = get_script_uri();
		$body  .= <<<EOD
<fieldset>
	<legend>$_msg_unfreezing</legend>
	<form action="$script" method="post" class="form-inline plugin-form-unfreeze">
		<input type="hidden" name="cmd"  value="unfreeze" />
		<input type="hidden" name="page" value="$s_page" />
		<div class="form-group">
			<input type="password" name="pass" size="12" class="form-group" />
		</div>
		<input type="submit" class="btn btn-primary"  name="ok"   value="$_btn_unfreeze" />
	</form>
</fieldset>
EOD;
	}

	return array('msg'=>$msg, 'body'=>$body);
}
/* End of file unfreeze.inc.php */
/* Location: ./wiki-common/plugin/unfreeze.inc.php */
