function json2dropdown(originalArray, nameItem, valueItem) {
    //function convert json array of items to simple array with
    // name and value items, based on items
    var outputArray = [];

    originalArray.forEach(function(item) {
        // Check if the specified properties exist in the current item
        if (item.hasOwnProperty(nameItem) && item.hasOwnProperty(valueItem)) {
            var outputItem = {
                name: item[nameItem],
                value: item[valueItem]
            };
            outputArray.push(outputItem);
        }
    });

    return outputArray;
}

function parseUkrainianDateTime(dateTimeString) {
    // Define a map of Ukrainian month names to English month names
    const monthMap = {
        'Січень': 'January',
        'Лютий': 'February',
        'Березень': 'March',
        'Квітень': 'April',
        'Травень': 'May',
        'Червень': 'June',
        'Липень': 'July',
        'Серпень': 'August',
        'Вересень': 'September',
        'Жовтень': 'October',
        'Листопад': 'November',
        'Грудень': 'December'
    };

    // Split the date-time string into parts
    const parts = dateTimeString.split(' ');

    // Replace the Ukrainian month name with the English counterpart
    const englishMonth = monthMap[parts[1]];

    // Create a new date string with the English month name
    const englishDateTimeString = parts[0] + ' ' + englishMonth + ' ' + parts[2] + ' ' + parts[3];
    // Create a Date object from the new date string
    const date = new Date(englishDateTimeString);

    // Return the Date object
    return date;
}

function isCorrectUAFormat(dateTimeString) {
    // Define the regular expression pattern for the Ukrainian date-time format
    const ukrainianFormatPattern = /^(\d{1,2})\s(Січень|Лютий|Березень|Квітень|Травень|Червень|Липень|Серпень|Вересень|Жовтень|Листопад|Грудень)\s\d{4}\s\d{1,2}:\d{2}$/;
    // Test the dateTimeString against the regular expression pattern
    return ukrainianFormatPattern.test(dateTimeString);
}

// dont using right now
function calculateTimeDifference(timestamp1, timestamp2) {
    // Calculate the difference in seconds
    var diffSeconds = Math.abs(timestamp1 - timestamp2);

    // Calculate hours and minutes
    var hours = Math.floor(diffSeconds / 3600); // 1 hour = 3600 seconds
    var minutes = Math.floor((diffSeconds % 3600) / 60); // 1 minute = 60 seconds

    // If hours are less than 1, set them to 0
    if (hours < 1) {
        return minutes + " хв.";
    }
    else
        return hours + " год. " + minutes + " хв.";
}