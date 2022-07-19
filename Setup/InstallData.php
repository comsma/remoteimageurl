<?php 

namespace comsma\remoteimageurl\Setup;

use Magento\Framework\Setup\ModuleContextInterface;

use Magento\Framework\Setup\ModuleDataSetupInterface;

use Magento\Framework\Setup\InstallDataInterface;

use Magento\Eav\Setup\EavSetupFactory;




class InstallData implements InstallDataInterface

{

  private $eavSetupFactory;




  public function __construct(EavSetupFactory $eavSetupFactory) {

      $this->eavSetupFactory = $eavSetupFactory;

  }




  public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)

  {




      /**** Attribute names and there data*****/

       /* [atr-Code, atr-group, atr-type, label, input, required,default] */




       $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

       $attributes = [

          ['name' => 'remote_image_url',

              'group' => 'Product Details',

              'type' => 'text',

              'label' => 'Custom Attribute',

              'class' => 'validate-number',

              'input' => 'text',

              'is_used_in_grid' => 1,

              'required' => true,

              'sort_order' => 20],

          /*can duplicate the array for more attributes*/

       ];

      foreach ($attributes as $key => $value) {

          $eavSetup->addAttribute(

              \Magento\Catalog\Model\Product::ENTITY,

              $value['name'],   /* Custom Attribute Code */

               [

                  'group' => $value['group'],/* Group name in which you want to display your custom attribute */

                  'type' => $value['type'],/* Data type in which formate your value save in database*/

                  'backend' => (isset($value['backend'])) ? $value['backend'] : '',

                  'frontend' => '',

                  'label' => $value['label'], /* lablel of your attribute*/

                  'input' => $value['input'],

                  'frontend_class' => ((isset($value['class'])) ? $value['class'] : ''),

                  'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,

                  'visible' => (isset($value['visible'])) ? $value['visible'] : true,

                  'required' => $value['required'],

                  'source' => (isset($value['source'])) ? $value['source'] : '',

                  'option' => (isset($value['option'])) ? $value['option'] : '',

                  'user_defined' => (isset($value['user_defined'])) ? $value['user_defined'] : false,

                  'sort_order' => 50,

                  'default' => (isset($value['default'])) ? $value['default'] : '',

                  'note' => (isset($value['note'])) ? $value['note'] : '',

                  'searchable' => true,

                  'filterable' => true,

                  'comparable' => true,

                  'visible_on_front' => false,

                  'used_in_product_listing' => true,

                  'unique' => false,

                  'is_used_in_grid' => (isset($value['is_used_in_grid'])) ? $value['is_used_in_grid'] : 0,

              ]

          );

      }
  }
}