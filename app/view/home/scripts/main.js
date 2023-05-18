function abrir_nav(){

    document.getElementById("menu_oculto").style.width="250px";
    document.getElementById("principal").style.width="250px";

}
function fechar_nav(){

    document.getElementById("menu_oculto").style.width="0";
    document.getElementById("menu_oculto").style.width="0";

}
function alternar_tema(elemento){
    if (elemento.checked) {
      darkMode();
    } else {
      lightMode();
    }
    }
    function darkMode() {
      var element = document.body;
      var content = document.getElementById("DarkModetext");
      element.className = "dark-mode";
      content.innerText = "Dark Mode is ON";
    }
    function lightMode() {
      var element = document.body;
      var content = document.getElementById("DarkModetext");
      element.className = "light-mode";
      content.innerT = "Dark Mode is OFF";
    }