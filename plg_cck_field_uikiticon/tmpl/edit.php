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

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

$options2 = JCckDev::fromJSON($this->item->options2);

$icons = [];
if(@$options2[ 'sprite' ])
{
	if(is_file(JPATH_SITE . '/' . @$options2[ 'sprite' ]))
	{
		$sprite = @file_get_contents(JPATH_SITE . '/' . @$options2[ 'sprite' ]);
		$dom    = new DOMDocument;

		$dom->loadXML($sprite);

		$symbols = $dom->getElementsByTagName('symbol');

		$items = [];
		foreach($symbols as $symbol)
		{
			$items[] = $symbol->getAttribute('id');
		}

		$icons = [
			'storage_field' => 'location',
			'options'       => implode('||', $items),
			'required'      => 'required'
		];
	}
}
else
{
	$app = Factory::getApplication();
	$app->enqueueMessage(Text::_('COM_CCK_ADD_SPRITE_PATH'), 'notice');
}

JCckDev::forceStorage();

$sprite_icons = '';
$sprite_size  = '';
$sprite_class = '';
if(@$options2[ 'sprite' ])
{
	$sprite_icons = JCckDev::renderForm('core_icons', $this->item->location, $config, $icons);
	$sprite_size  = JCckDev::renderForm('core_dev_text', @$options2[ 'size' ], $config, [
		'label'         => 'Size',
		'defaultvalue'  => '24',
		'size'          => 50,
		'storage_field' => 'json[options2][size]'
	]);
	$sprite_class = JCckDev::renderForm('core_dev_text', @$options2[ 'class' ], $config, [
		'label'         => 'Class',
		'size'          => 50,
		'storage_field' => 'json[options2][class]'
	]);
}

// Set
$displayData = [
	'config' => $config,
	'form'   => [
		[
			'fields' => [
				JCckDev::renderForm('core_dev_text', @$options2[ 'sprite' ], $config, [
					'label'         => 'Sprite Path',
					'required'      => 'required',
					'size'          => 50,
					'storage_field' => 'json[options2][sprite]'
				]),
				$sprite_icons,
				$sprite_size,
				$sprite_class
			]
		],
		[
			'fields' => [
				JCckDev::getForm('core_storage', $this->item->storage, $config)
			],
			'mode'   => 'storage'
		]
	],
	'help'   => [],
	'html'   => '',
	'item'   => $this->item,
	'script' => ''
];

echo JCckDev::renderLayoutFile('cck' . JCck::v() . '.construction.cck_field.edit', $displayData);