//$(document).ready(function () {
   
//});
$(document).ready(function () {
    $(document).on("change", "#navbardropds", function () {
        nds = $(this).val();
        if(nds==1)
            window.location.href = 'index.html';
        else if (nds==2)
            window.location.href = 'Truyenfull.html';
        else if (nds==3)
            window.location.href = 'truyenchuafull.html';
    });
    $(document).on("change", "#navbardroptl", function () {
        nds = $(this).val();
        if (nds == 1)
            window.location.href = 'index.html';
        else if (nds == 2)
            window.location.href = 'Ngontinh.html';
        else if (nds == 3)
            window.location.href = 'dammy.html';
        else if (nds == 4)
            window.location.href = 'kinhdi.html';
        else if (nds == 5)
            window.location.href = 'trinhtham.html';
    });

});