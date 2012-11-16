<form $FormAttributes>
<legend><% _t('AnimalSearchForm.LEGEND', 'Animal Search') %></legend>

<% if Message %>
<p id="{$FormName}_error" class="message $MessageType">$Message</p>
<% else %>
<p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
<% end_if %>

    <fieldset>
        $Fields.dataFieldByName(Hidden)
            <div class="control-group">
                <label class="control-label"><% _t('Animals.NAME','Name') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Name)
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"><% _t('Animals.CATEGORY', 'Category') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Category)
                </div>

            </div>
            <div class="control-group">
                <label class="control-label"><% _t('Animals.COLOR', 'Color') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Color)
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"><% _t('Animals.RACE', 'Race') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Race)
                </div>
            </div>
    </fieldset>
    <% if Actions %>
    <div class="Actions control-group">
        <div class="controls controls-row">
            <% loop Actions %>$Field<% end_loop %>
        </div>
    </div>
    <% end_if %>
</form>