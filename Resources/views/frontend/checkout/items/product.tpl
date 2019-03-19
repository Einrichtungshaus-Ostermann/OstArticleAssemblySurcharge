
{* file to extend *}
{extends file="parent:frontend/checkout/items/product.tpl"}

{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/checkout/items/product"}



{* append message or checkbox *}
{block name="frontend_checkout_cart_item_details_inline"}

    {* prepend parent *}
    {$smarty.block.parent}

    {* custom block to overwrite *}
    {block name="ost-article-assembly-surcharge--checkout--items-product"}
        {include file="frontend/ost-article-assembly-surcharge/checkout-item.tpl"}
    {/block}

{/block}
