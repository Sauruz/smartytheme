{include file="parts/header.tpl"}    
{include file="parts/menu.tpl"}   

<div class="container content">
    <div class="row">
        <div class="col-md-6">
            <h1>{$page['title']}</h1>
            <hr>
            {$page['content']}
        </div>
        <div class="col-md-6">
        {comments_template()}
        </div>
    </div>
</div>

{include file="parts/footer.tpl"}