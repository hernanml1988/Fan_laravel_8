/* 
let mapas = document.getElementById('mapas');
let historial = document.getElementById('historial');
mapas.addEventListener('click', ()=>{
        console.log(mapas)
        mapas.classList.toggle('arrow')
        let height = 0;
        let menu = mapas.nextElementSibling;
        if (menu.clientHeight == 0 ){
            height=menu.scrollHeight;
        }
        menu.style.height= `${height}px` ;
        historial.classList.remove('arrow')

    })
   
    historial.addEventListener('click', ()=>{
        console.log(historial)
        historial.classList.toggle('arrow')
        let height = 0;
        let menu = historial.nextElementSibling;
        if (menu.clientHeight == 0 ){
            height=menu.scrollHeight;
        }
        menu.style.height= `${height}px` ;
        mapas.classList.remove('arrow')
    })
*/
let listElements = document.querySelectorAll('.list_button--click');
listElements.forEach(listElement =>{
    listElement.addEventListener('click', ()=>{
        console.log(listElement)
        listElement.classList.toggle('arrow')

        let height = 0;
        let menu = listElement.nextElementSibling;
        if (menu.clientHeight == 0 ){
            height=menu.scrollHeight;
        }
        menu.style.height= `${height}px` ;     
        
    })
})
