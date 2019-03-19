
{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/checkout-item"}



{* is this article with assembly? *}
{if $sBasketItem.ostArticleAssemblySurcharge.status == true && ( ( $ostArticleAssemblySurchargeAction == "cart" ) or ( $ostArticleAssemblySurchargeAction == "confirm" ) )}

    {* free assembly?! *}
    {if $sBasketItem.ostArticleAssemblySurcharge.surcharge == 0}

        {* success message *}
        <div class="ost-article-assembly-surchage--fullservice-price alert is--success">{s name="full-service-price"}Vollservicepreis inkl. Lieferung und Montage{/s}</div>

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