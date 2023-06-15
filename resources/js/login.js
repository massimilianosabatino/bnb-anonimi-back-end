const signUpBUtton = document.getElementById("signUp");
const signInBUtton = document.getElementById("signIn");
const container = document.getElementById("container");

// switch between login and signup

signUpBUtton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

signInBUtton.addEventListener("click", () => [
  container.classList.remove("right-panel-active")
]);
