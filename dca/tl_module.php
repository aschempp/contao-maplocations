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
 
 
/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['maplocations'] = 'name,type,headline;map,map_template;align,space,cssID';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['map'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['map'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'foreignKey'              => 'tl_maps.title',
	'eval'                    => array('multiple'=>true, 'mandatory'=>true)
);		

$GLOBALS['TL_DCA']['tl_module']['fields']['map_template'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['map_template'],
	'default'                 => 'map_default',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => $this->getTemplateGroup('map_')
);

