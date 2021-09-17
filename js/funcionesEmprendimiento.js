const carusel = document.querySelector("#carusel");
let caruselItem = document.querySelectorAll(".caruselItem");
let caruselItemLast = caruselItem[caruselItem.length -1];
document.querySelector("#caruselBtnAdelante").addEventListener('click', ()=>{
   let caruselItemFirst = document.querySelectorAll(".caruselItem")[0];
   if (document.querySelectorAll(".caruselItem").length > 1) {
      console.log(document.querySelectorAll(".caruselItem"))
      carusel.style.marginLeft = "-200%";
      carusel.style.transition = "all 0.5s";
      setTimeout(() => {
         carusel.style.transition = "none";
         carusel.insertAdjacentElement('beforeend',caruselItemFirst)
         carusel.style.marginLeft = "-100%";
      }, 500); 
   }
})
document.querySelector("#caruselBtnAtras").addEventListener('click', ()=>{
   let caruselItem = document.querySelectorAll(".caruselItem");
   if (document.querySelectorAll(".caruselItem").length >1) {
      let caruselItemLast = caruselItem[caruselItem.length -1];
      carusel.style.marginLeft = "0%";
      carusel.style.transition = "all 0.5s";
      setTimeout(() => {
         carusel.style.transition = "none";
         carusel.insertAdjacentElement('afterbegin',caruselItemLast)
         carusel.style.marginLeft = "-100%";
      }, 500);
   }

})