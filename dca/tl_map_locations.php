<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009-2011
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


/**
 * Table tl_map_locations
 */
$GLOBALS['TL_DCA']['tl_map_locations'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_maps',
		'enableVersioning'            => false,
		'onload_callback' => array
		(
			array('tl_map_locations', 'checkAddressBook')
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('id DESC'),
			'headerFields'            => array('title', 'description'),
			'panelLayout'             => 'filter;search,limit',
			'child_record_callback'   => array('tl_map_locations', 'listMapLocations')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_map_locations']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_map_locations']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_map_locations']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_map_locations']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('addImage', 'linkAddress', 'customPin'),
		'default'                     => '{content_legend},headline,text,url;{location_legend},mapLocation;{image_legend},addImage;{pin_legend},customPin;{publish_legend},published'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'addImage'                    => 'singleSRC,alt,imagemargin,size,caption,floating,fullsize',
		'linkAddress'				  => 'addressId,addressFields',
		'customPin'					  => 'pinSRC',
	),

	// Fields
	'fields' => array
	(
		'headline' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['headline'],
			'search'                  => true,
			'inputType'               => 'inputUnit',
			'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['text'],
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true),
			'explanation'             => 'insertTags'
		),
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['url'],
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'rgxp'=>'url', 'tl_class'=>'long'),
		),
		'mapLocation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['mapLocation'],
			'inputType'               => 'imagemap'
		),
		'addImage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['addImage'],
			'inputType'               => 'checkbox',
			'filter'				  => true,
			'eval'                    => array('submitOnChange'=>true)
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['singleSRC'],
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'mandatory'=>true)
		),
		'size' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['size'],
			'inputType'               => 'text',
			'eval'                    => array('multiple'=>true, 'size'=>2, 'rgxp'=>'digit', 'nospace'=>true)
		),
		'alt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['alt'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'extnd', 'maxlength'=>255)
		),
		'caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['caption'],
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'extnd', 'maxlength'=>255)
		),
		'floating' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['floating'],
			'inputType'               => 'radioTable',
			'options'                 => array('above', 'left', 'right'),
			'eval'                    => array('cols'=>3),
			'reference'               => &$GLOBALS['TL_LANG']['MSC']
		),
		'imagemargin' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['imagemargin'],
			'inputType'               => 'trbl',
			'options'                 => array('px', '%', 'em', 'pt', 'pc', 'in', 'cm', 'mm'),
			'eval'                    => array('includeBlankOption'=>true)
		),
		'fullsize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['fullsize'],
			'filter'				  => true,
			'inputType'               => 'checkbox'
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['published'],
			'filter'                  => true,
			'flag'                    => 2,
			'inputType'               => 'checkbox'
		),
		'linkAddress' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['linkAddress'],
			'filter'				  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'addressId' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['addressId'],
			'flag'                    => 2,
			'inputType'               => 'select',
			'options_callback'		  => array('tl_map_locations', 'getAddresses')
		),
		'addressFields' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['addressFields'],
			'inputType'               => 'checkbox',
			'eval'					  => array('multiple'=>true),
			'options_callback'		  => array('tl_map_locations', 'getAddressFields')
		),
		
		'customPin' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['customPin'],
			'filter'				  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'pinSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_map_locations']['pinSRC'],
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>'jpeg,jpg,gif,png', 'mandatory'=>true)
		),
	)
);


class tl_map_locations extends Backend
{

	var $ab_table = 'tl_addresses';

	/**
	 * Check if address book is installed
	 * http://www.typolight.org/wiki/extensions:addressbook
	 */
	public function checkAddressBook()
	{
		$this->loadDataContainer($this->ab_table);
		
		if($this->Input->get('act') == "edit" && isset($GLOBALS['TL_DCA'][$this->ab_table]))
		{
			$GLOBALS['TL_DCA']['tl_map_locations']['palettes']['default'] = str_replace('addImage;','addImage;{address_legend},linkAddress;',$GLOBALS['TL_DCA']['tl_map_locations']['palettes']['default']);
		}
	}

	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function listMapLocations($arrRow)
	{
		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$headline = deserialize($arrRow['headline']);
		$headline = $headline['value'];
		
		if ($arrRow['linkAddress'] && $arrRow['addressId'] > 0 && count(deserialize($arrRow['addressFields'])))
		{
			$this->import('Database', 'Database');
			$this->loadDataContainer($this->ab_table);
			$this->loadLanguageFile($this->ab_table);
			$address = $this->Database->prepare("SELECT * FROM ".$this->ab_table." WHERE id=?")
						   ->execute($arrRow['addressId'])
						   ->fetchAssoc();
						   
			$address = '<br />'.$this->labelForRow($address, $this->ab_table).' (';
			
			$fields = array();
			foreach( $GLOBALS['TL_DCA'][$this->ab_table]['fields'] as $fname => $fvalues )
			{
				$fields[$fname] = $fvalues['label'][0];
			}
			$address .= implode(', ', $fields).')';
		}

		return '
<div class="cte_type ' . $key . '"><strong>' . $headline . '</strong></div>
<div class="h64 block">
' . $arrRow['text'] . $address . '
</div>' . "\n";
	}
	
	
	public function getAddresses()
	{
		$arrResult = array();
		$table = $this->ab_table;
		$this->import('Database', 'Database');
		$this->loadDataContainer($this->ab_table);
		$sorting_fields = $GLOBALS['TL_DCA'][$this->ab_table]['list']['sorting']['fields'];
		
		if ( !$this->Database->tableExists($this->ab_table) )
			return array();
		
		$rows = $this->Database->prepare("SELECT * FROM " . $this->ab_table ." ORDER BY " . implode(',', $sorting_fields))
				 			   ->execute()
					   		   ->fetchAllAssoc();		
		
		foreach( $rows as $row )
		{
			$arrResult[$row['id']] = $this->labelForRow($row, $this->ab_table);
		}
		
		return $arrResult;
	}
	
	
	public function getAddressFields()
	{
		$this->loadDataContainer($this->ab_table);
		$this->loadLanguageFile($this->ab_table);
		$fields = $GLOBALS['TL_DCA'][$this->ab_table]['fields'];
		$arrResult = array();
		
		foreach( $fields as $fname => $fvalues )
		{
			$arrResult[$fname] = $fvalues['label'][0];
		}
		
		return $arrResult;
	}
	
	private function labelForRow($row, $table)
	{
		$showFields = $GLOBALS['TL_DCA'][$table]['list']['label']['fields'];
		
		// Label
		foreach ($showFields as $k=>$v)
		{
			if (in_array($GLOBALS['TL_DCA'][$table]['fields'][$v]['flag'], array(5, 6, 7, 8, 9, 10)))
			{
				$labels[$k] = date($GLOBALS['TL_CONFIG']['datimFormat'], $row[$v]);
			}
			elseif ($GLOBALS['TL_DCA'][$table]['fields'][$v]['inputType'] == 'checkbox' && !$GLOBALS['TL_DCA'][$table]['fields'][$v]['eval']['multiple'])
			{
				$labels[$k] = strlen($row[$v]) ? $GLOBALS['TL_DCA'][$table]['fields'][$v]['label'][0] : '';
			}
			else
			{
				$row_v = deserialize($row[$v]);
	
				if (is_array($row_v))
				{
					$args_k = array();
	
					foreach ($row_v as $option)
					{
						$args_k[] = strlen($GLOBALS['TL_DCA'][$table]['fields'][$v]['reference'][$option]) ? $GLOBALS['TL_DCA'][$table]['fields'][$v]['reference'][$option] : $option;
					}
	
					$labels[$k] = implode(', ', $args_k);
				}
				elseif (is_array($GLOBALS['TL_DCA'][$table]['fields'][$v]['reference'][$row[$v]]))
				{
					$labels[$k] = is_array($GLOBALS['TL_DCA'][$table]['fields'][$v]['reference'][$row[$v]]) ? $GLOBALS['TL_DCA'][$table]['fields'][$v]['reference'][$row[$v]][0] : $GLOBALS['TL_DCA'][$table]['fields'][$v]['reference'][$row[$v]];
				}
				else
				{
					$labels[$k] = $row[$v];
				}
			}
		}
	
		// Shorten label it if it is too long
		$label = vsprintf((strlen($GLOBALS['TL_DCA'][$table]['list']['label']['format']) ? $GLOBALS['TL_DCA'][$table]['list']['label']['format'] : '%s'), $labels);
	
		if (strlen($GLOBALS['TL_DCA'][$table]['list']['label']['maxCharacters']) && $GLOBALS['TL_DCA'][$table]['list']['label']['maxCharacters'] < strlen($label))
		{
			$label = trim(utf8_substr($label, 0, $GLOBALS['TL_DCA'][$table]['list']['label']['maxCharacters'])).'...';
		}
	
		// Remove empty brackets (), [], {}, <> and empty tags from label
		$label = preg_replace('/\(\) ?|\[\] ?|\{\} ?|<> ?/i', '', $label);
		$label = preg_replace('/<[^>]+>\s*<\/[^>]+>/i', '', $label);
		
		return $label;
	}
}

