let signIn = document.getElementsByClassName("signIn")[0],
    signUp = document.getElementsByClassName("signUp")[0];

document.getElementsByClassName("log-in")[0].addEventListener("click", function(){
	signIn.classList += " active-dx";
	signUp.classList += " inactive-sx";
	signUp.classList.remove("active-sx");
	signIn.classList.remove("inactive-dx");
});

document.getElementsByClassName("back")[0].addEventListener("click", function(){
	signUp.classList += " active-sx";
	signIn.classList += " inactive-dx";
	signIn.classList.remove("active-dx");
	signUp.classList.remove("inactive-sx");
});