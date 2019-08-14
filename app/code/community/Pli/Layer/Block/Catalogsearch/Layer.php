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
 * Block Layer Catalog Search Navigation
 *
 * @category    Pli
 * @package     Pli_Layer_Block
 * @author      Pavel Livinskiy <ikontakts@gmail.com>
 */
class Pli_Layer_Block_Catalogsearch_Layer extends Mage_CatalogSearch_Block_Layer
{
	private $_priceTemplate = 'pli/catalog/layer/view/filter/price.phtml';

    public function getFilters(){
        $_hash=md5($this->getRequest()->getParam('q'));
        $_arrFilters=parent::getFilters();
        $_session=Mage::getSingleton('pli_layer/session');
        foreach( $_arrFilters as $_filter ){
            // price filter
            if( $_filter instanceof Mage_Catalog_Block_Layer_Filter_Price ){
				$_filter->setTemplate($this->_priceTemplate);
				if( !$_session->getData('max_price_'.$_hash) ){
					$_session->setData('max_price_'.$_hash,$this->getLayer()->getProductCollection()->getMaxPrice()+1);
				}
				$_filter->setMaxPrice($_session->getData('max_price_'.$_hash));
				if( $this->getRequest()->getParam('price') ){
					$_tmpArr=explode('-',$this->getRequest()->getParam('price'));
					$_filter->setFrom( $_tmpArr[0] );
					$_filter->setTo( $_tmpArr[1] );
				} else {
					$_filter->setFrom(0);
					$_filter->setTo( $_filter->getMaxPrice() );
				}
				$_filter->setSymbol(Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol());
            }
        }
        return $_arrFilters;
    }

    /**
     * Check availability display layer options
     *
     * @return bool
     */
    public function canShowOptions()
    {
        foreach ($this->getFilters() as $filter) {
            if ( ($filter->getItemsCount() || $filter instanceof Mage_Catalog_Block_Layer_Filter_Price) ) {
                return true;
            }
        }
        return false;
    }
}