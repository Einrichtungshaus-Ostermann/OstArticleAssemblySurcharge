
{* file to extend *}
{extends file="parent:frontend/detail/buy.tpl"}

{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/detail/buy"}




{block name="frontend_detail_buy_button_container"}


    {$smarty.block.parent}




    {* active for this shop? *}
    {if $ostArticleAssemblySurchargeConfiguration.shopStatus == true}


        {* is this article marked as full service? *}
        {if $ostArticleAssemblySurcharge.status == true}


            {* free of charge assembly? *}
            {if $ostArticleAssemblySurcharge.surcharge == 0}

                <div style="background-color: green; color: white;">Vollpreisservice inkl. Lieferung und Montage</div>


            {else}


                <input type="checkbox" name="ost-article-assembly-surcharge" class="ost-article-assembly-surcharge--checkbox" />

                Montage zzgl. {$ostArticleAssemblySurcharge.surcharge|currency} pro Stück


            {/if}


        {/if}



    {/if}





{/block}

