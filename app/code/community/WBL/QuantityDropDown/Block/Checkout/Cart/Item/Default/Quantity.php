<?php
class WBL_QuantityDropDown_Block_Checkout_Cart_Item_Default_Quantity extends Mage_Checkout_Block_Cart_Item_Renderer
{


    public function isApplicable() {

        $enabledAttributeSets = Mage::helper('quantity_dropdown')->getEnabledAttributeSetIds();

        if ($this->getProduct() && $this->getProduct()->getAttributeSetId()) {
            return in_array($this->getProduct()->getAttributeSetId(), $enabledAttributeSets);
        }
        return FALSE;

    }

    public function getQuantityOptions()
    {
        if(!$this->isApplicable()) {
            return false;
        }
        $product = $this->getItem()->getProduct();
        $quantityOptions = Mage::helper('quantity_dropdown')->getQuantityOptions($product);
        if(!in_array($this->getItem()->getQty(),$quantityOptions['values'])) {
            Mage::getSingleton('checkout/session')->addError($this->__('Quantity is not allowed for %s',$this->getItem()->getName()));
            $this->setData('qtyError',true);
        }
        return Mage::helper('quantity_dropdown')->getQuantityOptions($product);
    }


}
