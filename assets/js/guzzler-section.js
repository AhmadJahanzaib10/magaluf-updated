const images = document.querySelectorAll(".img-box img");
window.addEventListener("resize",()=>{
    if(window.innerWidth < 1024){
        images.forEach((img)=>{
            const mobImg = img.getAttribute("data-img-mobile");
            img.src = mobImg;
            img.classList.remove("img-fix");
            img.classList.add("w-100");
        })
    }
})

if(window.innerWidth < 1024){
    images.forEach((img)=>{
        const mobImg = img.getAttribute("data-img-mobile");
        img.src = mobImg;
        img.classList.remove("img-fix");
        img.classList.add("w-100");
    })
}