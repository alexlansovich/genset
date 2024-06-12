<script>
    function openCreateModal() {
        $('#createModal').modal('show');
        $('.ui.radio.checkbox').checkbox();
    }

    function closeCreateModal() {
        $('#createModal').modal('hide');
    }

    function submitCreateForm() {
        // Get form data
        //console.log('create');
        const type_name = $('#type_name').val();
        const type_description = $('#type_description').val();
        const litresPerHour = parseFloat($('#litresPerHour').val());
        const powerKva = parseFloat($('#powerKva').val());
        const powerKw = parseFloat($('#powerKw').val());
        const phase = parseInt($('#phase:checked').val());
        const serviceParameters = $('#serviceParameters').val();
        console.log(type_name, type_description, litresPerHour, phase, serviceParameters);
        // Validate data
        if (isNaN(litresPerHour) || litresPerHour < 1) {
            alert('Літри мають бути більше нуля.');
            return; // Stop form submission
        }
        if (!type_name.trim()) {
            alert('Назва повинна бути вказана.');
            return;
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/GenTypes/create',
            data: {
                type_name: type_name,
                type_description: type_description,
                litresPerHour: litresPerHour,
                phase: phase,
                powerKva: powerKva,
                powerKw: powerKw,
                serviceParameters: serviceParameters
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the BakTypes page
                    window.location.assign(window.location.origin + '/GenTypes');
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

    function openEditModal(gentype) {
        $('#edit_id').val(gentype.id);
        $('#edit_type_name').val(gentype.type_name);
        $('#edit_type_description').val(gentype.type_description);
        $('#edit_litresPerHour').val(gentype.litresPerHour);
        $('#edit_powerKva').val(gentype.powerKva);
        $('#edit_powerKw').val(gentype.powerKw);
        $('#edit_serviceParameters').val(gentype.serviceParameters);
        $('#editModal').modal('show');
        $('.ui.radio.checkbox').checkbox();
        // Set the checked state based on the value
        const phase = gentype.phase;
        const checkboxSelector = phase === '1' ? '#edit_phaseBox1' : '#edit_phaseBox3';
        $(checkboxSelector).checkbox('check');
    }

    function closeEditModal() {
        $('#editModal').modal('hide');
    }

    function submitEditForm() {
        // Retrieve data from form fields
        const id = $('#edit_id').val();
        const type_name = $('#edit_type_name').val();
        const type_description = $('#edit_type_description').val();
        const litresPerHour = parseFloat($('#edit_litresPerHour').val());
        const powerKva = parseFloat($('#edit_powerKva').val());
        const powerKw = parseFloat($('#edit_powerKw').val());
        const phase = parseInt($('#edit_phase:checked').val());
        const serviceParameters = $('#edit_serviceParameters').val();
        console.log(type_name, type_description, litresPerHour, phase, serviceParameters);
        // Validate data
        if (!type_name.trim()) {
            alert('Назва повинна бути вказана.');
            return;
        }
        if (isNaN(litresPerHour) || litresPerHour < 1) {
            alert('Літри мають бути більше нуля.');
            return; // Stop form submission
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/GenTypes/edit',
            data: {
                id: id,
                type_name: type_name,
                type_description: type_description,
                litresPerHour: litresPerHour,
                phase: phase,
                powerKva: powerKva,
                powerKw: powerKw,
                serviceParameters: serviceParameters
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the GenTypes page
                    window.location.assign(window.location.origin + '/GenTypes');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
                //window.location.assign(window.location.origin + '/GenTypes?success=' + response?.success);
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
        console.log(type_name, type_description, litresPerHour, phase, serviceParameters);
        // Close the edit modal
        closeEditModal();
    }

</script>


<!-- Modal content with form -->
<div id="createModal" class="ui mini modal">
    <i class="close icon" onclick="closeCreateModal()"></i>
    <div class="header">
        Додати тип генератору
    </div>
    <div class="content">
        <form id="createForm" class="ui form" method="post" autocomplete="off">
            <div class="field">
                <label>Назва</label>
                <input type="text" id="type_name" name="type_name" maxlength="30" placeholder="Введіть назву" required>
            </div>
            <div class="field">
                <label>Опис</label>
                <input type="text" id="type_description" name="type_description" maxlength="300" placeholder="Введіть опис">
            </div>
            <div class="field">
                <label>Споживання за годину в літрах</label>
                <input type="number" id="litresPerHour" name="litresPerHour" placeholder="Введіть літри" required step="any">
            </div>
            <div class="inline fields">
                <label>Кількість фаз</label>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" id="phase" name="phase" checked="checked" tabindex="0" class="hidden" value="1">
                        <label>1 фаза</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" id="phase" name="phase" tabindex="0" class="hidden" value="3">
                        <label>3 фази</label>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Потужність у Kva</label>
                <input type="number" id="powerKva" name="powerKva" placeholder="Введіть" required step="any">
            </div>
            <div class="field">
                <label>Потужність у Kw</label>
                <input type="number" id="powerKw" name="powerKw" placeholder="Введіть" required step="any">
            </div>
            <div class="field">
                <label>Параметри сервісу</label>
                <input type="text" id="serviceParameters" name="serviceParameters" maxlength="300" placeholder="Введіть назву">
            </div>
            <button class="ui green button" type="button" onclick="submitCreateForm()">Submit</button>
        </form>
    </div>
</div>

<!-- Modal content with form for editing an existing BackType -->
<div id="editModal" class="ui mini modal">
    <i class="close icon" onclick="closeEditModal()"></i>
    <div class="header">
        Редагувати тип генератору
    </div>
    <div class="content">
        <form id="editForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="edit_id" name="edit_id">
            <div class="field">
                <label>Назва</label>
                <input type="text" id="edit_type_name" name="edit_type_name" maxlength="30" placeholder="Введіть назву" required>
            </div>
            <div class="field">
                <label>Опис</label>
                <input type="text" id="edit_type_description" name="edit_type_description" maxlength="300" placeholder="Введіть опис">
            </div>
            <div class="field">
                <label>Споживання за годину в літрах</label>
                <input type="number" id="edit_litresPerHour" name="edit_litresPerHour" placeholder="Введіть літри" required>
            </div>
            <div class="inline fields">
                <label>Кількість фаз</label>
                <div class="field">
                    <div id="edit_phaseBox1" class="ui radio checkbox">
                        <input type="radio" id="edit_phase" name="edit_phase" tabindex="0" class="hidden" value="1">
                        <label>1 фаза</label>
                    </div>
                </div>
                <div class="field">
                    <div id="edit_phaseBox3" class="ui radio checkbox">
                        <input type="radio" id="edit_phase" name="edit_phase" tabindex="0" class="hidden" value="3">
                        <label>3 фази</label>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Потужність у Kva</label>
                <input type="number" id="edit_powerKva" name="edit_powerKva" placeholder="Введіть" required step="any">
            </div>
            <div class="field">
                <label>Потужність у Kw</label>
                <input type="number" id="edit_powerKw" name="edit_powerKw" placeholder="Введіть" required step="any">
            </div>
            <div class="field">
                <label>Параметри сервісу</label>
                <input type="text" id="edit_serviceParameters" name="edit_serviceParameters" maxlength="300" placeholder="Введіть назву">
            </div>
            <button class="ui blue button" type="button" onclick="submitEditForm()">Зберегти зміни</button>
        </form>
    </div>
</div>
