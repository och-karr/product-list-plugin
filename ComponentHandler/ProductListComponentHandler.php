<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace ProductListElement\ComponentHandler;

use Shopware\Components\Compatibility\LegacyStructConverter;
use Shopware\Bundle\EmotionBundle\Service\StructConverter;
use Shopware\Bundle\EmotionBundle\ComponentHandler\ComponentHandlerInterface;
use Shopware\Bundle\EmotionBundle\Struct\Collection\PrepareDataCollection;
use Shopware\Bundle\EmotionBundle\Struct\Collection\ResolvedDataCollection;
use Shopware\Bundle\EmotionBundle\Struct\Element;
use Shopware\Bundle\SearchBundle\Sorting\PopularitySorting;
use Shopware\Bundle\SearchBundle\Sorting\PriceSorting;
use Shopware\Bundle\SearchBundle\Sorting\RandomSorting;
use Shopware\Bundle\SearchBundle\Sorting\ReleaseDateSorting;
use Shopware\Bundle\SearchBundle\SortingInterface;
use Shopware\Bundle\SearchBundle\StoreFrontCriteriaFactoryInterface;
use Shopware\Bundle\StoreFrontBundle\Service\AdditionalTextServiceInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ListProduct;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;
use Shopware\Components\ProductStream\RepositoryInterface;
use Shopware_Components_Config as ShopwareConfig;

class ProductListComponentHandler implements ComponentHandlerInterface
{
    const TYPE_NEWCOMER = 'newcomer';

    const COMPONENT_NAME = 'emotion-components-product-list';

    private $converter;

    /**
     * @var StoreFrontCriteriaFactoryInterface
     */
    private $criteriaFactory;

    /**
     * @var RepositoryInterface
     */
    private $productStreamRepository;

    /**
     * @var ShopwareConfig
     */
    private $shopwareConfig;

    /**
     * @var AdditionalTextServiceInterface
     */
    private $additionalTextService;

    /**
     * @param StoreFrontCriteriaFactoryInterface $criteriaFactory
     * @param RepositoryInterface                $productStreamRepository
     * @param ShopwareConfig                     $shopwareConfig
     * @param AdditionalTextServiceInterface     $additionalTextService
     */
    public function __construct(
        LegacyStructConverter $converter,
        StoreFrontCriteriaFactoryInterface $criteriaFactory,
        RepositoryInterface $productStreamRepository,
        ShopwareConfig $shopwareConfig,
        AdditionalTextServiceInterface $additionalTextService
    ) {
        $this->converter = $converter;
        $this->criteriaFactory = $criteriaFactory;
        $this->productStreamRepository = $productStreamRepository;
        $this->shopwareConfig = $shopwareConfig;
        $this->additionalTextService = $additionalTextService;
    }


    /**
     * {@inheritdoc}
     */
    public function supports(Element $element)
    {
        $component = $element->getComponent();

        return $component->getType() === self::COMPONENT_NAME;
    }

    /**
     * {@inheritdoc}
     */

    //The prepare step collects product numbers or criteria objects which will be resolved across all elements at once.
    public function prepare(PrepareDataCollection $collection, Element $element, ShopContextInterface $context)
    {

        $key = 'emotion-element--' . $element->getId();


        $criteria = $this->generateCriteria($element, $context);

        // request multiple products by criteria
        $collection->getBatchRequest()->setCriteria($key, $criteria);

    }

    /**
     * {@inheritdoc}
     */

    //The handle step provides a collection with resolved products and can be filled into your element.
    public function handle(ResolvedDataCollection $collection, Element $element, ShopContextInterface $context)
    {
        //Keep in mind to use a unique key for requesting and getting products. For best practise, use the element's id in your key ($element->getId()).
        $key = 'emotion-element--' . $element->getId();


        $requestedProducts = $collection->getBatchResult()->get($key);
        $requestedProductsConverted = $this->converter->convertListProductStructList($requestedProducts);

        $element->getData()->set('products', $requestedProductsConverted); //ok

    }

    /**
     * @param ListProduct $product
     */
    private function switchPrice(ListProduct $product)
    {
        $prices = array_values($product->getPrices());
        $product->setListingPrice($prices[0]);

        $product->setDisplayFromPrice(count($product->getPrices()) > 1);

        if ($this->shopwareConfig->get('useLastGraduationForCheapestPrice')) {
            $product->setListingPrice(
                $prices[count($prices) - 1]
            );
        }
    }

    /**
     * @param Element              $element
     * @param ShopContextInterface $context
     *
     * @return \Shopware\Bundle\SearchBundle\Criteria
     */
    private function generateCriteria(Element $element, ShopContextInterface $context)
    {

        $limit = (int) $element->getConfig()->get('product_list_max_number');
        $categoryId = (int) $element->getConfig()->get('product_list_cat');

        $criteria = $this->criteriaFactory->createBaseCriteria([$categoryId], $context);
        $criteria->limit($limit);


        $criteria->addSorting(new ReleaseDateSorting(SortingInterface::SORT_DESC));


        return $criteria;
    }
}
