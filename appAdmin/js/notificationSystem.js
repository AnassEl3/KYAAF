document.addEventListener("DOMContentLoaded", ()=>{
    let toastElement = document.querySelector("#notify_toast");
    if(toastElement !== null)
    {
        let options = {
            animation : true,
            delay : 4000
        };
        let toast = new bootstrap.Toast(toastElement, options);
        toast.show();
    }
});