//test

const birthdate = document.querySelector('#birthdate')
const age = document.querySelector('#age')
const reason = document.querySelector('#reason')
const otherReason = document.querySelector('#other_reason')
const isPWD = document.querySelector('#is_pwd')
const disability = document.querySelector('#disability')
const otherDisability = document.querySelector('#other_disability')
const disease = document.querySelector('#disease')

/**
 *--------------------------------------------------------------------
 */
//for checking number inputs

const contact = document.querySelector('#contact')
const gcontact = document.querySelector('#gcontact')
const zipcode = document.querySelector('#zipcode')
const pzipcode = document.querySelector('#pzipcode')

/**
 *--------------------------------------------------------------------
 */
//for address

const street = document.querySelector('#street')
const barangay = document.querySelector('#barangay')
const district = document.querySelector('#district')
const city = document.querySelector('#city')
const state = document.querySelector('#state')

const pstreet = document.querySelector('#pstreet')
const pbarangay = document.querySelector('#pbarangay')
const pdistrict = document.querySelector('#pdistrict')
const pcity = document.querySelector('#pcity')
const pstate = document.querySelector('#pstate')

/**
 *--------------------------------------------------------------------
 */

//sending response copy and checking valid email constraint
const email = document.querySelector('#email')
const emailCopy = document.querySelector('#emailCopy')

//send email copy
email.addEventListener('change', () => {
    if (email.value == '') {
        emailCopy.disabled = true
    } else {
        emailCopy.disabled = false
    }
})

//const sameAddress = document.querySelector('#sameAddress');

// sameAddress.addEventListener('click', () => {
//     pstreet.value = street.value;
//     pbarangay.value = barangay.value;
//     pdistrict.value = district.value;
//     pcity.value = city.value;
//     pstate.value = state.value;
//     pzipcode.value = zipcode.value;
// });

/**
 *--------------------------------------------------------------------
 */

//allowed inputs
const allowedNumberInputs = /[0-9\/]+/
//check age input
age.addEventListener('keypress', (e) => {
    if (!allowedNumberInputs.test(e.key)) {
        e.preventDefault()
    }
})
//oscya contact number
contact.addEventListener('keypress', (e) => {
    if (!allowedNumberInputs.test(e.key)) {
        e.preventDefault()
    }
})
//oscya guardian contact number
gcontact.addEventListener('keypress', (e) => {
    if (!allowedNumberInputs.test(e.key)) {
        e.preventDefault()
    }
})
//oscya zipcode
zipcode.addEventListener('keypress', (e) => {
    if (!allowedNumberInputs.test(e.key)) {
        e.preventDefault()
    }
})
//oscya permanent zipcode
pzipcode.addEventListener('keypress', (e) => {
    if (!allowedNumberInputs.test(e.key)) {
        e.preventDefault()
    }
})

/**
 *--------------------------------------------------------------------
 */
//calculate age
birthdate.addEventListener('change', () => {
    calAge = (birthdate) =>
        new Date(Date.now() - new Date(birthdate).getTime()).getFullYear() -
        1970
    age.value = calAge(birthdate.value)
})

/**
 *--------------------------------------------------------------------
 */

//enable <#other_reason>
// reason.addEventListener('change', () => {
//     if(reason.value == 'Others'){
//         otherReason.disabled = false;
//     }else{
//         otherReason.disabled = true;
//     }
// });
// //enable <#is_pwd> and <#disability>
// reason.addEventListener('change', ()=>{
//     if(reason.value == 'Disability'){
//         isPWD.disabled = false;
//         isPWD.value = 1;
//         disability.disabled = false;
//     }else{
//         isPWD.disabled = true;
//         isPWD.value = 'Select';
//         disability.disabled = true;
//     }
// });
// //enable <#other_disability>
// disability.addEventListener('change', ()=> {
//     if(disability.value == 'Others'){
//         otherDisability.disabled = false;
//     }else{
//         otherDisability.disabled = true;
//     }
// });
// //enable <#disease>
// reason.addEventListener('change', ()=>{
//     if(reason.value == 'Disease'){
//         disease.disabled = false;
//     }else{
//         disease.disabled = true;
//     }
// });

// if(email.value == ""){
//     emailCopy.disabled = true;
// }else{
//     let validEmailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
//     if(email.value.match(validEmailFormat)){
//         emailCopy.disabled = false;
//     }else{
//         emailCopy.disabled = true;
//     }
// }
//form submit
