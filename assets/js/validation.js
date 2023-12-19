function validate() {
				var fname =
					document.forms.RegForm.fname.value;
				var uname =
					document.forms.RegForm.uname.value;
				var phone =
					document.forms.RegForm.phone.value;

				var password =
					document.forms.RegForm.Password.value;
				var regUsername= /^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/; //Javascript reGex for Email Validation.
				var regPhone=/^\d{10}$/;									 // Javascript reGex for Phone Number validation.
				var regName = /\d+$/g;								 // Javascript reGex for Name validation

				if (fname == "" || regName.test(fname)) {
					window.alert("Please enter your name properly.");
					fname.focus();
					return false;
				}

				// if (address == "") {
				// 	window.alert("Please enter your address.");
				// 	address.focus();
				// 	return false;
				// }
				
				if (uname == "" || !regUsername.test(uname)) {
					window.alert("Please enter a username.");
					email.focus();
					return false;
				}
				
				if (password == "") {
					alert("Please enter your password");
					password.focus();
					return false;
				}

				if(password.length <6){
					alert("Password should be atleast 6 character long");
					password.focus();
					return false;

				}
				if (phone == "" || !regPhone.test(phone)) {
					alert("Please enter valid phone number.");
					phone.focus();
					return false;
				}

				// if (what.selectedIndex == -1) {
				// 	alert("Please enter your course.");
				// 	what.focus();
				// 	return false;
				// }

				return true;
			}
	