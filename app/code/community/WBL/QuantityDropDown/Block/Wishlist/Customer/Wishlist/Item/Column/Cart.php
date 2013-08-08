<?php

class WBL_QuantityDropDown_Block_Wishlist_Customer_Wishlist_Item_Column_Cart extends Mage_Wishlist_Block_Customer_Wishlist_Item_Column_Cart 
{
    /**
     * Configure product view blocks
     *
     * @return Mage_Wishlist_Block_Customer_Wishlist_Item_Column_Cart
     */
    protected function _prepareLayout()
    {
        $quantity_block = $this->getLayout()->createBlock(
            'WBL_QuantityDropDown_Block_Wishlist_Customer_Wishlist_Item_Column_Cart_Quantity',
            'wbl_quantity_dropdown',
            array('template' => 'wbl/quantity_dropdown/wishlist/item/column/cart/quantity.phtml')
        );

        $this->setChild('wbl_quantity_dropdown', $quantity_block);
        return parent::_prepareLayout();
    }
}
