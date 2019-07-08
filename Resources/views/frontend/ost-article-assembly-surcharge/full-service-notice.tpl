
{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/full-service-notice"}



{* active for this shop? *}
{if $ostArticleAssemblySurchargeConfiguration.shopStatus == true}

    {* is this article marked as full service? *}
    {if $ostArticleAssemblySurcharge.status == true}

        {* free of charge assembly? *}
        {if $ostArticleAssemblySurcharge.surcharge == 0}

            {* fullservice without charge *}
            <div class="ost-article-assembly-surchage--full-service-notice">
                {s name="notice"}Kostenlose<br>Lieferung &amp; Montage{/s}
            </div>

        {/if}

    {/if}

{/if}
