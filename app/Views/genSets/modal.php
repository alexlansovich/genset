<script>
    function openCreateModal() {
        $('#createModal').modal('show');
        $.ajax({
            url: '/api/genTypes',
            success: function(data) {
                // Set dropdown Items
                $('#genTypes')
                    .dropdown({
                        placeholder: 'Виберіть тип генератора',
                        values: json2dropdown(data, 'type_name', 'id')
                    })
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error occurred while fetching generator types:', error);
            }
        });
        $.ajax({
            url: '/api/fuelTanks',
            success: function(data) {
                // Set dropdown Items
                $('#fuelTanks')
                    .dropdown({
                        placeholder: 'Виберіть тип бака генератора',
                        values: json2dropdown(data, 'fueltank_name', 'id')
                    })
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error occurred while fetching back types:', error);
            }
        });
    }

    function closeCreateModal() {
        $('#createModal').modal('hide');
    }

    function submitCreateForm() {
        // Get form data
        //console.log('create');
        const city = $('#city').val();
        const address = $('#address').val();
        const genTypeId = $('#genTypeId').val();
        const fuelTankId = $('#fuelTankId').val();
        console.log(city, address, genTypeId, fuelTankId);
        // Validate data
        if (!city.trim()) {
            alert('Місто повинне бути вказане.');
            return;
        }
        if (!address.trim()) {
            alert('Адреса повинна бути вказана.');
            return;
        }
        if (!genTypeId.trim()) {
            alert('Тип генератору має бути вказаний.');
            return;
        }
        if (!fuelTankId.trim()) {
            alert('Тип баку має бути вказаний.');
            return;
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/GenSets/create',
            data: {
                city: city,
                address: address,
                genTypeId: genTypeId,
                fuelTankId: fuelTankId
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the fuelTanks page
                    window.location.assign(window.location.origin + '/');
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

    function openEditModal(genset) {
        $('#edit_genId').val(genset.genId);
        //$('#edit_city').JSON.stringify(genset.city);
        $('#edit_city').val(genset.city);
        $('#edit_address').val(genset.address);
        $('#edit_genTypeId').val(genset.genTypeId);
        $('#edit_fuelTankId').val(genset.fuelTankId);
        $('#editModal').modal('show');
        //console.log(genset);
        console.log();
        $.ajax({
            url: '/api/genTypes',
            success: function(data) {
                // Set dropdown Items
                $('#genTypes_edit')
                    .dropdown({
                        placeholder: 'Виберіть тип генератора',
                        values: json2dropdown(data, 'type_name', 'id'),

                    })
                    .dropdown('set selected', genset.genTypeId);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error occurred while fetching generator types:', error);
            }
        });
        $.ajax({
            url: '/api/fuelTanks',
            success: function(data) {
                // Set dropdown Items
                $('#fuelTanks_edit')
                    .dropdown({
                        placeholder: 'Виберіть тип бака генератора',
                        values: json2dropdown(data, 'fueltank_name', 'id')
                    })
                    .dropdown('set selected', genset.fuelTankId);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error occurred while fetching back types:', error);
            }
        });
    }

    function closeEditModal() {
        $('#editModal').modal('hide');
    }

    function submitEditForm() {
        // Retrieve data from form fields
        const genId = $('#edit_genId').val();
        const city = $('#edit_city').val();
        const address = $('#edit_address').val();
        const genTypeId = $('#edit_genTypeId').val();
        const fuelTankId = $('#edit_fuelTankId').val();
        console.log(genTypeId, fuelTankId);
        // Validate data
        if (!city.trim()) {
            alert('Місто повинне бути вказане.');
            return;
        }
        if (!address.trim()) {
            alert('Адреса повинна бути вказана.');
            return;
        }
        if (!genTypeId.trim()) {
            alert('Тип генератору має бути вказаний.');
            return;
        }
        if (!fuelTankId.trim()) {
            alert('Тип баку має бути вказаний.');
            return;
        }
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/GenSets/edit',
            data: {
                genId: genId,
                city: city,
                address: address,
                genTypeId: genTypeId,
                fuelTankId: fuelTankId
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeCreateModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the fuelTanks page
                    window.location.assign(window.location.origin + '/');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
                //window.location.assign(window.location.origin + '/fuelTanks?success=' + response?.success);
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
        //console.log(genId, city, address, genTypeId, fuelTankId);
        // Close the edit modal
        closeEditModal();
    }

    function openRefuelModal(genset) {
        $('#refuelGenId').val(genset.genId);
        $('#refuelGenLitres').val(genset.genLitres);
        $('#refuelGenAdressFull').text(genset.city+', '+genset.address);
        $('#refuelLitresAfter').val(genset.fueltank_litres);
        $('#refuelGenFueltankName').text('Стало літрів (ємність '+genset.fueltank_name+')');
        //console.log(genset);
        $('#refuelModal').modal('show');
        $('#refuel_calendar')
            .calendar({
                initialDate: new Date(),
                today: true,
                firstDayOfWeek: 1,
                formatter: {
                    datetime: 'D MMMM YYYY H:mm',
                    time: 'H:mm',
                    cellTime: 'H:mm'
                },
                text: {
                    days: ['НД', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'],
                    dayNamesShort: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    dayNames: ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'Пятниця', 'Субота'],
                    months: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                    monthsShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
                    now: 'Поточна дата/час',
                }
            });

    }

    function closeRefuelModal() {
        $('#refuelModal').modal('hide');
    }

    function submitRefuelForm() {
        // Retrieve data from form fields
        const refuelGenId = $('#refuelGenId').val();
        const refuelDate = $('#refuelDate').val();
        const refuelLitres = $('#refuelLitres').val();
        const refuelLitresBefore = $('#refuelGenLitres').val();
        const refuelLitresAfter = $('#refuelLitresAfter').val();
        //console.log(refuelGenId, refuelDate, refuelLitres, refuelLitresBefore, refuelLitresAfter);
        // Validate data
        if (!isCorrectUAFormat(refuelDate)) {
            alert('Дата вказано не вірно.');
            return;
        }
        if (isNaN(refuelLitres) || refuelLitres < 1) {
            alert('Літри мають бути більше нуля.');
            return; // Stop form submission
        }
        if (isNaN(refuelLitresAfter) || refuelLitresAfter < 1) {
            alert('Літри мають бути більше нуля.');
            return; // Stop form submission
        }
        const date = parseUkrainianDateTime(refuelDate);
        // Get the Unix time (in seconds)
        const unixTime = date.getTime() / 1000;
        //console.log(unixTime);
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/Refuels/create',
            data: {
                refuelGenId: refuelGenId,
                refuelDate: unixTime,
                refuelLitres: refuelLitres,
                refuelLitresBefore: refuelLitresBefore,
                refuelLitresAfter: refuelLitresAfter
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeRefuelModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the fuelTanks page
                    window.location.assign(window.location.origin + '/');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
                //window.location.assign(window.location.origin + '/fuelTanks?success=' + response?.success);
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
        //console.log(genId, city, address, genTypeId, fuelTankId);
        // Close the edit modal
        closeRefuelModal();
    }

    function openServiceModal(genset) {
        $('#serviceGenId').val(genset.genId);
        $('#serviceGenAdressFull').text(genset.city+', '+genset.address);
        $.ajax({
            url: '/api/serviceTypes',
            success: function(data) {
                // Set dropdown Items
                $('#serviceTypes')
                    .dropdown({
                        placeholder: 'Виберіть тип сервісу',
                        values: json2dropdown(data, 'servicetype_name', 'id'),
                    })
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error occurred while fetching service types:', error);
            }
        });
        $('#serviceModal').modal('show');
        $('#service_calendar')
            .calendar({
                initialDate: new Date(),
                today: true,
                firstDayOfWeek: 1,
                formatter: {
                    datetime: 'D MMMM YYYY H:mm',
                    time: 'H:mm',
                    cellTime: 'H:mm'
                },
                text: {
                    days: ['НД', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'],
                    dayNamesShort: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    dayNames: ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'Пятниця', 'Субота'],
                    months: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                    monthsShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
                    now: 'Поточна дата/час',
                }
            });
    }

    function closeServiceModal() {
        $('#serviceModal').modal('hide');
    }

    function submitServiceForm() {
        // Retrieve data from form fields
        const serviceGenId = $('#serviceGenId').val();
        const serviceDate = $('#serviceDate').val();
        const serviceWorks = $('#serviceTypeId').val().split(',');
        //const serviceWorks = $('#serviceTypeId').val().split(',').map(Number);
        const serviceDesc = $('#serviceDesc').val();
        console.log(serviceWorks, serviceDesc); // Output the array to the console
        // Validate data
        if (!isCorrectUAFormat(serviceDate)) {
            alert('Дата вказано не вірно.');
            return;
        }
        if (serviceWorks < 1) {
            alert('Роботи мають бути вказані.');
            return; // Stop form submission
        }
        const date = parseUkrainianDateTime(serviceDate);
        // Get the Unix time (in seconds)
        const unixTime = date.getTime() / 1000;
        //console.log(serviceWorks);
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/Services/create',
            data: {
                serviceGenId: serviceGenId,
                serviceDate: unixTime,
                serviceWorks: serviceWorks,
                serviceDesc: serviceDesc,
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeServiceModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the fuelTanks page
                    window.location.assign(window.location.origin + '/');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
                //window.location.assign(window.location.origin + '/fuelTanks?success=' + response?.success);
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
        //console.log(genId, city, address, genTypeId, fuelTankId);
        // Close the edit modal
        closeServiceModal();
    }

    function openRunModal(genset) {
        $('#runGenId').val(genset.genId);
        $('#runModal').modal('show');
        $('#runGenAdressFull').text(genset.city+', '+genset.address);
        $('.ui.radio.checkbox').checkbox();
        $('#typeAvaria').checkbox('check');
        $('#typeRun').checkbox('check');

        $('#start_calendar')
            .calendar({
                initialDate: new Date(),
                today: true,
                firstDayOfWeek: 1,
                formatter: {
                    datetime: 'D MMMM YYYY H:mm',
                    time: 'H:mm',
                    cellTime: 'H:mm'
                },
                text: {
                    days: ['НД', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'],
                    dayNamesShort: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    dayNames: ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'Пятниця', 'Субота'],
                    months: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                    monthsShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
                    now: 'Поточна дата/час',
                }
            });
    }

    function closeRunModal() {
        $('#runModal').modal('hide');

    }

    function submitRunForm() {
        // Retrieve data from form fields
        const runGenId = $('#runGenId').val();
        const runStartDate = $('#runStartDate').val();
        const runType = $('#runType:checked').val();
        const runResult = $('#runResult:checked').val();
        console.log(runGenId, runStartDate, runType, runResult);
        // Validate data
        if (!isCorrectUAFormat(runStartDate)) {
            alert('Дата вказано не вірно.');
            return;
        }
        const date = parseUkrainianDateTime(runStartDate);
        // Get the Unix time (in seconds)
        const unixTime = date.getTime() / 1000;
        //console.log(unixTime);
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/Runs/start',
            data: {
                runGenId: runGenId,
                runStartDate: unixTime,
                runType: runType,
                runResult: runResult
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeRunModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the fuelTanks page
                    window.location.assign(window.location.origin + '/');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
                //window.location.assign(window.location.origin + '/fuelTanks?success=' + response?.success);
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
        //console.log(genId, city, address, genTypeId, fuelTankId);
        // Close the edit modal
        closeRunModal();
    }

    function openStopModal(genset) {
        $('#stopGenId').val(genset.genId);
        $('#stopGenAdressFull').text(genset.city+', '+genset.address);
        $.ajax({
            url: '/api/genRunning/' + genset.genId,
            success: function(data) {
                // Set startData
                $('#stopRunStartDate').val(data.startDate);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error occurred while fetching runnig:', error);
            }
        });
        $('#stopModal').modal('show');

        $('#stop_calendar')
            .calendar({
                initialDate: new Date(),
                today: true,
                firstDayOfWeek: 1,
                formatter: {
                    datetime: 'D MMMM YYYY H:mm',
                    time: 'H:mm',
                    cellTime: 'H:mm'
                },
                text: {
                    days: ['НД', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'],
                    dayNamesShort: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    dayNames: ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'Пятниця', 'Субота'],
                    months: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                    monthsShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
                    now: 'Поточна дата/час',
                }
            });
    }

    function closeStopModal() {
        $('#stopModal').modal('hide');

    }

    function submitStopForm() {
        // Retrieve data from form fields
        const stopGenId = $('#stopGenId').val();
        const stopRunStartDate = $('#stopRunStartDate').val();
        const runStopDate = $('#runStopDate').val();
        console.log(stopGenId, runStopDate, stopRunStartDate);
        // Validate data
        if (!isCorrectUAFormat(runStopDate)) {
            alert('Дата вказано не вірно.');
            return;
        }
        const date = parseUkrainianDateTime(runStopDate);
        // Get the Unix time (in seconds)
        const unixTime = date.getTime() / 1000;
        //console.log(stopGenId, runStopDate, stopRunStartDate);
        if (stopRunStartDate > unixTime) {
            alert('Дата не може бути меньше запуску.');
            return;
        }
        //console.log(unixTime);
        // Post form data to the specified URL
        $.ajax({
            type: 'post',
            url: window.location.origin + '/Runs/stop',
            data: {
                stopGenId: stopGenId,
                runStopDate: unixTime,
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                closeStopModal();
                // Check if the form submission was successful
                if (response && response.success) {
                    // Redirect to the fuelTanks page
                    window.location.assign(window.location.origin);
                    //window.location.assign(window.location.origin + '/');
                } else {
                    // Handle case where form submission was not successful
                    console.error('Form submission failed');
                }
                //window.location.assign(window.location.origin + '/fuelTanks?success=' + response?.success);
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
        //console.log(genId, city, address, genTypeId, fuelTankId);
        // Close the edit modal
        closeStopModal();
    }
</script>

<!-- Modal content with form -->
<div id="createModal" class="ui mini modal">
    <i class="close icon" onclick="closeCreateModal()"></i>
    <div class="header">
        Додати генератор
    </div>
    <div class="content">
        <form id="createForm" class="ui form" method="post" autocomplete="off">
            <div class="field">
                <label>Місто</label>
                <input type="text" id="city" name="city" maxlength="30" placeholder="Введіть місто" required>
            </div>
            <div class="field">
                <label>Адреса</label>
                <input type="text" id="address" name="address" placeholder="Введіть адресу" required>
            </div>
            <div class="field">
                <label>Тип генератора</label>
                <div id="genTypes" class="ui selection dropdown">
                    <input type="hidden" id="genTypeId" name="genTypeId">
                    <i class="dropdown icon"></i>
                    <div class="default text"></div>
                    <div class="menu">
                        <!-- Dropdown items will be populated here dynamically -->
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Тип бака генератора</label>
                <div id="fuelTanks" class="ui selection dropdown">
                    <input type="hidden" id="fuelTankId" name="fuelTankId">
                    <i class="dropdown icon"></i>
                    <div class="default text"></div>
                    <div class="menu">
                        <!-- Dropdown items will be populated here dynamically -->
                    </div>
                </div>
            </div>
            <button class="ui green button" type="button" onclick="submitCreateForm()">Submit</button>
        </form>
    </div>
</div>

<!-- Modal content with form for editing an existing fuelTank -->
<div id="editModal" class="ui mini modal">
    <i class="close icon" onclick="closeEditModal()"></i>
    <div class="header">
        Редагувати генератор
    </div>
    <div class="content">
        <form id="editForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="edit_genId" name="edit_genId">
            <div class="field">
                <label>Місто</label>
                <input type="text" id="edit_city" name="edit_city" maxlength="30" placeholder="Введіть місто" required>
            </div>
            <div class="field">
                <label>Адреса</label>
                <input type="text" id="edit_address" name="edit_address" placeholder="Введіть адресу" required>
            </div>
            <div class="field">
                <label>Тип генератора</label>
                <div id="genTypes_edit" class="ui selection dropdown">
                    <input type="hidden" id="edit_genTypeId" name="edit_genTypeId">
                    <i class="dropdown icon"></i>
                    <div class="default text"></div>
                    <div class="menu">
                        <!-- Dropdown items will be populated here dynamically -->
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Тип бака генератора</label>
                <div id="fuelTanks_edit" class="ui selection dropdown">
                    <input type="hidden" id="edit_fuelTankId" name="edit_fuelTankId">
                    <i class="dropdown icon"></i>
                    <div class="default text"></div>
                    <div class="menu">
                        <!-- Dropdown items will be populated here dynamically -->
                    </div>
                </div>
            </div>
            <button class="ui blue button" type="button" onclick="submitEditForm()">Зберегти зміни</button>
        </form>
    </div>
</div>


<!-- Modal content with form -->
<div id="refuelModal" class="ui mini modal">
    <i class="close icon" onclick="closeRefuelModal()"></i>
    <div class="header">
        Додати заправку
    </div>
    <div class="content">
        <form id="refuelForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="refuelGenId" name="refuelGenId">
            <input type="hidden" id="refuelGenLitres" name="refuelGenLitres">
            <div class="field">
                <h4 class="ui header" id="refuelGenAdressFull" name="refuelGenAdressFull">
                </h4>
            </div>
            <div class="field">
                <label>Оберіть дату та час</label>
                <div class="ui calendar" id="refuel_calendar">
                    <div class="ui fluid input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" id="refuelDate" name="refuelDate" placeholder="Дата/Час" required>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Залито літрів</label>
                <input type="number" id="refuelLitres" name="refuelLitres" placeholder="Введіть літри" required>
            </div>
            <div class="field">
                <label id="refuelGenFueltankName" name="refuelGenFueltankName"></label>
                <input type="number" id="refuelLitresAfter" name="refuelLitresAfter" placeholder="Введіть літри" required>
            </div>
            <button class="ui green button" type="button" onclick="submitRefuelForm()">Додати заправку</button>
        </form>
    </div>
</div>

<!-- Modal content with form -->
<div id="serviceModal" class="ui small modal">
    <i class="close icon" onclick="closeServiceModal()"></i>
    <div class="header">
        Додати сервіс
    </div>
    <div class="content">
        <form id="serviceForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="serviceGenId" name="serviceGenId">
            <div class="field">
                <h4 class="ui header" id="serviceGenAdressFull" name="serviceGenAdressFull">
                </h4>
            </div>
            <div class="field">
                <label>Оберіть дату та час</label>
                <div class="ui calendar" id="service_calendar">
                    <div class="ui fluid input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" id="serviceDate" name="serviceDate" placeholder="Дата/Час" required>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Тип сервісу</label>
                <div id="serviceTypes"  class="ui multiple selection dropdown">
                    <input type="hidden" id="serviceTypeId" name="serviceTypeId">
                    <i class="dropdown icon"></i>
                    <div class="default text"></div>
                    <div class="menu">
                        <!-- Dropdown items will be populated here dynamically -->
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="ui input">
                    <textarea id="serviceDesc" name="serviceDesc" placeholder="Додатково (не обовязково)"></textarea>
                </div>
            </div>

            <button class="ui green button" type="button" onclick="submitServiceForm()">Додати сервіс</button>
        </form>
    </div>
</div>

<?php
//todo fix date select
?>
<!-- Modal content with form -->
<div id="runModal" class="ui mini modal">
    <i class="close icon" onclick="closeRunModal()"></i>
    <div class="header">
        Додати запуск генератора
    </div>
    <div class="content">
        <form id="runForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="runGenId" name="runGenId">
            <div class="field">
                <h4 class="ui header" id="runGenAdressFull" name="runGenAdressFull">
                </h4>
            </div>
            <div class="field">
                <label>Оберіть дату та час</label>
                <div class="ui calendar" id="start_calendar">
                    <div class="ui fluid input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" id="runStartDate" name="runStartDate" placeholder="Дата/Час" required>
                    </div>
                </div>
            </div>
            <div class="grouped fields">
                <label>Тип запуска</label>
                <div class="field">
                    <div id="typeAvaria" class="ui radio checkbox">
                        <input type="radio" id="runType" name="runType" checked="checked" tabindex="0" class="hidden" value="Аварія">
                        <label>Аварія електромережі</label>
                    </div>
                </div>
                <div class="field">
                    <div id="typeTest" class="ui radio checkbox">
                        <input id="runType" type="radio" name="runType" tabindex="0" class="hidden" value="Тест">
                        <label>Тест</label>
                    </div>
                </div>
            </div>
            <div class="grouped fields">
                <label>Генератор запустився?</label>
                <div class="field">
                    <div id="typeRun" class="ui radio checkbox default">
                        <input id="runResult" type="radio" name="runResult" checked="checked" tabindex="1" class="hidden" value="Запустився">
                        <label>Так</label>
                    </div>
                </div>
                <div class="field">
                    <div id="typeNoRun" class="ui radio checkbox">
                        <input id="runResult" type="radio" name="runResult" tabindex="1" class="hidden" value="Не запустився">
                        <label>Ні</label>
                    </div>
                </div>
            </div>
            <button class="ui green button" type="button" onclick="submitRunForm()">Додати запуск</button>
        </form>
    </div>
</div>

<!-- Modal content with form Stop-->
<div id="stopModal" class="ui mini modal">
    <i class="close icon" onclick="closeStopModal()"></i>
    <div class="header">
        Додати зупинку генератора
    </div>
    <div class="content">
        <form id="stopForm" class="ui form" method="post" autocomplete="off">
            <input type="hidden" id="stopGenId" name="stopGenId">
            <input type="hidden" id="stopRunStartDate" name="stopRunStartDate">
            <div class="field">
                <div class="field">
                    <h4 class="ui header" id="stopGenAdressFull" name="stopGenAdressFull">
                    </h4>
                </div>
                <label>Оберіть дату та час</label>
                <div class="ui calendar" id="stop_calendar">
                    <div class="ui fluid input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" id="runStopDate" name="runStopDate" placeholder="Дата/Час" required>
                    </div>
                </div>
            </div>
            <button class="ui green button" type="button" onclick="submitStopForm()">Додати зупинку</button>
        </form>
    </div>
</div>
