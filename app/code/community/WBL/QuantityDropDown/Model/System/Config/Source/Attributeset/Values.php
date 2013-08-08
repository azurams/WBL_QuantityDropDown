<?php

class WBL_QuantityDropDown_Model_System_Config_Source_Attributeset_Values
{
    public function toOptionArray()
    {

        $entityTypeId = Mage::getSingleton('eav/config')->getEntityType(Mage_Catalog_Model_Product::ENTITY)->getId();
        $collection = Mage::getResourceModel('eav/entity_attribute_set_collection')
            ->setEntityTypeFilter($entityTypeId);
        $options = array();
        foreach($collection as $attributeSet) {
            $options[] = array(
                'value' => $attributeSet['attribute_set_id'],
                'label' => $attributeSet['attribute_set_name']. ' (id: '.$attributeSet['attribute_set_id'].')');
        }

        return $options;

    }
}
