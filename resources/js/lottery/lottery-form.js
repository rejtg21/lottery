// const actions = require('./lottery-actions');

const generateBtn = document.querySelector('#generateBtn');
const input = {
    first:  document.querySelector('#lottery1'),
    second:  document.querySelector('#lottery2'),
    third:  document.querySelector('#lottery3'),
};

generateBtn.onclick = () => {
    generateBtn.setAttribute('disabled', 'disabled');
    // request to server about the numbers
    window.axios.get('generate').then((response)=> {
        let data = response.data;
        show('#randomNumbers');
        input.first.value = data.first;
        input.second.value = data.second;
        input.third.value = data.third;
        generateBtn.removeAttribute('disabled');
    });
}

const confirmBtn = document.querySelector('#confirmBtn');

confirmBtn.onclick = () => {
    let formData = {
        first: input.first.value,
        second: input.second.value,
        third: input.third.value,
    };
    window.axios.post('submit', formData).then((response) => {
        let data = response.data;

        window.swal('tst', data.message, 'success');
    }, (errors) => {
        console.log('errors???', errors.response.data);
        window.swal(errors.response.data.message);
    });
}

show = (element) => {
    // remove d-none class (Bootstrap 4) 
    document.querySelector(element).classList.remove('d-none');
}

replaceInputValue = (element, newValue) => {
    document.querySelector(element).value = newValue; 
}