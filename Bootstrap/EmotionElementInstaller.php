<?php

namespace ProductListElement\Bootstrap;

use Shopware\Components\Emotion\ComponentInstaller;

class EmotionElementInstaller
{
    /**
     * @var ComponentInstaller
     */
    private $emotionComponentInstaller;

    /**
     * @var string
     */
    private $pluginName;

    /**
     * @param string $pluginName
     * @param ComponentInstaller $emotionComponentInstaller
     */
    public function __construct($pluginName, ComponentInstaller $emotionComponentInstaller)
    {
        $this->emotionComponentInstaller = $emotionComponentInstaller;
        $this->pluginName = $pluginName;
    }

    public function install()
    {
        $productListElement = $this->emotionComponentInstaller->createOrUpdate(
            $this->pluginName,
            'ProductListElement', //component name
            [
                'name' => 'Product List',
                'xtype' => 'emotion-components-product-list',
                'template' => 'emotion_product_list',
                'cls' => 'emotion-product-list-element', //css class
                'description' => 'Product list element for the shopping worlds.'
            ] //array data
        );

        $productListElement->createTextField([
            'name' => 'product_list_type',
            'fieldLabel' => 'List type',
            'defaultValue' => 'newcomer',
            'allowBlank' => true
        ]);

        $productListElement->createComboBoxField([
            'name' => 'product_list_cat',
            'fieldLabel' => 'Category',
            'supportText' => 'Select category',
            'displayField' => 'name',
            'valueField' => 'id',
            'allowBlank' => false,
            'store' => 'Shopware.apps.Base.store.Category'
        ]);

        $productListElement->createNumberField([
            'name' => 'product_list_max_number',
            'fieldLabel' => 'Maximum number of products',
            'defaultValue' => '25'
        ]);

        $productListElement->createTextField([
            'name' => 'product_list_title',
            'fieldLabel' => 'Title',
            'cls' => 'product-list-title',
            'allowBlank' => true
        ]);
    }
}