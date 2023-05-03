$(window).on("DOMContentLoaded", ()=>{
    $(".loading").css("display", "none");
});
//---------------------------------------------- Navigation ----------------------------------------------
function setNavigationModal(){
    if(window.innerWidth <= "752"){
        $("#smallNavModal").removeClass("d-none");
        $("#smallNavModal").addClass("d-flex");
        $("#bigNavModal").removeClass("d-flex");
        $("#bigNavModal").addClass("d-none");
        
    }else{
        $("#bigNavModal").removeClass("d-none");
        $("#bigNavModal").addClass("d-flex");
        $("#smallNavModal").removeClass("d-flex");
        $("#smallNavModal").addClass("d-none");
    }
}
setNavigationModal();
window.onresize = setNavigationModal;
$(".toast").toast("show");
//---------------------------------------------- Header ----------------------------------------------
//fixing the header height
if($("header")[0]){
    $("header")[0].style.cssText = `height: ${window.innerHeight}px`;
}

//---------------------------------------------- Authentication ----------------------------------------------
//$("#authModal").modal("show");

//---------------------------------------------- Announcement ----------------------------------------------
//details navigation
let announcementDetailsBtns = $(".announcement .details .detailsHead a");

function clearInfos(detailsDiv){
    $(detailsDiv).find(".detailsHead a").each((i, e)=>{
        $(e).removeClass("selected");
    });
    $(detailsDiv).find(".detailsBody div").each((i, e)=>{
        $(e).addClass("hidden");
    });
}
function selectInfo(detailsDiv, info){
    $(detailsDiv).find(`.detailsHead .${info}Btn`).each((i, e)=>{
        $(e).addClass("selected");
    });
    $(detailsDiv).find(`.detailsBody .${info}`).each((i, e)=>{
        $(e).removeClass("hidden");
    });
}
announcementDetailsBtns.on("click",(e)=>{
    clearInfos($(e.target).parent().parent()[0])
    selectInfo($(e.target).parent().parent()[0], $(e.target).attr("data-info"))
});
//images slider
$('.carousel').carousel()

//---------------------------------------------- New announcement ----------------------------------------------
//thumbnail displayer
let newAnnouncementThumbnailDisplayer = $(".addAnnouncement .newAnnouncementThumbnailDisplayer")[0],
    newAnnouncementThumbnailInput = $(".addAnnouncement #newAnnouncementThumbnailInput")[0];

$(newAnnouncementThumbnailInput).on("change",(e)=>{
    let fr = new FileReader();
    fr.onload = ()=>{
        $(newAnnouncementThumbnailDisplayer).attr("src", fr.result);
    }
    fr.readAsDataURL(e.target.files[0]);
});

let categorieSelecter = $(".addAnnouncement #categorieSelecter")[0],
    typeSelecter = $(".addAnnouncement #typeSelecter")[0],
    citySelector = $(".addAnnouncement #citySelector")[0];

//set types depending on the categorie
$(categorieSelecter).val("");
$(citySelector).val("");
function setTypes(idCat, tSelecter) {
    $(tSelecter).children().map((i, el) => {
        $(tSelecter).val("");
        if($(el).attr("data-parentCat") == idCat){
            $(el).removeClass("d-none");
            $(el).addClass("d-flex");
        }else{
            $(el).removeClass("d-flex");
            $(el).addClass("d-none");
        }
    });
}
setTypes($(".addAnnouncement #categorieSelecter").val(), typeSelecter);
$(categorieSelecter).on("change", (e)=>{
    setTypes(e.target.value, typeSelecter);
});

//add an image to the announcement
let addImageSelecter = $(".addAnnouncement #addImageSelecter")[0],
    addAnnouncementImagesContainer = $(".addAnnouncement #imagesContainer")[0];

$(addImageSelecter).on("change", (e)=>{
    $(addAnnouncementImagesContainer).empty();

    $(e.target.files).map((i)=>{
        let fr = new FileReader();
        fr.onload = ()=>{
            $(addAnnouncementImagesContainer).append(`
            <div class="image d-flex justify-content-center align-content-center flex-column p-1 m-1 rounded bg-primary">
                <img class="img-fluid rounded" src="${fr.result}">
            </div>
        `);
        }
        fr.readAsDataURL(e.target.files[i]);
    });
});

//---------------------------------------------- Modify announcement ----------------------------------------------
//thumbnail displayer
let modifyAnnouncementThumbnailDisplayer = $(".modifyAnnouncement .modifyAnnouncementThumbnailDisplayer")[0],
    modifyAnnouncementThumbnailInput = $(".modifyAnnouncement #modifyAnnouncementThumbnailInput")[0];

$(modifyAnnouncementThumbnailInput).on("change",(e)=>{
    let fr = new FileReader();
    fr.onload = ()=>{
        $(modifyAnnouncementThumbnailDisplayer).attr("src", fr.result);
    }
    fr.readAsDataURL(e.target.files[0]);
});

let categorieSelecter2 = $(".modifyAnnouncement #categorieSelecter")[0],
    typeSelecter2 = $(".modifyAnnouncement #typeSelecter")[0];

//set types depending on the categorie
function setTypes2(idCat, tSelecter) {
    $(tSelecter).children().map((i, el) => {
        if($(el).attr("data-parentCat") == idCat){
            $(el).removeClass("d-none");
            $(el).addClass("d-flex");
            if($(el).val() == $(el).parent().attr("data-default")){
                $(el).attr("selected","selected");
                console.log($(el)[0]);
            }
        }else{
            $(el).removeClass("d-flex");
            $(el).addClass("d-none");
        }
    });
}
setTypes2($(".modifyAnnouncement #categorieSelecter").val(), typeSelecter2);
$(categorieSelecter2).on("change", (e)=>{
    $(typeSelecter2).val("");
    setTypes2(e.target.value, typeSelecter2);
});

//add an image to the announcement
let modifyImageSelecter = $(".modifyAnnouncement #modifyImageSelecter")[0],
    modifyAnnouncementImagesContainer = $(".modifyAnnouncement #imagesContainer")[0];

$(modifyImageSelecter).on("change", (e)=>{
    $(modifyAnnouncementImagesContainer).empty();

    $(e.target.files).map((i)=>{
        let fr = new FileReader();
        fr.onload = ()=>{
            $(modifyAnnouncementImagesContainer).append(`
            <div class="image d-flex justify-content-center align-content-center flex-column p-1 m-1 rounded bg-primary">
                <img class="img-fluid rounded" src="${fr.result}">
            </div>
        `);
        }
        fr.readAsDataURL(e.target.files[i]);
    });
});

//---------------------------------------------- Registration ----------------------------------------------
//profile picture displayer
let registrationAvatarDisplayer = $(".registration .registrationAvatarDisplayer")[0],
    registrationAvatarInput = $(".registration #profilePicInput")[0];


$(registrationAvatarInput).on("change",(e)=>{
    let fr = new FileReader();
    fr.onload = ()=>{
        $(registrationAvatarDisplayer).attr("src", fr.result);
    }
    fr.readAsDataURL(e.target.files[0]);
});

//---------------------------------------------- Account ----------------------------------------------
//profile picture displayer
let accountAvatarDisplayer = $(".accountInfo .myAccountAvatarDisplayer")[0],
    accountAvatarInput = $(".accountInfo #myAccountChangeAvatarInput")[0];

$(accountAvatarInput).on("change",(e)=>{
    let fr = new FileReader();
    fr.onload = ()=>{
        $(accountAvatarDisplayer).attr("src", fr.result);
    }
    fr.readAsDataURL(e.target.files[0]);
});
