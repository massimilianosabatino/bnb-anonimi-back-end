
const signUpBUtton = document.getElementById("signUp");
const signInBUtton = document.getElementById("signIn");
const container = document.getElementById("container");

// switch between login and signup
if(signUpBUtton){
  signUpBUtton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});
}

if(signInBUtton){
  signInBUtton.addEventListener("click", () => [
  container.classList.remove("right-panel-active")
]);
}



