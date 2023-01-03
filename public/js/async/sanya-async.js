const applicationForm = () => {

    let error;
    let backendError;
    const form = document.querySelector('[data-application-form]');

    const submitBtnText = document.getElementById('submit-btn-text');
    const submitBtnLoadingSvg = document.getElementById('submit-btn-loading-svg');
    const submitBtnSuccessSvg = document.getElementById('submit-btn-success-svg');

    const inputs = document.querySelectorAll('[data-form-input]');
    const nameInput = document.querySelector('[data-form-input="name"]');
    const emailInput = document.querySelector('[data-form-input="email"]');
    const telephoneInput = document.querySelector('[data-form-input="telephone"]');
    const messageInput = document.querySelector('[data-form-input="message"]');

    const emailValidation = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const telephoneValidation = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

    for (let i = 0; i < (inputs.length - 1); i++) {
        //turn off probile button for name, email and telephone inputs
        inputs[i].addEventListener('keydown', (e) => {
            if  (inputs[i].value == 0 && e.keyCode == 32) {
                e.preventDefault();
                return;
            }
        });
    }

    //form logic
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        e.stopPropagation();

        //set error to false before validation
        error = false;

        //name input validation
        if (nameInput.value == 0) {
            nameInput.closest('[data-form-input-container]').classList.add('error');
            error = true;
        } else {
            nameInput.closest('[data-form-input-container]').classList.remove('error');
        }
        //email input validation
        if (emailInput.value == 0 || !emailInput.value.match(emailValidation)) {
            emailInput.closest('[data-form-input-container]').classList.add('error');
            error = true;
        } else {
            emailInput.closest('[data-form-input-container]').classList.remove('error');
        }
        //telephone input validation
        if (telephoneInput.value == 0 || !telephoneInput.value.match(telephoneValidation)) {
            telephoneInput.closest('[data-form-input-container]').classList.add('error');
            error = true;
        } else {
            telephoneInput.closest('[data-form-input-container]').classList.remove('error');
        }
        //message input validation
        if (messageInput.value == 0) {
            messageInput.closest('[data-form-input-container]').classList.add('error');
            error = true;
        } else {
            messageInput.closest('[data-form-input-container]').classList.remove('error');
        }

        //if we have an error - then quit submit event
        if (error) {
            return;
        }

        //change text to loading svg
        if (submitBtnSuccessSvg.classList.contains('dn')) {
            submitBtnText.classList.add('hidden');
            setTimeout(() => {
                submitBtnText.classList.add('dn');
                submitBtnLoadingSvg.classList.remove('dn');
                setTimeout(() => {
                    submitBtnLoadingSvg.classList.remove('hidden');
                }, 10);
            }, 500);
        }

        //Creating FormData object
        const fData = new FormData(form);
        const fAction = form.getAttribute('action');

        // singUpForm.submit();
        // Sending form to server
        const fetchResponse = await fetch(fAction, {
            method: 'POST',
            body: fData,
        });

        const result = await fetchResponse.json();

        //change loading svg to success svg
        submitBtnLoadingSvg.classList.add('hidden');
        setTimeout(() => {
            submitBtnLoadingSvg.classList.add('dn');
            submitBtnSuccessSvg.classList.remove('dn');
            setTimeout(() => {
                submitBtnSuccessSvg.classList.remove('hidden');
            }, 10);
        }, 500);

        if (fetchResponse.ok) {
            console.log(result);

            //set backendError to false before validation
            backendError = false;

            //add error to name block if validation not pass in backend
            if (result.message.includes('name')) {
                nameInput.closest('[data-form-input-container]').classList.add('error');
                backendError = true;
            }
            //add error to email block if validation not pass in backend
            if (result.message.includes('email')) {
                emailInput.closest('[data-form-input-container]').classList.add('error');
                backendError = true;
            }
            //add error to telephone block if validation not pass in backend
            if (result.message.includes('telephone')) {
                telephoneInput.closest('[data-form-input-container]').classList.add('error');
                backendError = true;
            }
            //add error to message block if validation not pass in backend
            if (result.message.includes('message')) {
                messageInput.closest('[data-form-input-container]').classList.add('error');
                backendError = true;
            }

            //if we have an error - then set submit button to default state
            if (backendError) {
                //change success svg to text
                submitBtnSuccessSvg.classList.add('hidden');
                setTimeout(() => {
                    submitBtnSuccessSvg.classList.add('dn');
                    submitBtnText.classList.remove('dn');
                    setTimeout(() => {
                        submitBtnText.classList.remove('hidden');
                    }, 10);
                }, 500);
            }

        } else {
            console.log(result);
        }
    });

}

export {applicationForm};