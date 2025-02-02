import {resetImage} from "../services/pdv.js"
export const imageClick = () =>{
    const removeBtn = document.querySelector('#remove-image-button')
    removeBtn.addEventListener('click',async ()=>{
        if (window.confirm("L'image va etre supprimé, souhaitez vous confirmer ?")){
            const reset = await resetImage(removeBtn.getAttribute('data-id'))
            if (reset.hasOwnProperty('success')){
                document.querySelector('#pdv-image').innerHTML=""
            }
        }
    })
}