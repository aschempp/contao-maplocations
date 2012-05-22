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
 * @copyright  Andreas Schempp 2008-2010
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id: $
 */

 
class ModuleMapLocations extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'map_default';

	
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### MAP LOCATIONS ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'typolight/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
		
		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
	{
		if (!strlen($this->inColumn))
		{
			$this->inColumn = 'main';
		}

		$objMap = $this->Database->prepare("SELECT * FROM tl_maps WHERE id=?")
										->limit(1)
										->execute($this->map);
										
		if ($objMap->numRows < 1)
			return;
			
		$this->Template->title = $objMap->title;
		$this->Template->description = $objMap->description;
		$this->Template->mapImage = $objMap->mapImage;
		$this->Template->pinSRC = $objMap->customPin ? $objMap->pinSRC : 'system/modules/maplocations/html/pin.gif';
		$this->Template->locations = array();
										
		$objLocations = $this->Database->prepare("SELECT * FROM tl_map_locations WHERE pid=? " . (!BE_USER_LOGGED_IN ? ' AND published=?' : '') . " ORDER BY id")
									  ->execute($objMap->id, 1);
									  

		if ($objLocations->numRows < 1)
			return;

		$locations = $objLocations->fetchAllAssoc();
		
		for($i=0; $i<count($locations); $i++)
		{
			$locations[$i]['headline'] = deserialize($locations[$i]['headline']);
		
			if ($locations[$i]['addImage'] && strlen($locations[$i]['singleSRC']) && is_file(TL_ROOT . '/' . $locations[$i]['singleSRC']))
			{	
				$size = deserialize($locations[$i]['size']);
				$arrImageSize = getimagesize(TL_ROOT . '/' . $locations[$i]['singleSRC']);
	
				$src = $this->getImage($this->urlEncode($locations[$i]['singleSRC']), $size[0], $size[1]);
	
				if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false)
				{
					$locations[$i]['imgSize'] = ' ' . $imgSize[3];
				}
				
				$locations[$i]['src'] = $src;
				$locations[$i]['addBefore'] = ($locations[$i]['floating'] != 'below');
				$locations[$i]['margin'] = $this->generateMargin(deserialize($locations[$i]['imagemargin']), 'padding');
				$locations[$i]['float'] = in_array($locations[$i]['floating'], array('left', 'right')) ? sprintf(' float:%s;', $locations[$i]['floating']) : '';
			}
			
			if ($locations[$i]['linkAddress'] && $locations[$i]['addressId'] > 0 && count(deserialize($locations[$i]['addressFields'])))
			{
				$address = array();
				$locations[$i]['address'] = $this->Database->prepare("SELECT `" . implode('`, `', deserialize($locations[$i]['addressFields'])) . "` FROM tl_addresses WHERE id=?")
										  ->limit(1)
										  ->execute($locations[$i]['addressId'])
										  ->fetchAssoc();
			}
		}
		
		if ($locations)
			$this->Template->locations = $locations;
		else
			$this->Template->locations = array();
		
		$this->Template->pinLabel = $GLOBALS['TL_LANG']['MSC']['label_pin'];
		
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/maplocations/html/maplocations.js';
	}
}

