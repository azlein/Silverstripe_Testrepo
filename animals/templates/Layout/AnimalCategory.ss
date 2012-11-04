
<div class="page-header">
    <h1>$Title.RAW</h1>
</div>

<div class="row-fluid">
    <div class="span3">
        <% include CategoriesBar %>
    </div>
    <div class="span9 typography">
        <% control $category %>
            <% loop Animals %>
                <div class=" row animal">
                    <div class="span2">
                        <img src="$ProfilePic.setWidth(100).URL"/>
                    </div>
                    <div class="span2">
                        <a  href="{$Top.Top.Link}{$category.Name}/{$ID}">$Name</a>
                        <p >Alter:$Age</p>
                    </div>
                    <div class="span9" >
                        <p> <a href="{$Top.Top.Link}{$category.Name}/{$ID}">Mehr Informatin</a></p>
                    </div>
                </div>
            <% end_loop %>
        <% end_control %>
    </div>

</div>