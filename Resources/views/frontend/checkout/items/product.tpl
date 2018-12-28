
{* file to extend *}
{extends file="parent:frontend/checkout/items/product.tpl"}

{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/checkout/items/product"}



{* append message or checkbox *}
{block name="frontend_checkout_cart_item_details_inline"}

    {* prepend parent *}
    {$smarty.block.parent}

    {* is this article with assembly? *}
    {if $sBasketItem.ostArticleAssemblySurcharge.status == true && ( ( $ostArticleAssemblySurchargeAction == "cart" ) or ( $ostArticleAssemblySurchargeAction == "confirm" ) )}

        {* free assembly?! *}
        {if $sBasketItem.ostArticleAssemblySurcharge.surcharge == 0}

            {* success message *}
            <div class="ost-article-assembly-surchage--fullservice-price alert is--success">{s name="full-service"}Vollpreisservice inkl. Lieferung und Montage{/s}</div>

        {else}

            {* form with checkbox for optional assembly *}
            <div style="clear: both;">
                <form method="post" action="{url action='changeQuantity' sTargetAction=$sTargetAction}">
                    <input type="checkbox" class="ost-article-assembly-surcharge--checkbox" name="ost-article-assembly-surcharge--checkbox"{if $sBasketItem.ostArticleAssemblySurcharge.selected == true} checked{/if}/>
                    {s name="optional-assembly"}Montage zzgl. {$sBasketItem.ostArticleAssemblySurcharge.surcharge|currency} pro Stück{/s}
                    <input type="hidden" name="article-id" value="{$sBasketItem.id}" />
                    <input type="hidden" name="article-number" value="{$sBasketItem.ordernumber}" />
                    <input type="hidden" name="ost-article-assembly-surcharge" value="1" />
                </form>
            </div>

        {/if}

    {/if}

{/block}
