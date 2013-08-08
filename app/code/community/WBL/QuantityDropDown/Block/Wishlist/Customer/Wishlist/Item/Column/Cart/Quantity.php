<?php
class WBL_QuantityDropDown_Block_Wishlist_Customer_Wishlist_Item_Column_Cart_Quantity extends Mage_Wishlist_Block_Customer_Wishlist_Item_Column_Cart
{

    public function isApplicable() {

        $enabledAttributeSets = Mage::helper('quantity_dropdown')->getEnabledAttributeSetIds();

        if ($this->getItem()) {
        	$product = $this->getItem()->getProduct();
        }
        if($product && $product->getAttributeSetId()) {
            return in_array($product->getAttributeSetId(), $enabledAttributeSets);
        }
        return FALSE;

    }

    public function getQuantityOptions()
    {
        $product = $this->getItem()->getProduct();
        return Mage::helper('quantity_dropdown')->getQuantityOptions($product);
    }

}
