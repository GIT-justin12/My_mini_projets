const menuToggle = document.querySelector(".toggle-menu")
const menu = document.querySelector(".menu")

menuToggle.onclick = ()=>{
    menuToggle.classList.toggle('active')
    menu.classList.toggle('responsive')
}