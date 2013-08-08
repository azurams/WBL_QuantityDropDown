<?php
class WBL_QuantityDropDown_Block_Catalog_Product_View_Quantity extends Mage_Catalog_Block_Product_View
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
        return Mage::helper('quantity_dropdown')->getQuantityOptions($this->getProduct());
    }
}
