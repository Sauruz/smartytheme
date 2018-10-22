{include file="parts/header.tpl"}    
{include file="parts/menu.tpl"}   

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>{$page['title']}</h1>
            {$page['content']}
        </div>
    </div>
</div>

{include file="parts/footer.tpl"}