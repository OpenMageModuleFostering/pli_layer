<?php
/**
 * Magento Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Pli
 * @package     Pli_Layer
 * @copyright   Copyright (c) Pavel Livinskiy <ikontakts@gmil.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Model source price
 *
 * @category    Pli
 * @package     Pli_Layer_Model
 * @author      Pavel Livinskiy <ikontakts@gmail.com>
 */
class Pli_Layer_Model_Source_Price extends Varien_Object
{
    public function toOptionArray()
    {
        return array(
            array('value' => Pli_Layer_Model_Catalog_Layer_Filter_Price::TYPE_DEFAULT,    'label' => Mage::helper('pli_layer')->__('Default')),
            array('value' => Pli_Layer_Model_Catalog_Layer_Filter_Price::TYPE_SLIDER,     'label' => Mage::helper('pli_layer')->__('Slider')),
        );
    }

}