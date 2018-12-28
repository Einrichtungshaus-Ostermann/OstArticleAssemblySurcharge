
{* file to extend *}
{extends file="parent:frontend/detail/buy.tpl"}

{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/detail/buy"}



{* append message or checkbox after buybox*}
{block name="frontend_detail_buy_button_container"}

    {* prepend parent *}
    {$smarty.block.parent}

    {* active for this shop? *}
    {if $ostArticleAssemblySurchargeConfiguration.shopStatus == true}

        {* is this article marked as full service? *}
        {if $ostArticleAssemblySurcharge.status == true}

            {* free of charge assembly? *}
            {if $ostArticleAssemblySurcharge.surcharge == 0}

                {* fullservice without charge *}
                <div class="ost-article-assembly-surchage--fullservice-price alert is--success">
                    {s name="full-service"}Vollpreisservice inkl. Lieferung und Montage{/s}
                </div>

            {else}

                {* optional checkbox *}
                <div class="ost-article-assembly-surchage--fullservice-checkbox alert is--info">
                    <input type="checkbox" name="ost-article-assembly-surcharge" class="ost-article-assembly-surcharge--checkbox" />
                    {s name="optional-assembly"}Montage zzgl. {$ostArticleAssemblySurcharge.surcharge|currency} pro Stück{/s}
                </div>

            {/if}

        {/if}

    {/if}

{/block}
