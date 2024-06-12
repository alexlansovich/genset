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
        const fueltank_name = $('#fueltank_name').val();
        const fueltank_litres = parseInt($('#fueltank_litres').val());
        const fueltank_description = $('#fueltank_description').val();

        console.log(fueltank_name, fueltank_litres, fueltank_description);
        // Validate data
        if (isNaN(fueltank_litres) || fueltank_litres < 1) {
            alert('Літри мають бути більше нуля.');
            return; // Stop form submission
        }
        if (!fueltank_name.trim()) {
            alert('Назва повинна бути вказана.');
            return;
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/FuelTanks/create',
            data: {
                fueltank_name: fueltank_name,
                fueltank_litres: fueltank_litres,
                fueltank_description: fueltank_description
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the FuelTanks page
                    window.location.assign(window.location.origin + '/FuelTanks');
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
        $('#edit_fueltank_name').val(fueltank.fueltank_name);
        $('#edit_fueltank_litres').val(fueltank.fueltank_litres);
        $('#edit_fueltank_description').val(fueltank.fueltank_description);
        $('#editModal').modal('show');
    }

    function closeEditModal() {
        $('#editModal').modal('hide');
    }

    function submitEditForm() {
        // Retrieve data from form fields
        const id = $('#edit_id').val();
        const fueltank_name = $('#edit_fueltank_name').val();
        const fueltank_litres = parseInt($('#edit_fueltank_litres').val());
        const fueltank_description = $('#edit_fueltank_description').val();

        // Validate data
        if (isNaN(fueltank_litres) || fueltank_litres < 1) {
            alert('Літри мають бути більше нуля.');
            return; // Stop form submission
        }
        if (!fueltank_name.trim()) {
            alert('Назва повинна бути вказана.');
            return;
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/FuelTanks/edit',
            data: {
                id: id,
                fueltank_name: fueltank_name,
                fueltank_litres: fueltank_litres,
                fueltank_description: fueltank_description
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the FuelTanks page
                    window.location.assign(window.location.origin + '/FuelTanks');
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
        console.log(id, fueltank_name, fueltank_litres, fueltank_description);
        // Close the edit modal
        closeEditModal();
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
            <div class="field">
                <label>Назва</label>
                <input type="text" id="fueltank_name" name="fueltank_name" maxlength="30" placeholder="Введіть назву" required>
            </div>
            <div class="field">
                <label>Ємніcть в літрах</label>
                <input type="number" id="fueltank_litres" name="fueltank_litres" placeholder="Введіть літри" required>
            </div>
            <div class="field">
                <label>Опис</label>
                <input type="text" id="fueltank_description" name="fueltank_description" placeholder="Введіть опис">
            </div>
            <button class="ui green button" type="button" onclick="submitCreateForm()">Submit</button>
        </form>
    </div>
</div>

<!-- Modal content with form for editing an existing FuelTank -->
<div id="editModal" class="ui mini modal">
    <i class="close icon" onclick="closeEditModal()"></i>
    <div class="header">
        Редагувати тип баку
    </div>
    <div class="content">
        <form id="editForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="edit_id" name="edit_id">
            <div class="field">
                <label>Назва</label>
                <input type="text" id="edit_fueltank_name" name="edit_fueltank_name" maxlength="30" placeholder="Введіть назву" required>
            </div>
            <div class="field">
                <label>Ємніcть в літрах</label>
                <input type="number" id="edit_fueltank_litres" name="edit_fueltank_litres" placeholder="Введіть літри" required>
            </div>
            <div class="field">
                <label>Опис</label>
                <input type="text" id="edit_fueltank_description" name="edit_fueltank_description" placeholder="Введіть опис">
            </div>
            <button class="ui blue button" type="button" onclick="submitEditForm()">Зберегти зміни</button>
        </form>
    </div>
</div>
