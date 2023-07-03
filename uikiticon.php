<?php
/**
 * UIkit Icon for SEBLOD
 *
 * @package          Joomla.Site
 * @subpackage       plg_cck_field_typo_jumultithumbs
 *
 * @author           Denys Nosov, denys@joomla-ua.org
 * @copyright        2016-2022 (C) Joomla! Ukraine, https://joomla-ua.org. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Layout\FileLayout;

defined('_JEXEC') or die;

// Plugin
class plgCCK_FieldUIkitIcon extends JCckPluginField
{
	protected static $type = 'uikiticon';
	protected static $path;

	// -------- -------- -------- -------- -------- -------- -------- -------- // Construct

	// onCCK_FieldConstruct
	public function onCCK_FieldConstruct($type, &$data = [])
	{
		if(self::$type != $type)
		{
			return;
		}
		parent::g_onCCK_FieldConstruct($data);
	}

	// onCCK_FieldConstruct_SearchSearch
	public static function onCCK_FieldConstruct_SearchSearch(&$field, $style, $data = [], &$config = [])
	{
		$data[ 'live' ]       = null;
		$data[ 'match_mode' ] = null;
		$data[ 'validation' ] = null;
		$data[ 'variation' ]  = null;

		parent::onCCK_FieldConstruct_SearchSearch($field, $style, $data, $config);
	}

	// onCCK_FieldConstruct_TypeForm
	public static function onCCK_FieldConstruct_TypeForm(&$field, $style, $data = [], &$config = [])
	{
		$data[ 'live' ]       = null;
		$data[ 'validation' ] = null;
		$data[ 'variation' ]  = null;

		parent::onCCK_FieldConstruct_TypeForm($field, $style, $data, $config);
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare

	// onCCK_FieldPrepareContent
	public function onCCK_FieldPrepareContent(&$field, $value = '', &$config = [])
	{
		if(self::$type != $field->type)
		{
			return;
		}
		parent::g_onCCK_FieldPrepareContent($field, $config);

		// Init
		$value = $field->location;

		$options2 = JCckDev::fromJSON($field->options2);
		$html     = (new FileLayout('icon', JPATH_SITE . '/plugins/cck_field/uikiticon/tmpl'))->render([
			'sprite' => $options2[ 'sprite' ],
			'icon'   => $value,
			'size'   => $options2[ 'size' ],
			'class'  => ($options2[ 'class' ] ? : '')
		]);

		// Set
		$field->text        = $html;
		$field->typo_target = 'text';
		$field->value       = $value;
	}

	// onCCK_FieldPrepareForm
	public function onCCK_FieldPrepareForm(&$field, $value = '', &$config = [], $inherit = [], $return = false)
	{
		if(self::$type != $field->type)
		{
			return;
		}
		self::$path = parent::g_getPath(self::$type . '/');
		parent::g_onCCK_FieldPrepareForm($field, $config);

		// Prepare
		$value = $field->location;

		$options2 = JCckDev::fromJSON($field->options2);
		$form     = (new FileLayout('icon', JPATH_SITE . '/plugins/cck_field/uikiticon/tmpl'))->render([
			'sprite' => $options2[ 'sprite' ],
			'icon'   => $value,
			'size'   => $options2[ 'size' ],
			'class'  => ($options2[ 'class' ] ? : '')
		]);
		
		// Set
		$field->form  = $form;
		$field->value = $value;

		// Return
		if($return === true)
		{
			return $field;
		}
	}

	// onCCK_FieldPrepareSearch
	public function onCCK_FieldPrepareSearch(&$field, $value = '', &$config = [], $inherit = [], $return = false)
	{
		if(self::$type != $field->type)
		{
			return;
		}

		// Prepare
		self::onCCK_FieldPrepareForm($field, $value, $config, $inherit, $return);

		// Return
		if($return === true)
		{
			return $field;
		}
	}

	// onCCK_FieldPrepareStore
	public function onCCK_FieldPrepareStore(&$field, $value = '', &$config = [], $inherit = [], $return = false)
	{
		if(self::$type != $field->type)
		{
			return;
		}
	}

	// -------- -------- -------- -------- -------- -------- -------- -------- // Render

	// onCCK_FieldRenderContent
	public static function onCCK_FieldRenderContent($field, &$config = [])
	{
		return parent::g_onCCK_FieldRenderContent($field, 'text');
	}

	// onCCK_FieldRenderForm
	public static function onCCK_FieldRenderForm($field, &$config = [])
	{
		return parent::g_onCCK_FieldRenderForm($field);
	}
}