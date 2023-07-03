<?php
/**
 * UIkit Icon for SEBLOD
 *
 * @package          Joomla.Site
 * @subpackage       plg_cck_field_uikiticon
 *
 * @author           Denys Nosov, denys@joomla-ua.org
 * @copyright        2023 (C) Joomla! Ukraine, https://joomla-ua.org. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Layout\FileLayout;

defined('_JEXEC') or die;

/**
 * plgCCK_FieldUIkitIcon
 *
 * @since       1.0
 * @subpackage  plg_cck_field_uikiticon
 * @package     Joomla.Site
 */
class plgCCK_FieldUIkitIcon extends JCckPluginField
{
	/**
	 * @since 1.0
	 * @var string
	 */
	protected static string $type = 'uikiticon';

	/**
	 * @since 1.0
	 * @var string
	 */
	protected static string $path;

	/**
	 * @param          $type
	 * @param   array  $data
	 *
	 * @return void
	 * @since 1.0
	 */
	public function onCCK_FieldConstruct($type, array &$data = [])
	{
		if(self::$type !== $type)
		{
			return;
		}

		$this->g_onCCK_FieldConstruct($data);
	}

	/**
	 * @param          $field
	 * @param          $style
	 * @param   array  $data
	 * @param   array  $config
	 *
	 * @return void
	 * @since 1.0
	 */
	public static function onCCK_FieldConstruct_SearchSearch(&$field, $style, $data = [], &$config = [])
	{
		$data[ 'live' ]       = null;
		$data[ 'match_mode' ] = null;
		$data[ 'validation' ] = null;
		$data[ 'variation' ]  = null;

		parent::onCCK_FieldConstruct_SearchSearch($field, $style, $data, $config);
	}

	/**
	 * @param          $field
	 * @param          $style
	 * @param   array  $data
	 * @param   array  $config
	 *
	 * @return void
	 * @since 1.0
	 */
	public static function onCCK_FieldConstruct_TypeForm(&$field, $style, $data = [], &$config = [])
	{
		$data[ 'live' ]       = null;
		$data[ 'validation' ] = null;
		$data[ 'variation' ]  = null;

		parent::onCCK_FieldConstruct_TypeForm($field, $style, $data, $config);
	}

	/**
	 * @param           $field
	 * @param   string  $value
	 * @param   array   $config
	 *
	 * @return void
	 * @since 1.0
	 */
	public function onCCK_FieldPrepareContent(&$field, string $value = '', array &$config = [])
	{
		if(self::$type !== $field->type)
		{
			return;
		}

		self::g_onCCK_FieldPrepareContent($field, $config);

		$options2 = JCckDev::fromJSON($field->options2);
		$html     = (new FileLayout('icon', JPATH_SITE . '/plugins/cck_field/uikiticon/tmpl'))->render([
			'sprite' => $options2[ 'sprite' ],
			'icon'   => $field->location,
			'size'   => $options2[ 'size' ],
			'class'  => ($options2[ 'class' ] ? : '')
		]);

		$field->text        = $html;
		$field->typo_target = 'text';
		$field->value       = $field->location;
	}

	/**
	 * @param           $field
	 * @param   string  $value
	 * @param   array   $config
	 * @param   array   $inherit
	 * @param   bool    $return
	 *
	 * @return void
	 * @since 1.0
	 */
	public function onCCK_FieldPrepareForm(&$field, string $value = '', array &$config = [], array $inherit = [], bool $return = false)
	{
		if(self::$type !== $field->type)
		{
			return;
		}

		self::$path = self::g_getPath(self::$type . '/');
		self::g_onCCK_FieldPrepareForm($field, $config);

		$options2 = JCckDev::fromJSON($field->options2);
		$form     = (new FileLayout('icon', JPATH_SITE . '/plugins/cck_field/uikiticon/tmpl'))->render([
			'sprite' => $options2[ 'sprite' ],
			'icon'   => $field->location,
			'size'   => $options2[ 'size' ],
			'class'  => ($options2[ 'class' ] ? : '')
		]);

		$field->form  = $form;
		$field->value = $field->location;

		if($return === true)
		{
			return $field;
		}
	}

	/**
	 * @param           $field
	 * @param   string  $value
	 * @param   array   $config
	 * @param   array   $inherit
	 * @param   bool    $return
	 *
	 * @return void
	 * @since 1.0
	 */
	public function onCCK_FieldPrepareSearch(&$field, string $value = '', array &$config = [], array $inherit = [], bool $return = false)
	{
		if(self::$type !== $field->type)
		{
			return;
		}

		$this->onCCK_FieldPrepareForm($field, $value, $config, $inherit, $return);

		if($return === true)
		{
			return $field;
		}
	}

	/**
	 * @param           $field
	 * @param   string  $value
	 * @param   array   $config
	 * @param   array   $inherit
	 * @param   bool    $return
	 *
	 * @return void|bool
	 * @since 1.0
	 */
	public function onCCK_FieldPrepareStore($field, string $value = '', array &$config = [], array $inherit = [], bool $return = false)
	{
		if(self::$type !== $field->type)
		{
			return true;
		}
	}

	/**
	 * @param          $field
	 * @param   array  $config
	 *
	 * @return mixed
	 * @since 1.0
	 */
	public static function onCCK_FieldRenderContent($field, array &$config = [])
	{
		return parent::g_onCCK_FieldRenderContent($field, 'text');
	}

	/**
	 * @param          $field
	 * @param   array  $config
	 *
	 * @return mixed
	 * @since 1.0
	 */
	public static function onCCK_FieldRenderForm($field, array &$config = [])
	{
		return parent::g_onCCK_FieldRenderForm($field);
	}
}