<script>
    function openCreateModal() {
        $('#createModal').modal('show');
        $('.ui.radio.checkbox').checkbox();
        $('#checkPhase1').checkbox('check');
    }

    function closeCreateModal() {
        $('#createModal').modal('hide');
    }

</script>

<!-- Modal content with form -->
<div id="createModal" class="ui mini modal">
    <i class="close icon" onclick="closeCreateModal()"></i>
    <div class="header">
        Додати тип баку
    </div>
    <div class="content">
        <form id="createForm" class="ui form" method="post" autocomplete="off">
            <div class="inline fields">
                <label>Кількість фаз</label>
                <div class="field">
                    <div id="checkPhase1" class="ui radio checkbox">
                        <input type="radio" id="phase" name="phase" checked="checked" tabindex="0" class="hidden" value="1">
                        <label>1 фаза</label>
                    </div>
                </div>
                <div class="field">
                    <div id="checkPhase3" class="ui radio checkbox">
                        <input type="radio" id="phase" name="phase" tabindex="0" class="hidden" value="3">
                        <label>3 фази</label>
                    </div>
                </div>
            </div>
            <button class="ui green button" type="button" onclick="submitCreateForm()">Submit</button>
        </form>
    </div>
</div>
