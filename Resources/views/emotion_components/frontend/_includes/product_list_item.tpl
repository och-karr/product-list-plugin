{block name="frontend_common_product_list_item_config"}
    {$productBoxLayout = ($productBoxLayout) ? $productBoxLayout : ""}
    {$fixedImageSize = ($fixedImageSize) ? $fixedImageSize : ""}
{/block}

{block name="frontend_common_product_list_item"}
    <div class="product-list--item">
        {include file="frontend/listing/box_article.tpl" sArticle=$article productBoxLayout=$productBoxLayout fixedImageSize=$fixedImageSize}
    </div>
{/block}