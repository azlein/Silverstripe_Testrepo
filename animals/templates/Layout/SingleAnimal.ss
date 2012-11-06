<div class="page-header">
    <h1>$Title.RAW</h1>
</div>
<div class="row-fluid">
    <div class="span3">
        <% include CategoriesBar %>
    </div>
    <div class="span9 typography">
        <% control $animal %>
            <div class="singleAnimal ">
                <div class="row">
                    <div class="span5">
                        <img src="$ProfilePic.setWidth(250).URL"/>
                    </div>
                    <div class="span5">
                        <h2>$Name</h2>
                        <p><b>Alter:</b> $Age</p>
                        <p><b>Geschlecht:</b> $Gender</p>
                        <p><b>Rasse:</b>$Race</p>
                        <p><b>Kontakt:</b> $Contact</p>

                    </div>
                </div>
                <div class="row">
                    <div class="span9">
                        <p class="animal-description">$Description</p>
                    </div>
                </div>
                <div class="row">
                    <div class="span9">
                        <ul class="thumbnails" style="list-style: none;">
                            <li class="span2">
                                <a class="thumbnail fancybox-thumb"href="$ProfilePic.URL"rel="fancybox-thumb">
                                   <img src="$ProfilePic.setWidth(200).URL"/>
                                </a>
                            </li>

                            <% loop $OtherPics %>
                                <li class="span2">
                                    <a class="thumbnail fancybox-thumb"href="$URL"rel="fancybox-thumb">
                                        <img src="$setWidth(200).URL"/>
                                    </a>
                                </li>
                            <% end_loop %>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $(".fancybox-thumb").fancybox({
                                openEffect:"none",
                                closeEffect:"none"
                            });
                        });

                    </script>
                </div>
            </div>
        <% end_control %>

    </div>
</div>
