<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


class ImageMap extends Widget
{

	/**
	 * Submit user input
	 * @var boolean
	 */
	protected $blnSubmitInput = true;

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'be_widget';

	/**
	 * Contents
	 * @var array
	 */
	protected $arrContents = array();


	/**
	 * Add specific attributes
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		switch ($strKey)
		{
			case 'value':
				$this->varValue = deserialize($varValue);
				break;

			case 'maxlength':
				$this->arrAttributes[$strKey] = ($varValue > 0) ? $varValue : '';
				break;

			case 'mandatory':
				$this->arrConfiguration['mandatory'] = $varValue ? true : false;
				break;

			default:
				parent::__set($strKey, $varValue);
				break;
		}
	}


	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		if (!$this->multiple)
		{
			$this->import('Database');
			$objMap = $this->Database->prepare("SELECT title, mapImage FROM tl_maps WHERE id=?")
										->limit(1)
										->execute($_SESSION['BE_DATA']['CURRENT_ID']);
		
			
			return sprintf('<div id="%s" class="%s" style="position: relative; cursor: crosshair"><img id="locationpin" style="display: none; position: absolute" src="system/modules/maplocations/html/pin.gif" alt="%s" /><img src="%s" alt="%s" style="cursor: crosshair" onclick="set_pin(event, this)" /><input id="pinvalue" type="hidden" name="%s" value="%s" /></div>
			
			<script type="text/javascript">
			<!--//--><![CDATA[//><!--
			
				function set_pin(eventData, element)
				{
					eventData = (eventData) ? eventData : event;

					if (typeof(eventData.offsetX) != \'undefined\') {
						var x = eventData.offsetX;
						var y = eventData.offsetY-15;
					} else {
							
						var offsetTop = 0;
						var offsetLeft = 0;
						
						while (element && typeof element.offsetLeft == "number") {
							offsetLeft += element.offsetLeft;
							offsetTop += element.offsetTop;
							element = element.offsetParent;
						};
					
						var x = eventData.pageX - offsetLeft;
						var y = eventData.pageY - offsetTop - 15;
					}
				
					document.getElementById(\'pinvalue\').value=x+\',\'+y;
					document.getElementById(\'locationpin\').style.pixelTop = y;
					document.getElementById(\'locationpin\').style.top = y+\'px\';
					document.getElementById(\'locationpin\').style.pixelLeft = x;
					document.getElementById(\'locationpin\').style.left = x+\'px\';
					
					if (document.getElementById(\'locationpin\').style.display == \'none\')
						document.getElementById(\'locationpin\').style.display = \'block\';
				}
				
				function init_pin()
				{
					if (document.getElementById(\'pinvalue\').value != \'\') {
						var pinvalue = document.getElementById(\'pinvalue\').value;
						var locations = pinvalue.split(\',\');
						
						document.getElementById(\'locationpin\').style.pixelTop = locations[1];
						document.getElementById(\'locationpin\').style.top = locations[1]+\'px\';
						document.getElementById(\'locationpin\').style.pixelLeft = locations[0];
						document.getElementById(\'locationpin\').style.left = locations[0]+\'px\';
						document.getElementById(\'locationpin\').style.display = \'block\';
					}
				}
				
				init_pin();
			
			//--><!]]>
			</script>
			
			',
							$this->strId,
							(strlen($this->strClass) ? ' ' . $this->strClass : ''),
							"Aktuelle Position",
							$objMap->mapImage,
							$objMap->title,
							$this->strName,
							specialchars($this->varValue));
		}
		
		throw Exception('Widget ImageMap cannot be used more than once on a page.');
/*
		// Return if field size is missing
		if (!$this->size)
		{
			return '';
		}

		if (!is_array($this->varValue))
		{
			$this->varValue = array($this->varValue);
		}

		$arrFields = array();

		for ($i=0; $i<$this->size; $i++)
		{
			$arrFields[] = sprintf('<input type="text" name="%s[]" id="ctrl_%s" class="tl_text_%s" value="%s"%s onfocus="Backend.getScrollOffset();" />',
									$this->strName,
									$this->strId.'_'.$i,
									$this->size,
									specialchars($this->varValue[$i]),
									$this->getAttributes());
		}

		return sprintf('<div id="ctrl_%s"%s>%s</div>',
						$this->strId,
						(strlen($this->strClass) ? ' class="' . $this->strClass . '"' : ''),
						implode(' ', $arrFields));
		*/
	}
}

