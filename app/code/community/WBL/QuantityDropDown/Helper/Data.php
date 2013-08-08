<?php
class WBL_QuantityDropDown_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATH_QUANTITY_DROPDOWN_ACTIVE = 'wbl_quantity_dropdown/general/enable';
    const XML_PATH_QUANTITY_DROPDOWN_DEFAULT_LIST_VALUES = 'wbl_quantity_dropdown/default/list_values';
    const XML_PATH_QUANTITY_DROPDOWN_DEFAULT_PRESELECTED_VALUE = 'wbl_quantity_dropdown/default/preselected_value';

    const XML_PATH_QUANTITY_DROPDOWN_ATTRIBUTE_SET_APPLY_TO = 'wbl_quantity_dropdown/attribute_set/apply_to';
    const XML_PATH_QUANTITY_DROPDOWN_ATTRIBUTE_SET_LIST_VALUES = 'wbl_quantity_dropdown/attribute_set/list_values';


    public function isExtentionActive()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_QUANTITY_DROPDOWN_ACTIVE);
    }

    public function getDefaultListValues()
    {
        return Mage::getStoreConfig(self::XML_PATH_QUANTITY_DROPDOWN_DEFAULT_LIST_VALUES);
    }

    public function getDefaultListValuesAsArray()
    {
        $values_array = array();
        $defaultListValues = $this->getDefaultListValues();
        if(!empty($defaultListValues)) {
            $values_array = explode(',', $defaultListValues);
        }
        return $values_array;
    }

    public function getDefaultPreselectedValue()
    {
        return Mage::getStoreConfig(self::XML_PATH_QUANTITY_DROPDOWN_DEFAULT_PRESELECTED_VALUE);
    }

    public function getEnabledAttributeSetIds() {
        $enabledAttributeSets = Mage::getStoreConfig(self::XML_PATH_QUANTITY_DROPDOWN_ATTRIBUTE_SET_APPLY_TO);
        return explode(',',$enabledAttributeSets);
    }

    public function getListValuesByAttributeSetId($product_attribute_set_id) {

        $data = Mage::getStoreConfig(self::XML_PATH_QUANTITY_DROPDOWN_ATTRIBUTE_SET_LIST_VALUES);

        $lines = explode(PHP_EOL,$data);

        $this->_attribute_set_list_values = array();

        foreach($lines as $line) {
            list($attribute_set_id,$default_value,$joined_values) = explode(':',$line);
            $values = explode(',',$joined_values);

            $this->_attribute_set_list_values[$attribute_set_id]['selected'] = $default_value;
            $this->_attribute_set_list_values[$attribute_set_id]['values'] = $values;
        }

        if(empty($product_attribute_set_id) && empty($this->_attribute_set_list_values[$product_attribute_set_id])) {
            return FALSE;
        }

        return $this->_attribute_set_list_values[$product_attribute_set_id];

    }


    public function getQuantityOptions($product)
    {

        if($product && $product->getId()) {
            $attributeSetId = $product->getAttributeSetId();
            $quantityOptions = Mage::helper('quantity_dropdown')->getListValuesByAttributeSetId($attributeSetId);
        }

        if(!$quantityOptions) {
            $defaultOptions = Mage::helper('quantity_dropdown')->getDefaultListValuesAsArray();
            $defaultPreselectedValue =  Mage::helper('quantity_dropdown')->getDefaultPreselectedValue();

            $quantityOptions['selected'] = $defaultPreselectedValue;
            $quantityOptions['values'] = $defaultOptions;
        }

        return $quantityOptions;
    }

}
