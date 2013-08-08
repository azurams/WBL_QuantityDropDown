<?php
class WBL_QuantityDropDown_Block_Checkout_Cart_Item_Renderer extends Mage_Checkout_Block_Cart_Item_Renderer
{

    /**
     * Configure product view blocks
     *
     * @return Mage_Checkout_Block_Cart_Item_Configure
     */
    protected function _prepareLayout()
    {
        $quantity_block = $this->getLayout()->createBlock(
            'WBL_QuantityDropDown_Block_Checkout_Cart_Item_Default_Quantity',
            'wbl_quantity_dropdown',
            array('template' => 'wbl/quantity_dropdown/checkout/cart/item/default/quantity.phtml')
        );

        $this->setChild('wbl_quantity_dropdown', $quantity_block);
        return parent::_prepareLayout();
    }
}
