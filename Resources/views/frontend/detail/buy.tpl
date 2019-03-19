
{* file to extend *}
{extends file="parent:frontend/detail/buy.tpl"}

{* set namespace *}
{namespace name="frontend/ost-article-assembly-surcharge/detail/buy"}



{* append message or checkbox after buybox*}
{block name="frontend_detail_buy_button_container"}

    {* prepend parent *}
    {$smarty.block.parent}

    {* custom block to overwrite *}
    {block name="ost-article-assembly-surcharge--detail--index"}
        {include file="frontend/ost-article-assembly-surcharge/article-details.tpl"}
    {/block}

{/block}
