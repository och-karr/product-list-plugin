{block name="widget_emotion_component_product_list"}
    <div class="emotion--product-list panel">

        {* Title *}
        {block name="widget_emotion_component_product_list_title"}
            {if $Data.product_list_title}
                <h3 class="panel--title is--underline product-list--title">
                    {$Data.product_list_title}
                </h3>
            {/if}
        {/block}

        {* Product list content based on the configuration *}
        {block name="widget_emotion_component_product_list_content"}

            {if $Data.product_list_type == 'selected_article' || $Data.products|@count}
                {$articles = $Data.products}
            {/if}

            {include file="frontend/_includes/product_list.tpl"
                articles=$articles
                productListCls="product-list--content"}

        {/block}
    </div>
{/block}