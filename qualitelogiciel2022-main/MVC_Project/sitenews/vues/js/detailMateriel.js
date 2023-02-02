window.addEventListener('load', () => {
    form = document.getElementById("BorrowingForm");
    form.style.display = "none";
    button = document.getElementById("BorrowingButton");

    button.addEventListener('click', () =>  {
        form.style.display = "block";
    });

    dateInput = document.getElementById("BorrowingDateInput");
    submit = document.getElementById("BorrowingSubmit");

    dateInput.addEventListener('input', () => {
        let currentDate = new Date(Date.now());
        const datesInput = dateInput.value.split(('-'));

        console.log(datesInput);
        console.log(currentDate.getFullYear());
        console.log(currentDate.getMonth());
        console.log(currentDate.getDate());

        if (parseInt(datesInput[0]) < currentDate.getFullYear()) {
            submit.disabled = true;
        } else if (parseInt(datesInput[0]) == currentDate.getFullYear()) {
            if (parseInt(datesInput[1]) < currentDate.getMonth()+1) {
                submit.disabled = true;
            } else if (parseInt(datesInput[1]) == currentDate.getMonth()+1) {
                if (parseInt(datesInput[2]) <= currentDate.getDate()) {
                    submit.disabled = true;
                } else {
                    submit.disabled = false;
                }
            } else {
                submit.disabled = false;
            }
        } else {
            submit.disabled = false;
        }
    });


});

