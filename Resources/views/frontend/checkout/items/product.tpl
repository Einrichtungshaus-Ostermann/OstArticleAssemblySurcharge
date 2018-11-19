
{* file to extend *}
{extends file="parent:frontend/checkout/items/product.tpl"}

{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/checkout/items/product"}





{block name="frontend_checkout_cart_item_details_inline"}


    {$smarty.block.parent}




    {if $sBasketItem.ostArticleAssemblySurcharge.status == true && ( ( $ostArticleAssemblySurchargeAction == "cart" ) or ( $ostArticleAssemblySurchargeAction == "confirm" ) )}


    {if $sBasketItem.ostArticleAssemblySurcharge.surcharge == 0}

        <div class="ost-article-assembly-surchage--fullservice-price" style="clear: both; background-color: green; color: white;">Vollpreisservice inkl. Lieferung und Montage</div>

        {else}


<div style="clear: both;">


    <form method="post" action="{url action='changeQuantity' sTargetAction=$sTargetAction}">


        <input type="checkbox" class="ost-article-assembly-surcharge--checkbox" name="ost-article-assembly-surcharge--checkbox"{if $sBasketItem.ostArticleAssemblySurcharge.selected == true} checked{/if}/>

        Montage zzgl. {$sBasketItem.ostArticleAssemblySurcharge.surcharge|currency} pro Stück




        <input type="hidden" name="article-id" value="{$sBasketItem.id}" />
        <input type="hidden" name="article-number" value="{$sBasketItem.ordernumber}" />
        <input type="hidden" name="ost-article-assembly-surcharge" value="1" />
    </form>


</div>
    {/if}



    {/if}





{/block}

