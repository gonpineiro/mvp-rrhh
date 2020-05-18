$(document).ready(function () {
    $('#normal').DataTable({
        "order": [[0, "desc"]],
        "pageLength": 15 
    });
});

$(document).ready(function () {
    $('#vigi_por_super').DataTable({
        "order": [[3, "desc"], [2, "asc"]],
        "pageLength": 15 
    });
});

$(document).ready(function () {
    $('#personal').DataTable({
        "order": [[0, "desc"], [2, "asc"]],
        "pageLength": 15 
    });
});

//JQUERY TABLLE
$(document).ready(function () {
    $('#rrhh').DataTable({
        "order": [[5, "desc"]],
        "pageLength": 15 
        
    });
});

//VOLVER
function goBack() {
    window.history.back();
}