<?php
namespace comsma\remoteimageurl\plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product as ProductModel;

class ProductCustAttr
{
     public function afterGet(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $entity
    )
    {
        $product = $entity;
        /** Get Current Extension Attributes from Product */
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setRemoteImageURL(""); // custom field value set
        $product->setExtensionAttributes($extensionAttributes);
        return $product;
    }

    public function afterGetList(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductSearchResultsInterface $searchCriteria
    ) : \Magento\Catalog\Api\Data\ProductSearchResultsInterface
    {
        $products = [];
        foreach ($searchCriteria->getItems() as $entity) {
            /** Get Current Extension Attributes from Product */
            $extensionAttributes = $entity->getExtensionAttributes();
            $extensionAttributes->setRemoteImageURL(""); // custom field value set
            $entity->setExtensionAttributes($extensionAttributes);
            $products[] = $entity;
        }
        $searchCriteria->setItems($products);
        return $searchCriteria;
    }
}