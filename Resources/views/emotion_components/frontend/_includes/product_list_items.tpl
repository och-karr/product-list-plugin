{block name="frontend_common_product_list_items"}
    {foreach $articles as $article}
        {include file="frontend/_includes/product_list_item.tpl"}
    {/foreach}
{/block}