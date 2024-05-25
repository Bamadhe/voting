function byId(id){ return document.getElementById(id); }
function byName(id){ return document.getElementsByName(id); }


function errorsStyle(id)
{
 var errorList = byId(id);
 errorList.style.fontSize = '20px';
 errorList.style.color = 'red';
 errorList.style.backgroundColor = 'white';
 errorList.style.textAlign = 'center';
}



function printErrors(errors)
{
 errorsStyle('errorList');
 
 var errorString = '<li>'+errors.join('</li><li>')+'</li>';
 
 byId('errorList').innerHTML = errorString;
}



function isEmpty(id)
{
 if(byId(id).value == ''){ return true; }
 return false;
}



function invalidEmail(id)
{
 var email = byId(id).value;
 if(email.indexOf('@') > 0 && email.indexOf('@') < email.length-1){ return false; }
 return true;
}



function isNumber(id)
{
 var number = byId(id).value;
 for(var i = 0; i < number.length; i++)
 {
 	if(number[i] < '0' || number[i] > '9'){ return false; }
 }
 return true;
}



function isSelected(name)
{
 var array = byName(name);
 for(var i = 0; i < array.length; i++)
 {
 	if(array[i].checked){ return true; }
 }
 return false;
}



function formCheck(eo)
{
 var errors=[];

 if(isEmpty('name')){ errors.push('You did not give your name.'); }
 if(isEmpty('email')){ errors.push('Email is not entered.'); }else{ if(invalidEmail('email')){ errors.push('Invalid email.'); } }
 if(isEmpty('age')){ errors.push('Your age?'); }else{ if(!isNumber('age')){ errors.push('Numbers have to be used, when you type your age!'); } }
 if(isEmpty('pin')){ errors.push('You did not give your PIN code.'); }
 if(isEmpty('phone')){ errors.push('Your phone number?'); }else{ if(!isNumber('phone')){ errors.push('Numbers have to be used, when you type your phone number!'); } }
 if(isEmpty('address')){ errors.push('You did not give your address.'); }
 if(isEmpty('fee')){ errors.push('fee?'); }else{ if(!isNumber('fee')){ errors.push('Numbers have to be used, when you type the fee!'); } }
 if(byId('package').value == 0){ errors.push('Your package?'); }
 if(!isSelected('gender')){ errors.push('What is your gender?'); }

 if(errors.length>0){ eo.preventDefault(); printErrors(errors); }
 
}



function initial()
{
 byId('formId').addEventListener('submit', formCheck, false);
}

window.addEventListener('load', initial, false);
