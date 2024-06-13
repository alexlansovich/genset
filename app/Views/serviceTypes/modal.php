<script>
    function openCreateModal() {
        $('#createModal').modal('show');
    }

    function closeCreateModal() {
        $('#createModal').modal('hide');
    }

    function submitCreateForm() {
        // Get form data
        //console.log('create');
        const servicetype_name = $('#servicetype_name').val();
        const servicetype_description = $('#servicetype_description').val();

        console.log(servicetype_name, servicetype_description);
        // Validate data
        if (!servicetype_name.trim()) {
            alert('Назва повинна бути вказана.');
            return;
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/ServiceTypes/create',
            data: {
                servicetype_name: servicetype_name,
                servicetype_description: servicetype_description
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the FuelTanks page
                    window.location.assign(window.location.origin + '/ServiceTypes');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
    }

    function openEditModal(fueltank) {
        $('#edit_id').val(fueltank.id);
        $('#edit_servicetype_name').val(fueltank.servicetype_name);
        $('#edit_servicetype_description').val(fueltank.servicetype_description);
        $('#editModal').modal('show');
    }

    function closeEditModal() {
        $('#editModal').modal('hide');
    }

    function submitEditForm() {
        // Retrieve data from form fields
        const id = $('#edit_id').val();
        const servicetype_name = $('#edit_servicetype_name').val();
        const servicetype_description = $('#edit_servicetype_description').val();

        // Validate data
        if (!servicetype_name.trim()) {
            alert('Назва повинна бути вказана.');
            return;
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/ServiceTypes/edit',
            data: {
                id: id,
                servicetype_name: servicetype_name,
                servicetype_description: servicetype_description
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the FuelTanks page
                    window.location.assign(window.location.origin + '/ServiceTypes');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
                //window.location.assign(window.location.origin + '/FuelTanks?success=' + response?.success);
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
        console.log(id, servicetype_name, servicetype_description);
        // Close the edit modal
        closeEditModal();
    }

</script>


<!-- Modal content with form -->
<div id="createModal" class="ui tiny modal">
    <i class="close icon" onclick="closeCreateModal()"></i>
    <div class="header">
        Додати тип сервісу
    </div>
    <div class="content">
        <form id="createForm" class="ui form" method="post" autocomplete="off">
            <div class="field">
                <label>Назва</label>
                <input type="text" id="servicetype_name" name="servicetype_name" maxlength="100" placeholder="Введіть назву" required>
            </div>
            <div class="field">
                <label>Опис</label>
                <input type="text" id="servicetype_description" name="servicetype_description" placeholder="Введіть опис">
            </div>
            <button class="ui green button" type="button" onclick="submitCreateForm()">Submit</button>
        </form>
    </div>
</div>

<!-- Modal content with form for editing an existing FuelTank -->
<div id="editModal" class="ui tiny modal">
    <i class="close icon" onclick="closeEditModal()"></i>
    <div class="header">
        Редагувати тип сервісу
    </div>
    <div class="content">
        <form id="editForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="edit_id" name="edit_id">
            <div class="field">
                <label>Назва</label>
                <input type="text" id="edit_servicetype_name" name="edit_servicetype_name" maxlength="100" placeholder="Введіть назву" required>
            </div>
            <div class="field">
                <label>Опис</label>
                <input type="text" id="edit_servicetype_description" name="edit_servicetype_description" placeholder="Введіть опис">
            </div>
            <button class="ui blue button" type="button" onclick="submitEditForm()">Зберегти зміни</button>
        </form>
    </div>
</div>
