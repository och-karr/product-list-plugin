{* Config *}
{block name="frontend_common_product_list_config"}
    {$productListCls = ($productListCls)?$productListCls:""}
    {$productBoxLayout = ($productBoxLayout)?$productBoxLayout:"emotion"}
    {$fixedImageSize = ($fixedImageSize)?$fixedImageSize:""}
{/block}

{* Template *}
{block name="frontend_common_product_list_component"}
    <div class="product-list {$productListCls}">

        {block name="frontend_common_product_list_container"}
            <div class="product-list--container">
                {include file="frontend/_includes/product_list_items.tpl" articles=$articles}
            </div>
        {/block}
        <span class="paging-info"></span>

    </div>
{/block}